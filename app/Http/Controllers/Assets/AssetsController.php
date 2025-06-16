<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Assets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AssetsController extends Controller
{
    public function index(Request $request): View
    {
        $token         = session('jwt_token');
        $idImobiliaria = session('user')['id_imobiliaria'];

        $queryParams = [
            'search'     => $request->input('search'),
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

        return view('assets.index', ['statusContagem' => $statusContagem, 'contratos' => $data['data']]);
    }

    public function find(string $idContrato): View
    {
        $token = session('jwt_token');

        $response = Http::withToken($token)->get(config('api.route') . '/assets/' . session('user')['id_imobiliaria'] . '/' . $idContrato);
        $data     = $response->json();

        $response    = Http::withToken($token)->get(config('api.route') . '/histories/' . $idContrato);
        $dataHistory = $response->json();

        return view('assets.asset', ['data' => $data['data'], 'histories' => $dataHistory['data']]);
    }

    public function edit(string $idContrato): View
    {
        $token = session('jwt_token');

        $response = Http::withToken($token)->get(config('api.route') . '/assets/' . session('user')['id_imobiliaria'] . '/' . $idContrato);
        $data     = $response->json();

        return view('assets.edit', ['data' => $data['data']]);
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
                    Http::withToken($token)->post(config('api.route') . '/propostal/create', $parserPropostal);
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

        return back()->with('success', 'Arquivos enviados com sucesso!');
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

        return response()->file(storage_path("app/public/{$caminho}"));
    }
}
