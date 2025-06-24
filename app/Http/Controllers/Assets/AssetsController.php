<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Assets;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class AssetsController extends Controller
{
    public function index(Request $request): View
    {
        $token         = session('jwt_token');
        $idImobiliaria = session('user')['id_imobiliaria'];

        $requestSanitize = $this->sanitizeData($request->all(), ['search']);

        $queryParams = [
            'page'       => $request->get('page', 1),
            'search'     => $requestSanitize['search'] ?? null,
            'status'     => $request->input('status'),
            'created_at' => $request->input('created_at'),
            'pendences'  => $request->input('pendences'),
        ];

        $response = Http::withToken($token)->get(config('api.route') . '/assets/' . $idImobiliaria, $queryParams);
        $data     = $response->json();

        $totalGeral = array_sum(array_column($data['contratos'], 'TOTAL'));

        $statusContagem = [
            'Todos'        => $totalGeral,
            'Ativos'       => 0,
            'Cancelados'   => 0,
            'Em renovação' => 0,
            'Pendente'     => 0,
        ];

        if (! empty($data['contratos'])) {
            foreach ($data['contratos'] as $contrato) {
                $status = $contrato['STATUS_PERSONALIZADO'] ?? '';
                $total  = $contrato['TOTAL'] ?? 0;

                // Mapear nomes conhecidos para os do card
                switch (trim(strtolower($status))) {
                    case 'ativo':
                        $statusContagem['Ativos'] = $total;

                        break;
                    case 'cancelado':
                        $statusContagem['Cancelados'] = $total;

                        break;
                    case 'renovando':
                        $statusContagem['Em renovação'] = $total;

                        break;
                    case 'pendente':
                        $statusContagem['Pendente'] = $total;

                        break;
                }
            }
        }

        return view('assets.index', ['statusContagem' => $statusContagem, 'contratos' => $data['data'],  'pagination' => $data['meta'], ]);
    }

    public function find(string $idContrato): View
    {
        $token = session('jwt_token');

        $response = Http::withToken($token)->get(config('api.route') . '/assets/' . session('user')['id_imobiliaria'] . '/' . $idContrato);
        $data     = $response->json();

        $response    = Http::withToken($token)->get(config('api.route') . '/histories/' . $idContrato);
        $dataHistory = $response->json();

        $dateConvert                       = Carbon::parse($data['data']['data'])->addYear();
        $fiancaDisponivel                  = ($this->parseValor($data['data']['imovel_aluguel']) * 40);
        $data['data']['fianca_disponivel'] = 'R$ ' . number_format(floatval($fiancaDisponivel), 2, ',', '');
        $data['data']['prox_renovacao']    = $dateConvert->format('d/m/Y');

        return view('assets.asset', ['data' => $data['data'], 'histories' => $dataHistory['data']]);
    }

    public function edit(string $idContrato): View
    {
        $token = session('jwt_token');

        $response = Http::withToken($token)->get(config('api.route') . '/assets/' . session('user')['id_imobiliaria'] . '/' . $idContrato);
        $data     = $response->json();

        $anexosResponse = Http::withToken($token)->get(config('api.route') . '/attachment', [
            'id_imobiliaria' => session('user')['id_imobiliaria'],
            'id_movi'        => $idContrato,
        ]);
        $anexos = $anexosResponse->json();

        return view('assets.edit', ['data' => $data['data'], 'anexos' => $anexos]);
    }

    public function uploadAnexo(Request $request, string $idContrato)
    {
        $token         = session('jwt_token');
        $idImobiliaria = session('user')['id_imobiliaria'];

        if ($request->hasFile('arquivos') && $idContrato) {
            foreach ($request->file('arquivos') as $tipo => $file) {
                $response = Http::withToken($token)->get(config('api.route') . '/propostal/' . $idContrato);
                $proposta = $response->json();

                if ($tipo == 'contrato') {
                    $proposta['anx_contrato'] = 1;
                    $parserPropostal          = $this->parserValuesForInsert($proposta);
                    $response                 = Http::withToken($token)->post(config('api.route') . '/propostal/create', $parserPropostal);
                }

                if ($tipo == 'vistoria') {
                    $proposta['anx_vistoria'] = 1;
                    $parserPropostal          = $this->parserValuesForInsert($proposta);
                    Http::withToken($token)->post(config('api.route') . '/propostal/create', $parserPropostal);
                }

                if ($tipo == 'apolice') {
                    $proposta['anx_apolice'] = 1;
                    $parserPropostal         = $this->parserValuesForInsert($proposta);
                    Http::withToken($token)->post(config('api.route') . '/propostal/create', $parserPropostal);
                }

                if ($file && $file->isValid()) {
                    // Aqui você tem $tipo (ex: 'contrato', 'vistoria'...) e o $file
                    // Pode usar o tipo para salvar em pastas diferentes ou no nome do arquivo
                    $ext          = $file->getClientOriginalExtension();
                    $nomeOriginal = $file->getClientOriginalName();

                    // Verifica se já existe o arquivo para essa proposta e tipo
                    $verificaAnexo = Http::withToken($token)->get(config('api.route') . '/attachment/exists', [
                        'id_imobiliaria' => $idImobiliaria,
                        'id_movi'        => $idContrato,
                        'nome_arquivo'   => $nomeOriginal,
                    ]);

                    if ($verificaAnexo->ok() && ($verificaAnexo->json()['exists'] ?? false)) {
                        continue; // pula para o próximo arquivo
                    }

                    $nomeUnico = uniqid($idContrato . '_' . $tipo . '_') . '.' . $ext;

                    // Salva arquivo com nome único
                    $file->storeAs("anexos/{$idImobiliaria}/contratos", $nomeUnico, 'public');

                    // Registra no banco via API
                    Http::withToken($token)->post(config('api.route') . '/attachment', [
                        'id_imobiliaria'        => $idImobiliaria,
                        'id_movi'               => $idContrato,
                        'movi'                  => 'contratos',
                        'movi_sub'              => $tipo, // salva o tipo no banco
                        'data'                  => now()->format('Y-m-d H:i:s'),
                        'nome_arquivo'          => $nomeUnico,
                        'nome_arquivo_original' => $nomeOriginal,
                        'descricao'             => "Arquivo anexado à proposta ({$tipo})",
                    ]);
                }
            }
        }

        return redirect()->route('assets.asset', ['id' => $idContrato])->with('success', 'Arquivos enviados com sucesso!');
    }

    private function parseValor(string $valor): float
    {
        // Remove 'R$', espaços, pontos de milhar e converte vírgula decimal para ponto
        $limpo = str_replace(['R$', ' ', '.'], '', $valor);
        $limpo = str_replace(',', '.', $limpo);

        return floatval($limpo);
    }

    private function parserValuesForInsert(array $data): array
    {
        $data['imovel_aluguel']       = $this->parseValor($data['imovel_aluguel'] ?? '0');
        $data['imovel_condominio']    = $this->parseValor($data['imovel_condominio'] ?? '0');
        $data['imovel_taxas']         = $this->parseValor($data['imovel_taxas'] ?? '0');
        $data['proposta_total_valor'] = $this->parseValor($data['proposta_total_valor'] ?? '0');
        $data['proposta_setup_valor'] = $this->parseValor($data['proposta_setup_valor'] ?? '0');

        $data["pessoa_tipo"] = match ($data["pessoa_tipo"] ?? null) {
            "Pessoa Física"   => "PF",
            "Pessoa Jurídica" => "PJ",
            default           => $data["pessoa_tipo"] ?? null,
        };

        $data["imovel_tipo"] = match ($data["imovel_tipo"] ?? null) {
            "Residencial" => "R",
            "Comercial"   => "C",
            default       => $data["imovel_tipo"] ?? null,
        };

        return $data;
    }

    public function baixarAnexo(string $idContrato, string $tipo)
{
    $idImobiliaria = session('user')['id_imobiliaria'];

    // Buscar nome do arquivo no banco
    $response = Http::withToken(session('jwt_token'))->get(config('api.route') . '/search/attachment', [
        'id_imobiliaria' => $idImobiliaria,
        'id_movi'        => $idContrato,
        'movi'           => 'contratos',
        'movi_sub'       => $tipo,
    ]);

    if (! $response->ok() || empty($response->json())) {
        abort(404, 'Arquivo não encontrado');
    }

    $nomeArquivo = $response->json()[0]['NOME_ARQUIVO'] ?? null;

    $caminho = "anexos/{$idImobiliaria}/contratos/{$nomeArquivo}";

    if (! Storage::disk('public')->exists($caminho)) {
        abort(404, 'Arquivo não encontrado no storage');
    }

    return response()->file(storage_path("app/public/{$caminho}"), [
        'Content-Disposition' => 'inline; filename="' . $nomeArquivo . '"',
    ]);
}

/*
    public function baixarAnexo(string $idContrato, string $tipo)
    {
        $idImobiliaria = session('user')['id_imobiliaria'];

        // Buscar nome do arquivo no banco
        $response = Http::withToken(session('jwt_token'))->get(config('api.route') . '/search/attachment', [
            'id_imobiliaria' => $idImobiliaria,
            'id_movi'        => $idContrato,
            'movi'           => 'contratos',
            'movi_sub'       => $tipo,
        ]);

        if (! $response->ok() || empty($response->json())) {
            abort(404, 'Arquivo não encontrado');
        }

        $nomeArquivo = $response->json()[0]['NOME_ARQUIVO'] ?? null;

        $caminho = "anexos/{$idImobiliaria}/contratos/{$nomeArquivo}";

        if (! Storage::disk('public')->exists($caminho)) {
            abort(404, 'Arquivo não encontrado no storage');
        }

        return response()->file(storage_path("app/public/{$caminho}"));
    }
*/

    public function exportDetalhado(Request $request)
    {
        $user  = session('user');
        $token = session('jwt_token');

        // Pegando os mesmos filtros usados no index
        $queryParams = [
            'search'     => $request->input('search'),
            'status'     => $request->input('status'),
            'created_at' => $request->input('created_at'),
            'pendences'  => $request->input('pendences'),
        ];

        $response  = Http::withToken($token)->get(config('api.route') . '/assets/' . $user['id_imobiliaria'], $queryParams);
        $contratos = $response->json()['data'];

        $spreadsheet = new Spreadsheet();
        $sheet       = $spreadsheet->getActiveSheet();

        // ======= CABEÇALHO (Mantendo o padrão) =======

        // Linha 1 - Título
        $sheet->setCellValue('A1', 'Relatório Detalhado de Contratos');
        $sheet->mergeCells('A1:I1');
        $sheet->getStyle('A1:I1')->getFont()->setBold(true)->setSize(16)->getColor()->setRGB('FFFFFF');
        $sheet->getStyle('A1:I1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('3C3C3C');
        $sheet->getStyle('A1:I1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT)->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getRowDimension(1)->setRowHeight(30);

        // Linha 2 - Filtros
        $periodoFiltro = 'Filtros aplicados: ';
        $periodoFiltro .= $request->input('search') ? 'Busca: "' . $request->input('search') . '" ' : '';
        $periodoFiltro .= $request->input('status') ? ' | Status: ' . $request->input('status') : '';
        $periodoFiltro .= $request->input('created_at') ? ' | Criado em: ' . $request->input('created_at') : '';
        $periodoFiltro .= $request->input('pendences') ? ' | Pendências: ' . $request->input('pendences') : '';

        $sheet->setCellValue('A2', $periodoFiltro !== '' && $periodoFiltro !== '0' ? $periodoFiltro : 'Nenhum filtro aplicado');
        $sheet->mergeCells('A2:I2');
        $sheet->getStyle('A2:I2')->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
        $sheet->getStyle('A2:I2')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('3C3C3C');
        $sheet->getRowDimension(2)->setRowHeight(25);

        // Linha 3 - Divisor Azul
        $sheet->mergeCells('A3:I3');
        $sheet->getStyle('A3:I3')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('5C95C4');
        $sheet->getRowDimension(3)->setRowHeight(5);

        // ======= Cabeçalhos da Tabela =======
        $linha = 5;

        $sheet->fromArray([
            'Inquilino', 'Documento', 'Valor Locatício', 'Status', 'Sub Status', 'Corretor', 'Data de Criação', 'Última Atualização', 'Pendências',
        ], null, 'A' . $linha);

        $sheet->getStyle('A' . $linha . ':I' . $linha)->getFont()->setBold(true);
        $sheet->getStyle('A' . $linha . ':I' . $linha)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F2F2F2');
        $linha++;

        // ======= Dados da Tabela =======
        foreach ($contratos as $contrato) {
            $faltando = [];

            if (empty($contrato['anexo_contrato']) || $contrato['anexo_contrato'] == 0) {
                $faltando[] = 'Necessário anexar o contrato de aluguel';
            }

            if (empty($contrato['anexo_vistoria']) || $contrato['anexo_vistoria'] == 0) {
                $faltando[] = 'Necessário anexar a vistoria';
            }

            $textoPendencias = count($faltando) > 0 ? implode(' | ', $faltando) : 'Nenhuma pendência';

            $sheet->setCellValue('A' . $linha, $contrato['pessoa_nome'] ?? '-');
            $sheet->setCellValue('B' . $linha, $contrato['pessoa_doc'] ?? '-');
            $sheet->setCellValue('C' . $linha, $contrato['imovel_aluguel'] ?? '-');
            $sheet->getStyle('C' . $linha)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);
            $sheet->setCellValue('D' . $linha, $contrato['contrato_status'] ?? '-');
            $sheet->setCellValue('E' . $linha, $contrato['contrato_sub_status'] ?? '-');
            $sheet->setCellValue('F' . $linha, $contrato['NOME_CORRETOR'] ?? '-');

            $dataCriacao     = empty($contrato['data']) ? '-' : Carbon::parse($contrato['data'])->format('d/m/Y');
            $dataAtualizacao = empty($contrato['data_ultima_atualizacao']) ? '-' : Carbon::parse($contrato['data_ultima_atualizacao'])->format('d/m/Y');

            $sheet->setCellValue('G' . $linha, $dataCriacao);
            $sheet->setCellValue('H' . $linha, $dataAtualizacao);
            $sheet->setCellValue('I' . $linha, $textoPendencias);

            $linha++;
        }

        // AutoSize nas colunas
        foreach (range('A', 'H') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Download
        $writer   = new Xlsx($spreadsheet);
        $fileName = 'relatorio_detalhado_contratos_' . now()->format('Ymd_His') . '.xlsx';

        return response()->streamDownload(function () use ($writer): void {
            $writer->save('php://output');
        }, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }
}
