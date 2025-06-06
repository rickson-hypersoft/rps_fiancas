<?php

declare(strict_types=1);

namespace App\Http\Controllers\Propostal;

use DateTime;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\EmailService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

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

        $response = Http::withToken($token)->get(config('api.route') . '/propostals/' . $idImobiliaria, $queryParams);
        $data     = $response->json();

        return view('propostal.index', ['propostals' => $data['data']]);
    }

    public function create(int | string | null $id = null): View
    {
        $proposta = null;

        if ($id) {
            $token    = session('jwt_token');
            $response = Http::withToken($token)->get(config('api.route') . '/propostal/' . $id);
            $proposta = $response->json();
        }

        return view('propostal.wizard', [
            'step'     => 'step1',
            'proposta' => $proposta,
        ]);
    }

    public function step2($id): View
    {
        $token = session('jwt_token');

        $response = Http::withToken($token)->get(config('api.route') . '/propostal/' . $id);
        $data     = $response->json();
        $styles   = $this->styleStep2($response->json());

        $responseSetup = Http::withToken($token)->get(config('api.route') . '/realestatesectorsetup/' . $data['id_imobiliaria']);
        $setups        = $responseSetup->json();

        $parseValorBR = function ($valor) {
            if (is_string($valor)) {
                $valor = str_replace(['R$', '.', ' ', ' '], '', $valor); // Remove R$, pontos, espaços normais e não-quebráveis
                $valor = str_replace(',', '.', $valor); // Troca vírgula por ponto
            }

            return floatval($valor);
        };

        $imovelAluguel    = $parseValorBR($data['imovel_aluguel'] ?? 0);
        $imovelCondominio = $parseValorBR($data['imovel_condominio'] ?? 0);
        $imovelTaxas      = $parseValorBR($data['imovel_taxas'] ?? 0);

        $valorTotal              = $imovelAluguel + $imovelCondominio + $imovelTaxas;
        $valorParcela            = $valorTotal / 12;
        $valorTotalFormatado     = 'R$ ' . number_format($valorTotal, 2, ',', '.');
        $valorFormatado          = 'R$ ' . number_format($valorParcela, 2, ',', '.');
        $data['valor_parcelado'] = $valorFormatado;
        $data['valor_total']     = $valorTotalFormatado;

        return view('propostal.wizard', [
            'step'     => 'step2',
            'proposta' => $data,
            'styles'   => $styles,
            'setups'   => $setups['data'],
        ]);
    }

    public function step3($id): View
    {
        $token = session('jwt_token');

        $response = Http::withToken($token)->get(config('api.route') . '/propostal/' . $id);
        $data     = $response->json();

        return view('propostal.wizard', [
            'step'     => 'step3',
            'proposta' => $data,
        ]);
    }

    public function step4($id): View
    {
        $token = session('jwt_token');

        $response = Http::withToken($token)->get(config('api.route') . '/propostal/' . $id);
        $data     = $response->json();

        $response    = Http::withToken($token)->get(config('api.route') . '/histories/' . $id);
        $dataHistory = $response->json();

        $this->insertHashLink($id);

        return view('propostal.wizard', [
            'step'      => 'step4',
            'proposta'  => $data,
            'histories' => $dataHistory['data'],
        ]);
    }

    public function step5($id): View
    {
        $token = session('jwt_token');

        $response = Http::withToken($token)->get(config('api.route') . '/propostal/' . $id);
        $data     = $response->json();

        if ($data['proposta_credito_status'] == 'Aprovado') {
            dd("trabalhar aqui");
        }

        $styles = $this->stylesStep5($data);

        return view('propostal.wizard', [
            'step'     => 'step5',
            'proposta' => $data,
            'styles'   => $styles,
        ]);
    }

    public function saveStep1(Request $request, int | string | null $id = null): JsonResponse
    {
        $requestSanitize = $this->sanitizeData(
            $request->all(),
            ['imovel_cep', 'pessoa_doc']
        );

        $requestSanitize['imovel_aluguel']    = floatval(str_replace(',', '.', str_replace('.', '', (string) ($requestSanitize['imovel_aluguel'] ?? '0'))));
        $requestSanitize['imovel_condominio'] = floatval(str_replace(',', '.', str_replace('.', '', (string) ($requestSanitize['imovel_condominio'] ?? '0'))));
        $requestSanitize['imovel_taxas']      = floatval(str_replace(',', '.', str_replace('.', '', (string) ($requestSanitize['imovel_taxas'] ?? '0'))));
        $requestSanitize['proposta_status']   = 'Rascunho';
        $requestSanitize['id_imobiliaria']    = session('user')['id_imobiliaria'];

        if ($requestSanitize['imovel_aluguel'] < 1500) {
            $requestSanitize['proposta_credito_status'] = 'Aprovado';
        }

        if ($requestSanitize['imovel_aluguel'] >= 1500 && $requestSanitize['imovel_aluguel'] <= 2500) {
            $requestSanitize['proposta_credito_status'] = 'Pendente';
        }

        if ($requestSanitize['imovel_aluguel'] > 2500) {
            $requestSanitize['proposta_credito_status'] = 'Negado';
        }

        $currentDate             = new DateTime();
        $requestSanitize['data'] = $currentDate->format('Y-m-d');
        $requestSanitize['hora'] = $currentDate->format('H:i:s');

        // Validação
        if (empty($requestSanitize['pessoa_doc'])) {
            return response()->json(['message' => 'Campo documento do inquilino precisa ser preenchido!'], 400);
        }

        if (empty($requestSanitize['pessoa_nome'])) {
            return response()->json(['message' => 'Campo nome do inquilino precisa ser preenchido!'], 400);
        }

        if (empty($requestSanitize['imovel_cep'])) {
            return response()->json(['message' => 'Campo CEP precisa ser preenchido!'], 400);
        }

        if (empty($requestSanitize['imovel_aluguel'])) {
            return response()->json(['message' => 'Campo valor aluguel precisa ser preenchido!'], 400);
        }

        if ($requestSanitize['imovel_aluguel'] < 100) {
            return response()->json(['message' => 'Campo valor aluguel precisa ser no mínimo de R$ 100,00!'], 400);
        }

        if ($requestSanitize['imovel_aluguel'] <= 0) {
            return response()->json(['message' => 'Campo valor aluguel inválido!'], 400);
        }

        $token = session('jwt_token');

        if ($id) {
            $requestSanitize['id'] = $id;
        }

        $response = Http::withToken($token)->post(config('api.route') . '/propostal/create', $requestSanitize);

        if (! $response->successful()) {
            return response()->json(['message' => 'Erro ao criar proposta na API 3'], 400);
        }

        $propostaId = $response->json(['data']);

        return response()->json([
            'success' => true,
            'message' => 'Proposta criada!',
            'data'    => [
                'id' => $propostaId['id'],
            ],
        ]);
    }

    public function saveStep2(Request $request, string | int $id): JsonResponse
    {
        $requestSanitize = $this->sanitizeData(
            $request->all(),
            []
        );

        if (empty($requestSanitize['setup'])) {
            return response()->json(['message' => 'Campo setup precisa ser preenchido!'], 400);
        }

        $token    = session('jwt_token');
        $response = Http::withToken($token)->get(config('api.route') . '/propostal/' . $id);
        $proposta = $response->json();

        $proposta['imovel_aluguel']    = $this->parseValor($proposta['imovel_aluguel'] ?? '0');
        $proposta['imovel_condominio'] = $this->parseValor($proposta['imovel_condominio'] ?? '0');
        $proposta['imovel_taxas']      = $this->parseValor($proposta['imovel_taxas'] ?? '0');

        $proposta['proposta_total_valor'] = $proposta['imovel_aluguel'] +
            $proposta['imovel_condominio'] +
            $proposta['imovel_taxas'];

        $currentDate                         = new DateTime();
        $proposta['data_ultima_autalizacao'] = $currentDate->format('Y-m-d');
        $proposta['hora_ultima_atualizacao'] = $currentDate->format('H:i:s');
        $proposta['proposta_setup_valor']    = $this->parseValor($requestSanitize['setup'] ?? '0');

        if ($proposta["pessoa_tipo"] == "Pessoa Física") {
            $proposta["pessoa_tipo"] = "pf";
        }

        if ($proposta["pessoa_tipo"] == "Pessoa Jurídica") {
            $proposta["pessoa_tipo"] = "pj";
        }

        if ($proposta["imovel_tipo"] == "Residencial") {
            $proposta["imovel_tipo"] = "R";
        }

        if ($proposta["imovel_tipo"] == "Comercial") {
            $proposta["imovel_tipo"] = "C";
        }

        $response = Http::withToken($token)->post(config('api.route') . '/propostal/create', $proposta);

        if (! $response->successful()) {
            return response()->json(['message' => 'Erro ao criar proposta na API'], 400);
        }

        $propostaId = $response->json(['data']);

        return response()->json([
            'success' => true,
            'message' => 'Proposta criada!',
            'data'    => [
                'id' => $propostaId['id'],
            ],
        ]);
    }

    public function saveStep3(Request $request, string | int $id): JsonResponse
    {
        $requestSanitize = $this->sanitizeData(
            $request->all(),
            []
        );

        if (empty($requestSanitize['imovel_endereco'])) {
            return response()->json(['message' => 'Campo endereço precisa ser preenchido!'], 400);
        }

        if (empty($requestSanitize['imovel_bairro'])) {
            return response()->json(['message' => 'Campo bairro precisa ser preenchido!'], 400);
        }

        if (empty($requestSanitize['imovel_numero'])) {
            return response()->json(['message' => 'Campo número precisa ser preenchido!'], 400);
        }

        if (empty($requestSanitize['imovel_complemento'])) {
            return response()->json(['message' => 'Campo complemento precisa ser preenchido!'], 400);
        }

        if (empty($requestSanitize['imovel_subtipo'])) {
            return response()->json(['message' => 'Campo sub-tipo do imóvel precisa ser preenchido!'], 400);
        }

        if (empty($requestSanitize['data_nascimento'])) {
            return response()->json(['message' => 'Campo data de nascimento precisa ser preenchido!'], 400);
        }

        if (empty($requestSanitize['pessoa_email'])) {
            return response()->json(['message' => 'Campo e-mail precisa ser preenchido!'], 400);
        }

        if (empty($requestSanitize['pessoa_telefone'])) {
            return response()->json(['message' => 'Campo telefone precisa ser preenchido!'], 400);
        }

        $token    = session('jwt_token');
        $response = Http::withToken($token)->get(config('api.route') . '/propostal/' . $id);
        $proposta = $response->json();

        $proposta['imovel_tag']              = $requestSanitize['imovel_tag'] ?? null;
        $proposta['observacao']              = $requestSanitize['observacao'] ?? null;
        $proposta['pessoa_telefone']         = $requestSanitize['pessoa_telefone'];
        $proposta['imovel_endereco']         = $requestSanitize['imovel_endereco'];
        $proposta['imovel_bairro']           = $requestSanitize['imovel_bairro'];
        $proposta['imovel_numero']           = $requestSanitize['imovel_numero'];
        $proposta['imovel_complemento']      = $requestSanitize['imovel_complemento'];
        $proposta['imovel_subtipo']          = $requestSanitize['imovel_subtipo'];
        $proposta['data_nascimento']         = $requestSanitize['data_nascimento'];
        $proposta['pessoa_email']            = $requestSanitize['pessoa_email'];
        $proposta['pessoa_telefone']         = $requestSanitize['pessoa_telefone'];
        $proposta['imovel_ramo_atv']         = $requestSanitize['imovel_ramo_atv'];
        $currentDate                         = new DateTime();
        $proposta['data_ultima_autalizacao'] = $currentDate->format('Y-m-d');
        $proposta['hora_ultima_atualizacao'] = $currentDate->format('H:i:s');

        $this->saveHistory($proposta, "Aprovado");

        $proposta['imovel_aluguel']       = $this->parseValor($proposta['imovel_aluguel'] ?? '0');
        $proposta['imovel_condominio']    = $this->parseValor($proposta['imovel_condominio'] ?? '0');
        $proposta['imovel_taxas']         = $this->parseValor($proposta['imovel_taxas'] ?? '0');
        $proposta['proposta_total_valor'] = $this->parseValor($proposta['proposta_total_valor'] ?? '0');
        $proposta['proposta_setup_valor'] = $this->parseValor($proposta['proposta_setup_valor'] ?? '0');

        if ($proposta["pessoa_tipo"] == "Pessoa Física") {
            $proposta["pessoa_tipo"] = "pf";
        }

        if ($proposta["pessoa_tipo"] == "Pessoa Jurídica") {
            $proposta["pessoa_tipo"] = "pj";
        }

        if ($proposta["imovel_tipo"] == "Residencial") {
            $proposta["imovel_tipo"] = "R";
        }

        if ($proposta["imovel_tipo"] == "Comercial") {
            $proposta["imovel_tipo"] = "C";
        }

        $response = Http::withToken($token)->post(config('api.route') . '/propostal/create', $proposta);

        if (! $response->successful()) {
            return response()->json(['message' => 'Erro ao criar proposta na API'], 400);
        }

        $propostaId    = $response->json(['data']);
        $id            = $response->json(['data'])['id'];
        $idImobiliaria = $propostaId['id_imobiliaria'];

        if ($request->hasFile('imagens') && $id) {
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

                    $caminho   = "anexos/{$idImobiliaria}/propostas/{$id}.{$ext}";
                    $nomeUnico = uniqid($id . '_') . '.' . $ext;
                    // Salva o arquivo localmente
                    $file->storeAs("anexos/{$idImobiliaria}/propostas", $nomeUnico, 'public');

                    // Chamada para a API registrar o anexo no banco
                    Http::withToken($token)->post(config('api.route') . '/financial/attachment', [
                        'id_imobiliaria'        => $idImobiliaria,
                        'id_movi'               => $id,
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

        return response()->json([
            'success' => true,
            'message' => 'Proposta criada!',
            'data'    => [
                'id' => $propostaId['id'],
            ],
        ]);
    }

    public function delete(Request $request, string | int $id): Response
    {
        $token = session('jwt_token');

        $motivo = $request->input('motivo');
        $motivoOpicional = $request->input('motivo_opicional');

        $requestSanitize['id_imobiliaria']          = session('user')['id_imobiliaria'];
        $requestSanitize['proposta_status']         = 'Cancelado';
        $requestSanitize['proposta_credito_status'] = 'Cancelado';

        $historico = "Solicitação cancelada #{$id} por motivo de {$motivo}";
        if ($motivoOpicional) {
            $historico = "Solicitação cancelada #{$id} por motivo de {$motivo}, explicação: {$motivoOpicional}";
        }

        $proposta = [
            "id_imobiliaria" => session('user')['id_imobiliaria'],
            "id_movi"        => $id,
            "id_usuario"      => session('user')['id'],
            "data"           => date('Y-m-d H:i:s'),
            'historico'      => $historico,
            "movi"           => "Proposta"
        ];

        $this->saveHistory($proposta, "Cancelado");

        $response = Http::withToken($token)->post(config('api.route') . '/propostal/canceled/' . $id, $requestSanitize);

        return $response;
    }

    private function styleStep2($data): array
    {
        switch ($data['proposta_credito_status']) {
            case 'Aprovado':
                return [
                    'colorText'    => 'fw-bold text-success',
                    'text'         => 'Crédito aprovado!',
                    'card'         => 'content-header mb-4 p-5 bg-success text-white',
                    'icon'         => 'menu-icon icon-base ti tabler-check',
                    'badge'        => 'Simulação',
                    'detalhamento' => "O inquilino {$data['pessoa_nome']} do CPF {$data['pessoa_doc']} está aprovado para uma locação com garantia de um imóvel {$data['imovel_tipo']}, na cidade de {$data['imovel_cidade']} - {$data['imovel_estado']}",
                    'displaySetup' => 'block',
                    'cardStyle'    => '',
                ];

            case 'Pendente':
                return [
                    'colorText'    => 'fw-bold text-warning',
                    'text'         => 'Crédito pendente de análise!',
                    'card'         => 'content-header mb-4 p-5 text-white',
                    'cardStyle'    => 'background: #FFA600;',
                    'icon'         => 'menu-icon icon-base ti tabler-clock',
                    'badge'        => 'Simulação',
                    'detalhamento' => "O inquilino {$data['pessoa_nome']} do CPF {$data['pessoa_doc']} está pendente de uma análise manual para uma locação com garantia de um imóvel {$data['imovel_tipo']}, na cidade de {$data['imovel_cidade']} - {$data['imovel_estado']}",
                    'displaySetup' => 'block',
                ];

            default:
                return [
                    'colorText'    => 'fw-bold text-secondary',
                    'text'         => 'Crédito reprovado para fiança!',
                    'card'         => 'content-header mb-4 p-5 bg-secondary text-white',
                    'icon'         => 'menu-icon icon-base ti tabler-x',
                    'badge'        => 'Reprovado',
                    'detalhamento' => "O inquilino {$data['pessoa_nome']} do CPF {$data['pessoa_doc']} está reprovado para uma locação com garantia de um imóvel {$data['imovel_tipo']}, na cidade de {$data['imovel_cidade']} - {$data['imovel_estado']}",
                    'displaySetup' => 'none',
                    'cardStyle'    => '',
                ];
        }
    }

    private function stylesStep5($data): array
    {
        switch ($data['proposta_credito_status']) {
            case 'Aprovado':
                return [
                    'colorText'     => 'fw-bold text-success',
                    'text'          => 'A proposta enviada e aguardando ativação pelo inquilino.',
                    'paragrapfCard' => 'A ativação do contrato locação com garantia da Invicta é efetivada mediante o aceite dos termos e pagamento. Enviamos os próximos passos para o e-mail e WhatsApp da pessoa inquilina.',
                    'card'          => 'content-header mb-4 p-5 bg-success text-white',
                    'cardStyle'     => '',
                ];

            case 'Pendente':
                return [
                    'colorText'     => 'fw-bold text-warning',
                    'text'          => 'A proposta está em análise manual pelo nosso time interno.',
                    'paragrapfCard' => 'Estaremos em contato através da nossa plataforma e por e-mail para dar retorno em até 30 minutos.',
                    'card'          => 'content-header mb-4 p-5 text-white',
                    'cardStyle'     => 'background-color: #FFA600;',
                ];

            case 'Negado':
                return [
                    'colorText'     => 'fw-bold text-secondary',
                    'text'          => 'A proposta foi negada após análise.',
                    'paragrapfCard' => 'Estaremos em contato através da nossa plataforma e por e-mail para dar retorno em até 30 minutos.',
                    'card'          => 'content-header mb-4 p-5 bg-secondary text-white',
                    'cardStyle'     => '',
                ];

            default:
                return [
                    'colorText'     => 'fw-bold text-muted',
                    'text'          => 'Status da proposta desconhecido.',
                    'paragrapfCard' => '',
                    'card'          => 'content-header mb-4 p-5 bg-light text-dark',
                    'cardStyle'     => '',
                ];
        }
    }

    private function parseValor(string $valor): float
    {
        // Remove 'R$', espaços, pontos de milhar e converte vírgula decimal para ponto
        $limpo = str_replace(['R$', ' ', '.'], '', $valor);
        $limpo = str_replace(',', '.', $limpo);

        return floatval($limpo);
    }

    private function saveHistory($data, $status = "")
    {
        $token   = session('jwt_token');
        if ($status == "Aprovado") {
            $dataCriacao = str_replace('/', '-', $data['data']);
            $dataCriacao .= " {$data['hora']}";

            $convertDateTime = new DateTime($dataCriacao);

            $history = [
                'id_imobiliaria' => $data['id_imobiliaria'],
                'id_movi'        => $data['id'],
                'movi'           => 'Proposta',
                'data'           => $convertDateTime->format('Y-m-d H:i'),
                'id_usuario'     => session('user')['id'],
                'historico'      => "Criada Solicitação #{$data['id']} do tipo {$data['imovel_tipo']}, com setup de {$data['proposta_setup_valor']} e valor do aluguel {$data['imovel_aluguel']}, valor do condomínio {$data['imovel_condominio']}, valor das taxas {$data['imovel_taxas']}, totalizando {$data['proposta_total_valor']}. O imóvel está situado no endereço {$data['endereco_completo']}, cujo CEP é {$data['imovel_cep']}",
            ];

            Http::withToken($token)->post(config('api.route') . '/history/create', $history);
        }

        if ($status = 'Cancelado') {
            Http::withToken($token)->post(config('api.route') . '/history/create', $data);
        }
    }

    private function insertHashLink(string|int $id)
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)->post(config('api.route') . '/propostal/hash/' . $id);

        if (!$response->successful()) {
            return response()->json("Hash não criado com sucesso");
        }

        return response()->json("Hash criado com sucesso");
    }

    public function sendNotification(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $link = $request->input('link');

        if ($this->emailService->send($email, $name, $link)) {
            return response()->json(['mensagem' => 'E-mail enviado com sucesso!']);
        }

        return response()->json(['erro' => 'Falha ao enviar o e-mail.'], 500);
    }
}