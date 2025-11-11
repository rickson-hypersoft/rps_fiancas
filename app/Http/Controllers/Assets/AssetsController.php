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

        $statusContagem = [
            'Todos'        => 0,
            'Ativos'       => 0,
            'Cancelados'   => 0,
            'Em renovação' => 0,
            'Pendente'     => 0,
        ];

        if (! empty($data['contratos'])) {
            foreach ($data['contratos'] as $contrato) {
                $status = $contrato['STATUS_PERSONALIZADO'];
                $total  = $contrato['TOTAL'] ?? 0;

                // Ignora contratos com status null
                if (is_null($status)) {
                    continue;
                }

                // Soma sempre no total geral
                $statusContagem['Todos'] += $total;

                // Mapear nomes conhecidos para os do card
                switch (trim(strtolower($status))) {
                    case 'ativo':
                        $statusContagem['Ativos'] += $total;

                        break;
                    case 'cancelado':
                        $statusContagem['Cancelados'] += $total;

                        break;
                    case 'renovando':
                    case 'em renovação':
                        $statusContagem['Em renovação'] += $total;

                        break;
                    case 'pendente':
                        $statusContagem['Pendente'] += $total;

                        break;
                }
            }
        }

        return view('assets.index', ['statusContagem' => $statusContagem, 'contratos' => $data['data'],  'pagination' => $data['meta'], ]);
    }

    public function find(string $idContrato): View
    {
        $inadimplencia = request()->route('inadimplencia');
        $token         = session('jwt_token');

        $response = Http::withToken($token)->get(config('api.route') . '/assets/' . session('user')['id_imobiliaria'] . '/' . $idContrato);
        $data     = $response->json();

        $response    = Http::withToken($token)->get(config('api.route') . '/histories/' . $idContrato);
        $dataHistory = $response->json();

        $dateConvert                       = Carbon::parse($data['data']['data'])->addYear();
        $fiancaDisponivel                  = ($this->parseValor($data['data']['imovel_aluguel']) * 40);
        $data['data']['fianca_disponivel'] = 'R$ ' . number_format(floatval($fiancaDisponivel), 2, ',', '.');
        $data['data']['prox_renovacao']    = $dateConvert->format('d/m/Y');

        $inadimplenciaId = 0;

        if (! empty($data['inadimplencia'])) {
            $inadimplenciaId = $data['inadimplencia'][0]['id'];
        }

        if ($inadimplencia !== null && $inadimplencia !== 0) {
            $delinquenciesResponse = Http::withToken(session('jwt_token'))->get(config('api.route') . '/delinquencies/delinquencie/' . $inadimplencia);
            $delinquencies         = $delinquenciesResponse->json();

            // Verifique se a requisição foi bem-sucedida e se há dados
            if ($delinquenciesResponse->successful() && ! empty($delinquencies['delinquencies'])) {
                return view('assets.asset', [
                    'data'                => $data['data'],
                    'histories'           => $dataHistory['data'],
                    'possuiInadimplencia' => $inadimplenciaId,
                    'inadimplencia'       => $delinquencies['delinquencies'],
                ])->with('sweetAlert', true);
            }
        }

        return view('assets.asset', [
            'data'                => $data['data'],
            'histories'           => $dataHistory['data'],
            'possuiInadimplencia' => $inadimplenciaId ,
            'inadimplencia'       => null,
        ])->with('sweetAlert', false);
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

        $nomeArquivo = $response->json()[0]['nome_arquivo'] ?? null;

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

    public function reiscindirContrato(string $idContrato)
    {
        $token = session('jwt_token');

        $response = Http::withToken($token)->get(config('api.route') . '/assets/' . session('user')['id_imobiliaria'] . '/' . $idContrato);
        $data     = $response->json();

        $anexosResponse = Http::withToken($token)->get(config('api.route') . '/attachment', [
            'id_imobiliaria' => session('user')['id_imobiliaria'],
            'id_movi'        => $idContrato,
        ]);
        $anexos = $anexosResponse->json();

        $responsePayments = Http::withToken($token)->get(config('api.route') . '/payments' . '/' . $idContrato);
        $dataPayments     = $responsePayments->json();

        $dataPayments['pagamentos']['pessoa_nome']          = $data['data']['pessoa_nome'];
        $dataPayments['pagamentos']['proposta_total_valor'] = $data['data']['proposta_total_valor'];

        return view('assets.reiscindir', ['data' => $data['data'], 'anexos' => $anexos, 'payments' => $dataPayments['pagamentos']]);
    }

    private function corrigirNumero($numero): string
    {
        // Remove tudo que não for dígito
        $numero = preg_replace('/\D/', '', (string) $numero);

        // Remove possíveis zeros iniciais, DDI, etc.
        if (str_starts_with((string) $numero, '55')) {
            $numero = substr((string) $numero, 2); // tira o DDI se já vier com ele
        }

        // Se vier com 11 dígitos e começar com 9 (ex: 999911156), mantém
        // Se vier com 9 dígitos (sem DDD), pode tratar de acordo com sua lógica
        if (strlen((string) $numero) === 11) {
            // já está completo com DDD
            return '+55' . $numero;
        }

        // Caso falte DDD, insere o 34
        if (strlen((string) $numero) === 9) {
            return '+5534' . $numero;
        }

        // Fallback – retorna com +55 mesmo
        return '+55' . $numero;
    }

    private function sendWhatsApp(string $idContrato)
    {
        $token = session('jwt_token');

        $response = Http::withToken($token)->get(config('api.route') . '/propostal/' . $idContrato);
        $proposta = $response->json();

        $to   = $proposta['pessoa_telefone'];
        $type = 'cancelamento_contrato';
        $link = $proposta['link_hash'];
        $to   = $this->corrigirNumero($to);

        $response = Http::withToken($token)->post(config('api.route') . '/enviar-whatsapp/' . $type . '/' . $link, ['to' => $to]);

        if (! $response->successful()) {
            return response()->json("Não foi possível enviar mensagem!");
        }

        return response()->json("Mensagem enviada com sucesso!");
    }

    public function cancelar(Request $request, string $idContrato)
    {
        $token         = session('jwt_token');
        $idImobiliaria = session('user')['id_imobiliaria'];

        $motivo      = $request->input('motivo_rescisao');
        $detalhe     = $request->input('detalhe');
        $dataEntrega = $request->input('data_entrega'); // formato Y-m-d

        $data = [
            'motivo_rescisao' => $request->input('motivo_rescisao'),
            'detalhe'         => $request->input('detalhe'),
            'data_entrega'    => $request->input('data_entrega'),
        ];

        // Formata a data de entrega no padrão brasileiro
        $dataEntregaBR = $dataEntrega ? Carbon::parse($dataEntrega)->format('d/m/Y') : 'não informada';

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
                        'descricao'             => "Arquivo anexado ao cancelamento do contrato ({$tipo})",
                    ]);
                }
            }
        }

        $responsePayments = Http::withToken($token)->get(config('api.route') . '/payments' . '/' . $idContrato);
        $dataPayments     = $responsePayments->json();

        $rawDataPagamento = $dataPayments['pagamentos']['DATA_PAGAMENTO'] ?? null;

        try {
            if ($rawDataPagamento && str_contains((string) $rawDataPagamento, '/')) {
                // formato d/m/Y
                $dataPagamento = Carbon::createFromFormat('d/m/Y', $rawDataPagamento)->startOfDay();
            } else {
                // tenta parse normal (Y-m-d, ISO, etc.)
                $dataPagamento = Carbon::parse($rawDataPagamento)->startOfDay();
            }
        } catch (\Exception) {
            // fallback seguro (se parse falhar)
            $dataPagamento = Carbon::today()->startOfDay();
        }

        $dataCancelamento = Carbon::today()->startOfDay(); // sempre hoje
        $mesesContrato    = 12; // se for sempre 12 meses

        // cálculo de meses inteiros utilizados
        $anosDiff    = $dataCancelamento->year - $dataPagamento->year;
        $mesesDiff   = $dataCancelamento->month - $dataPagamento->month;
        $totalMonths = $anosDiff * 12 + $mesesDiff;

        // se o dia do cancelamento for anterior ao dia do pagamento, o mês corrente não foi completado
        if ($dataCancelamento->day < $dataPagamento->day) {
            $totalMonths--;
        }

        // garante não negativo
        $mesesUsados = max($totalMonths, 0);

        // ---- regra de negócio: se quiser GARANTIR no mínimo 1 mês usado (como você já tinha antes),
        // mantenha a linha abaixo. Se preferir aceitar 0 meses usados quando a rescisão for antes
        // de completar 1 mês, remova ou comente a próxima linha.
        $mesesUsados = max($mesesUsados, 1);

        // meses restantes e cálculo proporcional do estorno
        $mesesRestantes = max($mesesContrato - $mesesUsados, 0);

        // melhor calcular estorno proporcional direto sobre o total para evitar erros de arredondamento
        $valorTotal   = (float) $dataPayments['pagamentos']['VALOR'];
        $valorEstorno = round($valorTotal * ($mesesRestantes / $mesesContrato), 2);

        // formata para BR
        $valorTotalFmt   = number_format($valorTotal, 2, ',', '.');
        $valorEstornoFmt = number_format($valorEstorno, 2, ',', '.');

        $historicoBase = "Usuário " . session('user')['nome'] .
            " cancelou o contrato {$idContrato} em " . now()->format('d/m/Y H:i') .
            " pelo motivo: {$motivo}. Detalhes: {$detalhe}. " .
            "Data prevista para entrega da chave: {$dataEntregaBR}.";

        $historico = $historicoBase;

        // Se for PIX ou BOLETO confirmado → acrescenta o aviso de estorno
        if (
            in_array($dataPayments['pagamentos']['METODO_PAGAMENTO'], ['PIX', 'BOLETO'])
            && $dataPayments['pagamentos']['STATUS'] === 'CONFIRMED'
        ) {
            $historico .= " O inquilino pagou R$ " . $valorTotalFmt .
                " em {$dataPagamento->format('d/m/Y')}, utilizou {$mesesUsados} mês(es) do contrato." .
                " Restam {$mesesRestantes} mês(es) não utilizados." .
                " Deve ser realizado estorno no valor de R$ " . $valorEstornoFmt .
                " referente ao contrato {$idContrato}.";
        }

        $history = [
            'id_imobiliaria' => session('user')['id_imobiliaria'],
            'id_movi'        => $idContrato,
            'movi'           => 'Cancelamento',
            'data'           => now()->format('Y-m-d'),
            'hora'           => now()->format('H:i:s'),
            'id_usuario'     => session('user')['id'],
            'historico'      => $historico,
        ];

        // Histórico
        Http::withToken($token)->post(config('api.route') . '/history/create', $history);

        Http::withToken($token)->put(config('api.route') . '/canceled/' . $idContrato, $data);

        $this->sendWhatsApp($idContrato);

        return redirect()->route('assets.index');
    }
}
