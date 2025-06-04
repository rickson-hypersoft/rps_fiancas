<?php

declare(strict_types=1);

namespace App\Http\Controllers\Propostal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PropostalController extends Controller
{
    public function index(Request $request)
    {
        $token         = session('jwt_token');
        $idImobiliaria = session('user')['id_imobiliaria'];

        $queryParams = [
            'search'     => $request->input('search'),
            'status'     => $request->input('status'),
            'created_at' => $request->input('created_at'),
        ];

        $response = Http::withToken($token)->get(env('API_ROUTE') . '/propostal/' . $idImobiliaria, $queryParams);
        $data     = $response->json();

        return view('propostal.index', ['propostals' => $data['data']]);
    }

    public function create()
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)->get(env('API_ROUTE') . '/realestatesectorsetup/' . session('user')['id_imobiliaria']);
        $setups   = $response->json()['data'];

        return view('propostal.form', ['setups' => $setups]);
    }

    public function find(string | int $id)
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)->get(env('API_ROUTE') . '/propostal/propostal/' . $id);

        return $response;
    }

    public function store(Request $request)
    {
        $requestSanitize                      = $this->sanitizeData($request->all(), ['proposta_total_valor', 'proposta_setup_valor', 'imovel_cep', 'pessoa_doc']);
        $requestSanitize['imovel_aluguel'] = floatval(str_replace(',', '.', str_replace('.', '', (string) ($requestSanitize['imovel_aluguel'] ?? '0'))));
        $requestSanitize['imovel_condominio'] = floatval(str_replace(',', '.', str_replace('.', '', (string) ($requestSanitize['imovel_condominio'] ?? '0'))));
        $requestSanitize['imovel_taxas'] = floatval(str_replace(',', '.', str_replace('.', '', (string) ($requestSanitize['imovel_taxas'] ?? '0'))));

        if (isset($requestSanitize['proposta_total_valor']) || isset($requestSanitize['proposta_setup_valor'])) {
            $requestSanitize['proposta_total_valor'] = floatval((string) ($requestSanitize['proposta_total_valor'] ?? '0'));
            $requestSanitize['proposta_setup_valor'] = floatval((string) ($requestSanitize['proposta_setup_valor'] ?? '0'));
        }

        $token = session('jwt_token');

        $response = Http::withToken($token)->post(env('API_ROUTE') . '/propostal/propostal/create', $requestSanitize);

        $data          = $response->json();
        $propostaId    = $data['data']['id'] ?? null;
        $idImobiliaria = $requestSanitize['id_imobiliaria'];

        if ($request->hasFile('imagens') && $propostaId) {
            foreach ($request->file('imagens') as $file) {
                if ($file->isValid()) {
                    $ext          = $file->getClientOriginalExtension();
                    $nomeOriginal = $file->getClientOriginalName();

                    // Verifica se o anexo já existe para essa proposta
                    $verificaAnexo = Http::withToken($token)->get(env('API_ROUTE') . '/financial/attachment/exists', [
                        'id_imobiliaria' => $idImobiliaria,
                        'id_movi'        => $propostaId,
                        'nome_arquivo'   => $nomeOriginal,
                    ]);

                    if ($verificaAnexo->ok() && ($verificaAnexo->json()['exists'] ?? false)) {
                        continue; // pula para o próximo arquivo
                    }

                    $caminho   = "anexos/{$idImobiliaria}/propostas/{$propostaId}.{$ext}";
                    $nomeUnico = uniqid($propostaId . '_') . '.' . $ext;
                    // Salva o arquivo localmente
                    $file->storeAs("anexos/{$idImobiliaria}/propostas", $nomeUnico, 'public');

                    // Chamada para a API registrar o anexo no banco
                    Http::withToken($token)->post(env('API_ROUTE') . '/financial/attachment', [
                        'id_imobiliaria'        => $idImobiliaria,
                        'id_movi'               => $propostaId,
                        'movi'                  => 'propostas',
                        'movi_sub'              => null,
                        'data'                  => now()->format('Y-m-d H:i:s'),
                        'nome_arquivo'          => $nomeUnico,
                        'nome_arquivo_original' => $nomeOriginal,
                        'descricao'             => 'Arquivo anexado à proposta',
                    ]);
                }
            }
        }

        return $response;
    }

    public function resume(string | int $id)
    {
        return view('propostal.resume');
    }

    public function delete(Request $request, string | int $id)
    {
        $token = session('jwt_token');

        $requestSanitize['id_imobiliaria']          = session('user')['id_imobiliaria'];
        $requestSanitize['proposta_status']         = 'Cancelado';
        $requestSanitize['proposta_credito_status'] = 'Cancelado';
        $requestSanitize['observacao']              = $request->input('motivo');

        $response = Http::withToken($token)->post(env('API_ROUTE') . '/propostal/propostal/canceled/' . $id, $requestSanitize);

        return $response;
    }
}
