<?php

declare(strict_types=1);

namespace App\Http\Controllers\Propostal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class PropostalController extends Controller
{
    public function index()
    {
        return view('propostal.index');
    }

    public function create()
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)->get(getenv('API_ROUTE') . '/realestatesectorsetup/' . session('user')['id_imobiliaria']);
        $setups = $response->json()['data'];

        return view('propostal.form', ['setups' => $setups]);
    }

    public function find(string|int $id)
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)->get(getenv('API_ROUTE') . '/propostal/propostal/' . $id);

        return $response;
    }

    public function store(Request $request)
    {
        $requestSanitize = $this->sanitizeData($request->all(), ['proposta_total_valor', 'proposta_setup_valor', 'imovel_cep', 'pessoa_doc']);
        $requestSanitize['imovel_aluguel'] = floatval($requestSanitize['imovel_aluguel']);
        $requestSanitize['imovel_condominio'] = floatval($requestSanitize['imovel_condominio']);
        $requestSanitize['imovel_taxas'] = floatval($requestSanitize['imovel_taxas']);

        if (isset($requestSanitize['proposta_total_valor']) || isset($requestSanitize['proposta_setup_valor'])) {
            $requestSanitize['proposta_total_valor'] = floatval($requestSanitize['proposta_total_valor']);
            $requestSanitize['proposta_setup_valor'] = floatval($requestSanitize['proposta_setup_valor']);
        }

        $token    = session('jwt_token');

        $response = Http::withToken($token)->post(getenv('API_ROUTE') . '/propostal/propostal/create', $requestSanitize);

        $data = $response->json();
        $propostaId = $data['data']['id'] ?? null;
        $idImobiliaria = $requestSanitize['id_imobiliaria'];

        if ($request->hasFile('imagens') && $propostaId) {
            foreach ($request->file('imagens') as $file) {
                if ($file->isValid()) {
                    $ext = $file->getClientOriginalExtension();
                    $nomeOriginal = $file->getClientOriginalName();

                    // Verifica se o anexo já existe para essa proposta
                    $verificaAnexo = Http::withToken($token)->get(getenv('API_ROUTE') . '/financial/attachment/exists', [
                        'id_imobiliaria' => $idImobiliaria,
                        'id_movi'        => $propostaId,
                        'nome_arquivo'   => $nomeOriginal,
                    ]);


                    if ($verificaAnexo->ok() && ($verificaAnexo->json()['exists'] ?? false)) {
                        continue; // pula para o próximo arquivo
                    }

                    $caminho = "anexos/{$idImobiliaria}/propostas/{$propostaId}.{$ext}";
                    $nomeUnico = uniqid($propostaId . '_') . '.' . $ext;
                    // Salva o arquivo localmente
                    $file->storeAs("anexos/{$idImobiliaria}/propostas", $nomeUnico, 'public');

                    // Chamada para a API registrar o anexo no banco
                    Http::withToken($token)->post(getenv('API_ROUTE') . '/financial/attachment', [
                        'id_imobiliaria' => $idImobiliaria,
                        'id_movi'        => $propostaId,
                        'movi'           => 'propostas',
                        'movi_sub'       => null,
                        'data'           => now()->format('Y-m-d H:i:s'),
                        'nome_arquivo'   => $nomeUnico,
                        'nome_arquivo_original'            => $nomeOriginal,
                        'descricao'      => 'Arquivo anexado à proposta'
                    ]);
                }
            }
        }

        return $response;
    }

    public function resume(string|int $id)
    {
        return view('propostal.resume');
    }
}