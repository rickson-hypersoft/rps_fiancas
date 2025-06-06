<?php

declare(strict_types=1);

namespace App\Http\Controllers\Propostal;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\EmailService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response as ClientResponse;

class PropostalController extends Controller
{
    public function __construct(protected EmailService $emailService) {}

    public function index(Request $request): View
    {
        $token         = session('jwt_token');
        $idImobiliaria = session('user')['id_imobiliaria'];

        $queryParams = [
            'search'     => $request->input('search'),
            'status'     => $request->input('status'),
            'created_at' => $request->input('created_at'),
        ];

        $response = Http::withToken($token)->get(config('api.route') . '/propostal/' . $idImobiliaria, $queryParams);
        $data     = $response->json();

        return view('propostal.index', ['propostals' => $data['data']]);
    }

    public function create(): View
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)->get(config('api.route') . '/realestatesectorsetup/' . session('user')['id_imobiliaria']);
        $setups   = $response->json()['data'];

        return view('propostal.form', ['setups' => $setups]);
    }

    public function find(string | int $id): ClientResponse
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)->get(config('api.route') . '/propostal/propostal/' . $id);

        return $response;
    }

    public function store(Request $request): ClientResponse
    {
        $requestSanitize                      = $this->sanitizeData(
            $request->all(),
            ['proposta_total_valor', 'proposta_setup_valor', 'imovel_cep', 'pessoa_doc']
        );

        $requestSanitize['imovel_aluguel']    = floatval(str_replace(',', '.', str_replace('.', '', (string) ($requestSanitize['imovel_aluguel'] ?? '0'))));
        $requestSanitize['imovel_condominio'] = floatval(str_replace(',', '.', str_replace('.', '', (string) ($requestSanitize['imovel_condominio'] ?? '0'))));
        $requestSanitize['imovel_taxas']      = floatval(str_replace(',', '.', str_replace('.', '', (string) ($requestSanitize['imovel_taxas'] ?? '0'))));

        if (isset($requestSanitize['proposta_total_valor']) || isset($requestSanitize['proposta_setup_valor'])) {
            $requestSanitize['proposta_total_valor'] = floatval((string) ($requestSanitize['proposta_total_valor'] ?? '0'));
            $requestSanitize['proposta_setup_valor'] = floatval((string) ($requestSanitize['proposta_setup_valor'] ?? '0'));
        }

        $token = session('jwt_token');

        $response = Http::withToken($token)->post(config('api.route') . '/propostal/propostal/create', $requestSanitize);

        $data          = $response->json();
        $propostaId    = $data['data']['id'] ?? null;
        $idImobiliaria = $requestSanitize['id_imobiliaria'];

        if ($request->hasFile('imagens') && $propostaId) {
            foreach ($request->file('imagens') as $file) {
                if ($file->isValid()) {
                    $ext          = $file->getClientOriginalExtension();
                    $nomeOriginal = $file->getClientOriginalName();

                    // Verifica se o anexo já existe para essa proposta
                    $verificaAnexo = Http::withToken($token)->get(config('api.route') . '/financial/attachment/exists', [
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
                    Http::withToken($token)->post(config('api.route') . '/financial/attachment', [
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

    public function resume(string | int $id): View
    {
        $token = session('jwt_token');

        $response = Http::withToken($token)->get(config('api.route') . '/propostal/propostal/' . $id);
        $data = $response->json();

        return view('propostal.resume', ['resume' => $data]);
    }

    public function delete(Request $request, string | int $id): ClientResponse
    {
        $token = session('jwt_token');

        $requestSanitize['id_imobiliaria']          = session('user')['id_imobiliaria'];
        $requestSanitize['proposta_status']         = 'Cancelado';
        $requestSanitize['proposta_credito_status'] = 'Cancelado';
        $requestSanitize['observacao']              = $request->input('motivo');

        $response = Http::withToken($token)->post(config('api.route') . '/propostal/propostal/canceled/' . $id, $requestSanitize);

        return $response;
    }

    public function sendNotification()
    {
        $dados = [
            'nome' => 'João',
            'mensagem' => 'Sua conta foi ativada.'
        ];

        $email = 'rickson@hypersoft.com.br';

        if ($this->emailService->send($dados, $email)) {
            return response()->json(['mensagem' => 'E-mail enviado com sucesso!']);
        }

        return response()->json(['erro' => 'Falha ao enviar o e-mail.'], 500);
    }
}
