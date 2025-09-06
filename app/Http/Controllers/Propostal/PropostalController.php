<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Propostal;

use App\Http\Controllers\Controller;
use App\Services\EmailService;
use Barryvdh\DomPDF\Facade\Pdf;
use DateTime;
use Illuminate\Http\Client\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PropostalController extends Controller
{
    public function __construct(protected EmailService $emailService)
    {
    }

    public function index(Request $request): View
    {
        $token         = session('jwt_token');
        $idImobiliaria = session('user')['id_imobiliaria'];

        $requestSanitize = $this->sanitizeData($request->all(), ['search']);

        $queryParams = [
            'search'     => $requestSanitize['search'] ?? null,
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

        if ($id !== 0 && ($id !== '' && $id !== '0')) {
            $token    = session('jwt_token');
            $response = Http::withToken($token)->get(config('api.route') . '/propostal/' . $id);
            $proposta = $response->json();
        }

        return view('propostal.wizard', [
            'step'     => 'step1',
            'proposta' => $proposta,
        ]);
    }

    public function step2(string | int $id): View
    {
        $token = session('jwt_token');

        $response = Http::withToken($token)->get(config('api.route') . '/propostal/' . $id);
        $data     = $response->json();
        $styles   = $this->styleStep2($response->json());

        $responseSetup = Http::withToken($token)->get(config('api.route') . '/realestatesectorsetup/' . $data['id_imobiliaria']);
        $setups        = $responseSetup->json();

        $parseValorBR = function ($valor): float {
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

        $checkScore = Http::withToken($token)->get(config('api.route') . '/consultar-score', [
            'document' => $data['pessoa_doc'],
        ])->json();

        return view('propostal.wizard', [
            'step'      => 'step2',
            'proposta'  => $data,
            'styles'    => $styles,
            'setups'    => $setups['data'],
            'scoreData' => $checkScore,
        ]);
    }

    public function step3(string | int $id)
    {
        $token = session('jwt_token');

        $this->insertHashLink($id);

        $response = Http::withToken($token)->get(config('api.route') . '/propostal/' . $id);
        $data     = $response->json();

        if ($data['proposta_credito_status'] == 'Reprovado') {
            return redirect()->route('propostal.step2', ['id' => $id]);
        }

        return view('propostal.wizard', [
            'step'     => 'step3',
            'proposta' => $data,
        ]);
    }

    public function step4(string | int $id)
    {
        $token = session('jwt_token');

        $responseProposta               = Http::withToken($token)->get(config('api.route') . '/propostal/' . $id);
        $dataProposta                   = $responseProposta->json();
        $dataProposta['total_contrato'] = $this->parseValor($dataProposta['proposta_total_valor']) + $this->parseValor($dataProposta['proposta_setup_valor']);

        $html = view('activation.term-view', [
            'linkHash' => $dataProposta['link_hash'],
            'data'     => $dataProposta,
        ])->render();

        // gera o PDF com Browsershot
        $pdfContent = Pdf::loadHTML($html)
            ->setPaper('a4')
            ->output();

        $response = Http::attach(
            'file',                   // nome do campo
            $pdfContent,              // conteúdo do arquivo
            "{$dataProposta['link_hash']}.pdf"         // nome do arquivo
        )->withToken($token)->post(config('api.route') . '/activation/upload-term', [
            'link_hash' => $dataProposta['link_hash'],
        ]);

        if (! $response->successful()) {
            dd($response->body());
        }

        $response    = Http::withToken($token)->get(config('api.route') . '/histories/' . $id);
        $dataHistory = $response->json();

        if ($dataProposta['proposta_credito_status'] == 'Reprovado') {
            return redirect()->route('propostal.step2', ['id' => $id]);
        }

        // Criar fluxo de recuperar link para acessar
        // Enviar o link do assertiva no lugar
        if (! $dataProposta['link_facial']) {
            $response = Http::withToken($token)->get(config('api.route') . '/criar-assinatura/' . $id);
            $data = $response->json();
        } else {
            $data = $dataProposta;
        }

        return view('propostal.wizard', [
            'step'      => 'step4',
            'proposta'  => $data,
            'histories' => $dataHistory['data'],
        ]);
    }

    public function step5(string | int $id)
    {
        $token = session('jwt_token');

        $response = Http::withToken($token)->get(config('api.route') . '/propostal/' . $id);
        $data     = $response->json();

        if ($data['proposta_credito_status'] == 'Reprovado') {
            return redirect()->route('propostal.step2', ['id' => $id]);
        }

        $dataResponse = [];

        if ($data['proposta_status'] == 'Aprovado') {
            $proposta = $this->parserValuesForInsert($data);

            $proposta['contrato_status']     = 'Pendente';
            $proposta['contrato_sub_status'] = 'Em análise biométrica';

            $dataResponse = Http::withToken($token)->post(config('api.route') . '/propostal/create', $proposta);
        }

        if ($data['proposta_status'] == 'Alteração Imobiliária') {
            $data['proposta_status'] = 'Aprovado';
            $proposta                = $this->parserValuesForInsert($data);

            $proposta['contrato_status']     = 'Pendente';
            $proposta['contrato_sub_status'] = 'Em análise biométrica';

            $dataResponse = Http::withToken($token)->post(config('api.route') . '/propostal/create', $proposta);
        }

        if ($data['proposta_status'] != 'Aprovado') {
            $styles = $this->stylesStep5($data);

            return view('propostal.wizard', [
                'step'     => 'step5',
                'proposta' => $data,
                'styles'   => $styles,
            ]);
        }

        $styles = $this->stylesStep5($dataResponse->json()['data']);

        $proposta = [
            "id_imobiliaria" => session('user')['id_imobiliaria'],
            "id_movi"        => $id,
            "id_usuario"     => session('user')['id'],
            "data"           => date('Y-m-d'),
            "hora"           => date('H:i:s'),
            'historico'      => "Proposta nº{$id} criada com sucesso e enviada por e-mail e WhatsApp, aguardando ativação do contrato pelo inquilino.",
            "movi"           => "Proposta",
        ];

        $this->saveHistory([
            $proposta,
        ], 'Contrato');

        return view('propostal.wizard', [
            'step'     => 'step5',
            'proposta' => $dataResponse->json()['data'],
            'styles'   => $styles,
        ]);
    }

    public function saveStep1(Request $request, int | string | null $id = null): JsonResponse
    {
        $token = session('jwt_token');

        $requestSanitize = $this->sanitizeData(
            $request->all(),
            ['imovel_cep', 'pessoa_doc']
        );

        $requestSanitize['imovel_aluguel']    = floatval(str_replace(',', '.', str_replace('.', '', (string) ($requestSanitize['imovel_aluguel'] ?? '0'))));
        $requestSanitize['imovel_condominio'] = floatval(str_replace(',', '.', str_replace('.', '', (string) ($requestSanitize['imovel_condominio'] ?? '0'))));
        $requestSanitize['imovel_taxas']      = floatval(str_replace(',', '.', str_replace('.', '', (string) ($requestSanitize['imovel_taxas'] ?? '0'))));
        $requestSanitize['proposta_status']   = 'Rascunho';
        $requestSanitize['id_imobiliaria']    = session('user')['id_imobiliaria'];

        $requestSanitize['data'] = date('Y-m-d');
        $requestSanitize['hora'] = date('H:i:s');

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

        if (! $this->validaCpf($requestSanitize['pessoa_doc'])) {
            return response()->json(['message' => 'Campo cpf inválido!'], 400);
        }

        $checkScore = Http::withToken($token)->get(config('api.route') . '/consultar-score', [
            'document' => $requestSanitize['pessoa_doc'],
        ])->json();

        if (isset($checkScore['message'])) {
            return response()->json(['message' => $checkScore['message']], 400);
        }
        $score = $checkScore['score_pontos'];

        if ($score >= 700) {
            $requestSanitize['proposta_credito_status'] = 'Aprovado';
        }

        if ($score > 400 && $score < 700) {
            $requestSanitize['proposta_credito_status'] = 'Pendente Análise';
        }

        if ($score <= 400) {
            $requestSanitize['proposta_status']         = 'Reprovado';
            $requestSanitize['proposta_credito_status'] = 'Reprovado';
            $historico                                  = [
                "id_imobiliaria" => session('user')['id_imobiliaria'],
                "id_movi"        => $id,
                "id_usuario"     => session('user')['id'],
                "data"           => date('Y-m-d'),
                "hora"           => date('H:i:s'),
                'historico'      => "Proposta negada para o Inquilino {$requestSanitize['pessoa_nome']} devido ao score estar abaixo do aceitável",
                "movi"           => "Proposta",
            ];
            $this->saveHistory(
                $historico,
                "Reprovado"
            );
        }

        if ($id !== 0 && ($id !== '' && $id !== '0')) {
            $requestSanitize['id'] = $id;
        }

        $response = Http::withToken($token)->post(config('api.route') . '/propostal/create', $requestSanitize);

        if (! $response->successful()) {
            return response()->json(['message' => 'Erro ao criar proposta na API'], 400);
        }

        $propostaId = $response->json()['data'];

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

        if ($requestSanitize['setup'] == 1) {
            $requestSanitize['setup'] = 0;
        }

        $token    = session('jwt_token');
        $response = Http::withToken($token)->get(config('api.route') . '/propostal/' . $id);
        $proposta = $response->json();

        $proposta['imovel_aluguel']    = $this->parseValor($proposta['imovel_aluguel'] ?? '0');
        $proposta['imovel_condominio'] = $this->parseValor($proposta['imovel_condominio'] ?? '0');
        $proposta['imovel_taxas']      = $this->parseValor($proposta['imovel_taxas'] ?? '0');

        /*
        $proposta['proposta_total_valor'] = $proposta['imovel_aluguel'] +
            $proposta['imovel_condominio'] +
            $proposta['imovel_taxas'];
        */
        $imobiliaria = Http::withToken(session('jwt_token'))->get(config('api.route') . '/realestatesector/' . session('user')['id_imobiliaria']);
        $taxaPadrao                       = $imobiliaria->json()['data']['taxa_padrao'];
        $taxaPadraoFormatada              = floatval($taxaPadrao) / 100;
        $cobertura                        = 12;
        $proposta['proposta_total_valor'] = $proposta['imovel_aluguel'] * $taxaPadraoFormatada * $cobertura;

        $currentDate                         = new DateTime();
        $proposta['data_ultima_atualizacao'] = $currentDate->format('Y-m-d');
        $proposta['hora_ultima_atualizacao'] = $currentDate->format('H:i:s');

        $proposta['proposta_setup_valor'] = $requestSanitize['setup'] != 0 ? $this->parseValor($requestSanitize['setup']) : 0;

        if ($proposta["pessoa_tipo"] == "Pessoa Física") {
            $proposta["pessoa_tipo"] = "PF";
        }

        if ($proposta["pessoa_tipo"] == "Pessoa Jurídica") {
            $proposta["pessoa_tipo"] = "PJ";
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

        $propostaId = $response->json()['data'];

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
        $proposta['data_ultima_atalizacao']  = $currentDate->format('Y-m-d');
        $proposta['hora_ultima_atualizacao'] = $currentDate->format('H:i:s');

        $parserPropostal = $this->parserValuesForInsert($proposta);

        $proposta['endereco_completo'] = "{$proposta['imovel_endereco']}, {$proposta['imovel_numero']}, {$proposta['imovel_bairro']}, {$proposta['imovel_cidade']} - {$proposta['imovel_estado']}";

        if ($parserPropostal['proposta_credito_status'] != 'Pendente Análise') {
            $parserPropostal['proposta_status'] = 'Aprovado';
        }

        if ($parserPropostal['proposta_credito_status'] == 'Pendente Análise') {
            $parserPropostal['proposta_status'] = 'Pendente Análise';
            $parserPropostal['contrato_status'] = 'Pendente Análise';
        }

        $response = Http::withToken($token)->post(config('api.route') . '/propostal/create', $parserPropostal);

        if (! $response->successful()) {
            return response()->json(['message' => 'Erro ao criar proposta na API'], 400);
        }

        $this->saveHistory($proposta, "Aprovado");

        $propostaId    = $response->json()['data'];
        $id            = $response->json()['data']['id'];
        $idImobiliaria = $propostaId['id_imobiliaria'];

        if ($request->hasFile('imagens') && $id) {
            foreach ($request->file('imagens') as $file) {
                if ($file->isValid()) {
                    $ext          = $file->getClientOriginalExtension();
                    $nomeOriginal = $file->getClientOriginalName();

                    // Verifica se o anexo já existe para essa proposta
                    $verificaAnexo = Http::withToken($token)->get(config('api.route') . '/attachment/exists', [
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
                    Http::withToken($token)->post(config('api.route') . '/attachment', [
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

        $motivo          = $request->input('motivo');
        $motivoOpicional = $request->input('motivo_opicional');

        $requestSanitize['id_imobiliaria']          = session('user')['id_imobiliaria'];
        $requestSanitize['proposta_status']         = 'Cancelado';
        $requestSanitize['contrato_status']         = 'Cancelado';
        $requestSanitize['proposta_credito_status'] = 'Cancelado';
        $requestSanitize['motivo']                  = $motivo;
        $requestSanitize['motivo_explicacao']       = $motivoOpicional;
        $requestSanitize['data_ultima_atualizacao'] = date('Y-m-d');
        $requestSanitize['hora_ultima_atualizacao'] = date('H:i:s');

        $historico = "Solicitação cancelada #{$id} por motivo de {$motivo}";

        if ($motivoOpicional) {
            $historico = "Solicitação cancelada #{$id} por motivo de {$motivo}, explicação: {$motivoOpicional}";
        }

        $proposta = [
            "id_imobiliaria" => session('user')['id_imobiliaria'],
            "id_movi"        => $id,
            "id_usuario"     => session('user')['id'],
            "data"           => date('Y-m-d'),
            "hora"           => date('H:i:s'),
            'historico'      => $historico,
            "movi"           => "Proposta",
        ];

        $this->saveHistory($proposta, "Cancelado");

        return Http::withToken($token)->post(config('api.route') . '/propostal/canceled/' . $id, $requestSanitize);
    }

    private function styleStep2(array $data): array
    {
        return match ($data['proposta_credito_status']) {
            'Aprovado' => [
                'colorText'    => 'fw-bold text-success',
                'text'         => 'Crédito aprovado!',
                'card'         => 'content-header mb-4 p-5 bg-success text-white',
                'icon'         => 'menu-icon icon-base ti tabler-check',
                'badge'        => 'Simulação',
                'detalhamento' => "O inquilino {$data['pessoa_nome']} do CPF {$data['pessoa_doc']} está aprovado para uma locação com garantia de um imóvel {$data['imovel_tipo']}, na cidade de {$data['imovel_cidade']} - {$data['imovel_estado']}",
                'displaySetup' => 'block',
                'cardStyle'    => '',
            ],
            'Aguardando Pagamento' => [
                'colorText'    => 'fw-bold text-success',
                'text'         => 'Crédito aprovado!',
                'card'         => 'content-header mb-4 p-5 bg-success text-white',
                'icon'         => 'menu-icon icon-base ti tabler-check',
                'badge'        => 'Simulação',
                'detalhamento' => "O inquilino {$data['pessoa_nome']} do CPF {$data['pessoa_doc']} está aprovado para uma locação com garantia de um imóvel {$data['imovel_tipo']}, na cidade de {$data['imovel_cidade']} - {$data['imovel_estado']}",
                'displaySetup' => 'block',
                'cardStyle'    => '',
            ],
            'Pendente' => [
                'colorText'    => 'fw-bold text-warning',
                'text'         => 'Crédito pendente de análise!',
                'card'         => 'content-header mb-4 p-5 text-white',
                'cardStyle'    => 'background: #FFA600;',
                'icon'         => 'menu-icon icon-base ti tabler-clock',
                'badge'        => 'Simulação',
                'detalhamento' => "O inquilino {$data['pessoa_nome']} do CPF {$data['pessoa_doc']} está pendente de uma análise manual para uma locação com garantia de um imóvel {$data['imovel_tipo']}, na cidade de {$data['imovel_cidade']} - {$data['imovel_estado']}",
                'displaySetup' => 'block',
            ],
            'Pendente Análise' => [
                'colorText'    => 'fw-bold text-warning',
                'text'         => 'Crédito pendente de análise!',
                'card'         => 'content-header mb-4 p-5 text-white',
                'cardStyle'    => 'background: #FFA600;',
                'icon'         => 'menu-icon icon-base ti tabler-clock',
                'badge'        => 'Simulação',
                'detalhamento' => "O inquilino {$data['pessoa_nome']} do CPF {$data['pessoa_doc']} está pendente de uma análise manual para uma locação com garantia de um imóvel {$data['imovel_tipo']}, na cidade de {$data['imovel_cidade']} - {$data['imovel_estado']}",
                'displaySetup' => 'block',
            ],
            default => [
                'colorText'    => 'fw-bold text-secondary',
                'text'         => 'Crédito reprovado para fiança!',
                'card'         => 'content-header mb-4 p-5 bg-secondary text-white',
                'icon'         => 'menu-icon icon-base ti tabler-x',
                'badge'        => 'Reprovado',
                'detalhamento' => "O inquilino {$data['pessoa_nome']} do CPF {$data['pessoa_doc']} está reprovado para uma locação com garantia de um imóvel {$data['imovel_tipo']}, na cidade de {$data['imovel_cidade']} - {$data['imovel_estado']}",
                'displaySetup' => 'none',
                'cardStyle'    => '',
            ],
        };
    }

    private function stylesStep5(array $data): array
    {
        return match ($data['proposta_status']) {
            'Aprovado' => [
                'colorText'     => 'fw-bold text-success',
                'text'          => 'A proposta enviada e aguardando ativação pelo inquilino.',
                'paragrapfCard' => 'A ativação do contrato locação com garantia da Invicta é efetivada mediante o aceite dos termos e pagamento. Enviamos os próximos passos para o e-mail e WhatsApp da pessoa inquilina.',
                'card'          => 'content-header mb-4 p-5 bg-success text-white',
                'cardStyle'     => '',
            ],
            'Alteração Imobiliária' => [
                'colorText'     => 'fw-bold text-success',
                'text'          => 'A proposta enviada e aguardando ativação pelo inquilino.',
                'paragrapfCard' => 'A ativação do contrato locação com garantia da Invicta é efetivada mediante o aceite dos termos e pagamento. Enviamos os próximos passos para o e-mail e WhatsApp da pessoa inquilina.',
                'card'          => 'content-header mb-4 p-5 bg-success text-white',
                'cardStyle'     => '',
            ],
            'Pendente' => [
                'colorText'     => 'fw-bold text-warning',
                'text'          => 'A proposta está em análise manual pelo nosso time interno.',
                'paragrapfCard' => 'Estaremos em contato através da nossa plataforma e por e-mail para dar retorno em até 30 minutos.',
                'card'          => 'content-header mb-4 p-5 text-white',
                'cardStyle'     => 'background-color: #FFA600;',
            ],
            'Pendente Análise' => [
                'colorText'     => 'fw-bold text-warning',
                'text'          => 'A proposta está em análise manual pelo nosso time interno.',
                'paragrapfCard' => 'Estaremos em contato através da nossa plataforma e por e-mail para dar retorno em até 30 minutos.',
                'card'          => 'content-header mb-4 p-5 text-white',
                'cardStyle'     => 'background-color: #FFA600;',
            ],
            'Reprovado' => [
                'colorText'     => 'fw-bold text-secondary',
                'text'          => 'A proposta foi negada após análise.',
                'paragrapfCard' => 'Estaremos em contato através da nossa plataforma e por e-mail para dar retorno em até 30 minutos.',
                'card'          => 'content-header mb-4 p-5 bg-secondary text-white',
                'cardStyle'     => '',
            ],
            default => [
                'colorText'     => 'fw-bold text-muted',
                'text'          => 'Status da proposta desconhecido.',
                'paragrapfCard' => '',
                'card'          => 'content-header mb-4 p-5 bg-light text-dark',
                'cardStyle'     => '',
            ],
        };
    }

    private function parseValor(string $valor): float
    {
        // Remove 'R$', espaços, pontos de milhar e converte vírgula decimal para ponto
        $limpo = str_replace(['R$', ' ', '.'], '', $valor);
        $limpo = str_replace(',', '.', $limpo);

        return floatval($limpo);
    }

    private function saveHistory(array $data, string $status = ""): void
    {
        $token = session('jwt_token');

        if ($status === "Aprovado") {
            $history = [
                'id_imobiliaria' => $data['id_imobiliaria'],
                'id_movi'        => $data['id'],
                'movi'           => 'Proposta',
                'data'           => $data['data'],
                'hora'           => $data['hora'],
                'id_usuario'     => session('user')['id'],
                'historico'      => "Criada Solicitação nº{$data['id']} do tipo {$data['imovel_tipo']},
                com setup de {$data['proposta_setup_valor']} e valor do aluguel {$data['imovel_aluguel']},
                valor do condomínio {$data['imovel_condominio']}, valor das taxas {$data['imovel_taxas']},
                totalizando {$data['valor_total_pagamento']}. O imóvel está situado no endereço {$data['endereco_completo']}, cujo CEP é {$data['imovel_cep']}",
            ];

            Http::withToken($token)->post(config('api.route') . '/history/create', $history);
        }

        if ($status === 'Cancelado') {
            Http::withToken($token)->post(config('api.route') . '/history/create', $data);
        }

        if ($status === 'Reprovado') {
            Http::withToken($token)->post(config('api.route') . '/history/create', $data);
        }

        if ($status === 'Alteração') {
            Http::withToken($token)->post(config('api.route') . '/history/create', $data);
        }

        if ($status === 'Contrato') {
            Http::withToken($token)->post(config('api.route') . '/history/create', $data[0]);
        }
    }

    private function insertHashLink(string | int $id): JsonResponse
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)->post(config('api.route') . '/propostal/hash/' . $id);

        if (! $response->successful()) {
            return response()->json("Hash não criado com sucesso");
        }

        return response()->json("Hash criado com sucesso");
    }

    public function sendNotification(Request $request): JsonResponse
    {
        $name       = $request->input('name');
        $email      = $request->input('email');
        $link       = $request->input('link');
        $linkFacial = $request->input('linkFacial');

        if ($this->emailService->send($email, $name, $link, $linkFacial)) {
            return response()->json(['mensagem' => 'E-mail enviado com sucesso!']);
        }

        return response()->json(['erro' => 'Falha ao enviar o e-mail.'], 500);
    }

    public function sendWhatsApp(Request $request): JsonResponse
    {
        $to   = $request->input('to');
        $type = $request->input('type');
        $link = $request->input('link');
        $to   = $this->corrigirNumero($to);

        $token    = session('jwt_token');
        $response = Http::withToken($token)->post(config('api.route') . '/enviar-whatsapp/' . $type . '/' . $link, ['to' => $to]);

        if (! $response->successful()) {
            return response()->json("Não foi possível enviar mensagem!");
        }

        return response()->json("Mensagem enviada com sucesso!");
    }

    public function resume(string | int $id): View
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)->get(config('api.route') . '/propostal/' . $id);
        $proposta = $response->json();

        $response    = Http::withToken($token)->get(config('api.route') . '/histories/' . $id);
        $dataHistory = $response->json();

        return view('propostal.resume', ['proposta' => $proposta,  'histories' => $dataHistory['data'], ]);
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

    public function salvarMotivoAlteracao(Request $request, int | string $id)
    {
        $token = session('jwt_token');

        $motivo          = $request->input('motivo');
        $motivoOpicional = $request->input('observacao');

        $response = Http::withToken($token)->get(config('api.route') . '/propostal/' . $id);
        $proposta = $response->json();

        $response    = Http::withToken($token)->get(config('api.route') . '/histories/' . $id);
        $dataHistory = $response->json();

        $parserPropostal                            = $this->parserValuesForInsert($proposta);
        $parserPropostal['motivo']                  = $motivo;
        $parserPropostal['motivo_explicacao']       = $motivoOpicional;
        $parserPropostal['data_ultima_atualizacao'] = date('Y-m-d');
        $parserPropostal['hora_ultima_atualizacao'] = date('H:i:s');
        $parserPropostal['proposta_status']         = 'Alteração Imobiliária';

        $historico = "Solicitação nº{$id} alterada: {$motivo}";

        if ($motivoOpicional) {
            $historico = "Solicitação nº{$id} alterada: {$motivo}, explicação da alteração: {$motivoOpicional}";
        }

        $historico = [
            "id_imobiliaria" => session('user')['id_imobiliaria'],
            "id_movi"        => $id,
            "id_usuario"     => session('user')['id'],
            "data"           => date('Y-m-d'),
            "hora"           => date('H:i:s'),
            'historico'      => $historico,
            "movi"           => "Proposta",
        ];

        $this->saveHistory($historico, "Alteração");

        $response     = Http::withToken($token)->post(config('api.route') . '/propostal/create', $parserPropostal);
        $responseData = $response->json();

        return view('propostal.wizard', [
            'step'      => 'step4',
            'proposta'  => $responseData['data'],
            'histories' => $dataHistory['data'],
        ]);
    }

    private function corrigirNumero($numero): string
    {
        // Garante que o número é só os dígitos e o prefixo
        $numero = trim((string) $numero);

        $prefixo = '+5534';

        // Só processa se começar com o prefixo
        if (str_starts_with($numero, $prefixo)) {
            $parteNumero = substr($numero, strlen($prefixo)); // pega o que vem depois do +5534

            // Se tiver 9 dígitos, remove o primeiro (normalmente o 9 extra)
            if (strlen($parteNumero) == 9) {
                $parteNumero = substr($parteNumero, 1);
            }

            return $prefixo . $parteNumero;
        }

        // Caso não venha com o prefixo esperado, retorna o número original
        return $numero;
    }

    public function updateStatus(Request $request, string | int $id): JsonResponse
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)->post(config('api.route') . '/propostal/editStatus/' . $id, $request->all());

        if (! $response->successful()) {
            return response()->json("Não foi possível atualizar status!");
        }

        return response()->json("Status atualizado com sucesso!");
    }

    public function gerarTermoPDF(string $id)
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)->get(config('api.route') . '/propostal/' . $id);
        $data     = $response->json();

        $clienteNome = preg_replace('/[^A-Za-z0-9]/', '_', (string) $data['pessoa_nome']); // Nome sem caracteres especiais

        // Renderiza o Blade como HTML
        $html = view('activation.term', ['data' => $data])->render();

        // Gera o PDF
        $pdf = Pdf::loadHTML($html);

        $idImobiliaria = $data['id_imobiliaria'];
        $caminho       = "anexos/{$idImobiliaria}/termos/termo_{$clienteNome}.pdf";

        // Salva no storage
        Storage::disk('public')->put($caminho, $pdf->output());

        return redirect()->route('activation.term_active', ['linkHash' => $data['link_hash']]);
    }

    public function downloadTermo($imobiliaria, string $filename)
    {
        $caminho = "anexos/{$imobiliaria}/termos/{$filename}";

        if (! Storage::disk('public')->exists($caminho)) {
            abort(404, 'Arquivo não encontrado no storage');
        }

        return response()->file(storage_path("app/public/{$caminho}"), [
            'Content-Disposition' => 'inline; filename="' . $filename . '"',
        ]);
    }
}