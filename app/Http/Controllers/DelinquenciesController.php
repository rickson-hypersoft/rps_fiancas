<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Services\EmailService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Services\Delinquencies\DelinquenciesService;

class DelinquenciesController extends Controller
{
    public function __construct(
        protected DelinquenciesService $delinquenciesService,
        protected EmailService $emailService
    ) {
    }

    public function index(Request $request)
    {
        $queryParams = [
            'page'          => $request->get('page', 1),
            'imovel'        => $request->input('imovel'),
            'nome'          => $request->input('nome_inquilino'),
            'cpf'           => $request->input('cpf_inquilino'),
            'status'        => $request->input('status'),
            'data_inicial'  => $request->input('data_aviso_inicial'),
            'data_final'    => $request->input('data_aviso_final'),
            'valor_inicial' => $request->input('valor_inadimplencia_inicial'),
            'valor_final'   => $request->input('valor_inadimplencia_final'),
        ];

        $token         = session('jwt_token');
        $idImobiliaria = session('user')['id_imobiliaria'];

        $response = Http::withToken($token)->get(config('api.route') . '/delinquencies/' . $idImobiliaria, $queryParams);
        $data     = $response->json();

        return view('deliquencies.index', ['data' => $data['data'], 'pagination' => $data['meta'],
            'links'                               => $data['links'], ]);
    }

    public function exportarRelatorio(Request $request)
    {
        return $this->delinquenciesService->export($request);
    }

    public function exportarExtratoFinanceiro(Request $request)
    {
        return $this->delinquenciesService->exportarExtratoFinanceiro($request);
    }

    public function view(string | int $id)
    {
        $token         = session('jwt_token');
        $idImobiliaria = session('user')['id_imobiliaria'];

        $response = Http::withToken($token)->get(config('api.route') . '/delinquencies/' . $idImobiliaria . '/' . $id);
        $data     = $response->json();

        $propostal    = $data['propostal'];
        $deliquencies = $data['delinquencies'];

        return view('deliquencies.view', ['propostal' => $propostal, 'deliquencies' => [$deliquencies]]);
    }

    public function create()
    {
        $step            = request()->route('step', 'step1');
        $idInadimplencia = request()->route('id');

        // Protege contra steps inválidos, se quiser
        if (! in_array($step, ['step1', 'step2', 'step3'])) {
            abort(404); // ou redirect()->route('delinquencies.index', 'step1');
        }

        if ($step == 'step2') {
            $responseProposta                          = Http::withToken(session('jwt_token'))->get(config('api.route') . '/assets/' . session('user')['id_imobiliaria'] . '/' . request()->route('contrato_id'));
            $dataProposta                              = $responseProposta->json();
            $fiancaDisponivel                          = ($this->parseValor($dataProposta['data']['imovel_aluguel']) * 40);
            $dataProposta['data']['fianca_disponivel'] = 'R$ ' . number_format(floatval($fiancaDisponivel), 2, ',', '.');

            $deliquencies = Http::withToken(session('jwt_token'))->get(config('api.route') . '/delinquencies/delinquencie/' . $idInadimplencia);
            $deliquencies = $deliquencies->json();

            return view('deliquencies.create', [
                'step'              => $step,
                'contrato_id'       => request()->route('contrato_id'),
                'idInadimplencia'   => request()->route('id'),
                'situacao_imovel'   => $deliquencies['delinquencies']['imovel_situacao'],
                'fianca_disponivel' => $dataProposta['data']['fianca_disponivel'],
            ]);
        }

        if ($step == 'step3') {
            $user     = session('user');
            $response = Http::withToken(session('jwt_token'))->get(config('api.route') . '/financial/financial_account/' . $user['id_imobiliaria'], [
                'type'   => 'Conta Bancária',
                'active' => 1,
            ]);
            $data = $response->json();

            $deliquencies = Http::withToken(session('jwt_token'))->get(config('api.route') . '/delinquencies/delinquencie/' . $idInadimplencia);
            $deliquencies = $deliquencies->json();

            $responseProposta                          = Http::withToken(session('jwt_token'))->get(config('api.route') . '/assets/' . session('user')['id_imobiliaria'] . '/' . request()->route('contrato_id'));
            $dataProposta                              = $responseProposta->json();
            $fiancaDisponivel                          = ($this->parseValor($dataProposta['data']['imovel_aluguel']) * 40);
            $coberturaSaida                            = ($this->parseValor($dataProposta['data']['imovel_aluguel']) * 5);
            $dataProposta['data']['fianca_disponivel'] = 'R$ ' . number_format(floatval($fiancaDisponivel), 2, ',', '.');
            $dataProposta['data']['cobertura_saida']   = 'R$ ' . number_format(floatval($coberturaSaida), 2, ',', '.');

            $anexosResponse = Http::withToken(session('jwt_token'))->get(config('api.route') . '/attachment', [
                'id_imobiliaria' => session('user')['id_imobiliaria'],
                'id_movi'        => $idInadimplencia,
            ]);
            $anexos = $anexosResponse->json();

            return view('deliquencies.create', [
                'step'              => $step,
                'contrato_id'       => request()->route('contrato_id'),
                'idInadimplencia'   => request()->route('id'),
                'contas'            => $data['data'],
                'delinquencie'      => $deliquencies['delinquencies'],
                'anexos'            => $anexos,
                'fianca_disponivel' => $dataProposta['data']['fianca_disponivel'],
                'cobertura_saida'   => $dataProposta['data']['cobertura_saida'],
            ]);
        }

        $response                          = Http::withToken(session('jwt_token'))->get(config('api.route') . '/assets/' . session('user')['id_imobiliaria'] . '/' . request()->route('contrato_id'));
        $data                              = $response->json();
        $fiancaDisponivel                  = ($this->parseValor($data['data']['imovel_aluguel']) * 40);
        $coberturaSaida                    = ($this->parseValor($data['data']['imovel_aluguel']) * 5);
        $data['data']['fianca_disponivel'] = 'R$ ' . number_format(floatval($fiancaDisponivel), 2, ',', '.');
        $data['data']['cobertura_saida']   = 'R$ ' . number_format(floatval($coberturaSaida), 2, ',', '.');

        return view('deliquencies.create', [
            'step'              => $step,
            'contrato_id'       => request()->route('contrato_id'),
            'idInadimplencia'   => request()->route('id'),
            'fianca_disponivel' => $data['data']['fianca_disponivel'],
            'cobertura_saida'   => $data['data']['cobertura_saida'],
        ]);
    }

    private function parseValor(string $valor): float
    {
        // Remove 'R$', espaços, pontos de milhar e converte vírgula decimal para ponto
        $limpo = str_replace(['R$', ' ', '.'], '', $valor);
        $limpo = str_replace(',', '.', $limpo);

        return floatval($limpo);
    }

    public function storeStep1(Request $request, int $contrato_id)
    {
        $token         = session('jwt_token');
        $idImobiliaria = session('user')['id_imobiliaria'];

        $dataRequest = $request->validate([
            'imovel_situacao' => 'required|string',
        ]);
        $dataRequest['contrato_id']    = $contrato_id;
        $dataRequest['id_imobiliaria'] = $idImobiliaria;

        $response = Http::withToken($token)->post(config('api.route') . '/delinquencies', $dataRequest);
        $data     = $response->json();

        if (! $response->successful()) {
            return redirect()->back()->withErrors($data['message'] ?? 'Erro ao salvar os dados.')->withInput();
        }

        $idInadimplencia = $data['id'];

        // return redirect()->route('delinquencies.create', ['step' => 'step2'])
        return redirect()->route('delinquencies.create', ['contrato_id' => $contrato_id, 'step' => 'step2', 'id' => $idInadimplencia]);
    }

    public function storeStep2(Request $request, int $contrato_id, int $idInadimplencia)
    {
        $token         = session('jwt_token');
        $idImobiliaria = session('user')['id_imobiliaria'];

        $dataInsert = [];
        switch ($request->all()['tipo_conta']) {
            case 'Aluguel':
                $dataInsert = $this->delinquenciesService->aluguel($request->all());

                break;
            case 'Condomínio':
                $dataInsert = $this->delinquenciesService->condominio($request->all());

                break;
            case 'IPTU':
                $dataInsert = $this->delinquenciesService->iptu($request->all());

                break;
            case 'Seguro':
                $dataInsert = $this->delinquenciesService->seguro($request->all());

                break;
            case 'Água':
                $dataInsert = $this->delinquenciesService->agua($request->all());

                break;
            case 'Luz':
                $dataInsert = $this->delinquenciesService->luz($request->all());

                break;
            case 'Gás':
                $dataInsert = $this->delinquenciesService->gas($request->all());

                break;
            case 'Seguro incêndio':
                $dataInsert = $this->delinquenciesService->seguroIncendio($request->all());

                // no break
            case 'Outros anexos':
                $dataInsert = $this->delinquenciesService->outrosAnexos($request->all());

                break;
        }

        if (isset($request->all()['maisBoletos']) && $request->all()['maisBoletos'] == 'sim') {
            $dataInsert['outrosBoletos'] = $this->delinquenciesService->maisBoletos($request->all());
        }

        $novos = $this->delinquenciesService->getNovasContas($request->all());

        if (count($novos) > 0) {
            $dataInsert['novasContas'] = $novos;
        }

        $dataInsert['contrato_id'] = $contrato_id;

        if (count($novos) > 0) {
            $dataInsert['novasContas'] = $novos;
        }

        $response = Http::withToken($token)->put(config('api.route') . '/delinquencies/' . $idInadimplencia, $dataInsert);
        $data     = $response->json();

        // Adicionar histórico
        if ($data['imovel_situacao'] == 'Desocupado') {
            $historico = session('user')['nome']
                . ' adicionou uma nova inadimplência com o imóvel desocupado';
        } elseif ($data['tipo_conta'] == 'Outros anexos') {
            $historico = session('user')['nome']
            . ' adicionou uma nova inadimplência com o imóvel ocupado';
        } else {
            $historico = session('user')['nome']
            . ' adicionou uma nova inadimplência com o valor R$ '
            . $dataInsert['valor_original']
            . ', Data de Vencimento Original: '
            . Carbon::parse($data['vencimento_original'])->format('d/m/Y');
        }
        Http::withToken($token)->post(config('api.route') . '/history/create', [
            'id_imobiliaria' => $data['id_imobiliaria'],
            'id_movi'        => $data['id'],
            'movi'           => 'Inadimplência',
            'data'           => date('Y-m-d'),
            'hora'           => date('H:i:s'),
            'id_usuario'     => session('user')['id'],
            'historico'      => $historico,
        ]);

        if ($request->hasFile('anexos')) {
            $file = $request->file('anexos');

            if ($file->isValid()) {
                $ext          = $file->getClientOriginalExtension();
                $nomeOriginal = $file->getClientOriginalName();

                $verificaAnexo = Http::withToken($token)->get(config('api.route') . '/attachment/exists', [
                    'id_imobiliaria' => $idImobiliaria,
                    'id_movi'        => $idInadimplencia,
                    'nome_arquivo'   => $nomeOriginal,
                ]);

                if ($verificaAnexo->ok() && ($verificaAnexo->json()['exists'] == false)) {
                    $caminho   = "anexos/{$idImobiliaria}/inadimplencia/{$idInadimplencia}.{$ext}";
                    $nomeUnico = uniqid($idInadimplencia . '_') . '.' . $ext;
                    // Salva o arquivo localmente
                    $file->storeAs("anexos/{$idImobiliaria}/inadimplencia", $nomeUnico, 'public');

                    // Chamada para a API registrar o anexo no banco
                    $data = Http::withToken($token)->post(config('api.route') . '/attachment', [
                        'id_imobiliaria'        => $idImobiliaria,
                        'id_movi'               => $idInadimplencia,
                        'movi'                  => 'inadimplencias',
                        'movi_sub'              => $dataInsert['tipo_conta'],
                        'data'                  => now()->format('Y-m-d H:i:s'),
                        'nome_arquivo'          => $nomeUnico,
                        'nome_arquivo_original' => $nomeOriginal,
                        'descricao'             => 'Arquivo anexado à Inadimplência',
                    ]);
                }
            }
        }

        // Multas Recisórias
        if (
            $request->hasFile('anexos_termos_recisao') ||
            $request->hasFile('anexos_vistoria_saida') ||
            $request->hasFile('anexos_descricao_valores') ||
            $request->hasFile('anexos_descricao_valores_novo')
        ) {
            $anexos = [
                'anexos_termos_recisao',
                'anexos_vistoria_saida',
                'anexos_descricao_valores',
                'anexos_descricao_valores_novo',
            ];

            foreach ($anexos as $campo) {
                if ($request->hasFile($campo)) {
                    $file = $request->file($campo);

                    if ($file->isValid()) {
                        $ext          = $file->getClientOriginalExtension();
                        $nomeOriginal = $file->getClientOriginalName();

                        // Verifica se o arquivo já existe via API
                        $verificaAnexo = Http::withToken($token)->get(config('api.route') . '/attachment/exists', [
                            'id_imobiliaria' => $idImobiliaria,
                            'id_movi'        => $idInadimplencia,
                            'nome_arquivo'   => $nomeOriginal,
                        ]);

                        if ($verificaAnexo->ok() && ($verificaAnexo->json()['exists'] == false)) {
                            // Gera nome único e salva
                            $nomeUnico = uniqid($idInadimplencia . '_') . '.' . $ext;
                            $file->storeAs("anexos/{$idImobiliaria}/inadimplencia", $nomeUnico, 'public');

                            if ($campo === 'anexos_termos_recisao') {
                                $dataInsert['tipo_conta'] = 'Termos Recisão';
                            } elseif ($campo === 'anexos_vistoria_saida') {
                                $dataInsert['tipo_conta'] = 'Vistória Saída';
                            } elseif ($campo === 'anexos_descricao_valores') {
                                $dataInsert['tipo_conta'] = 'Descrição de Valores';
                            } elseif ($campo === 'anexos_descricao_valores_novo') {
                                $dataInsert['tipo_conta'] = 'Descrição de Valores';
                            }

                            // Registra na API
                            Http::withToken($token)->post(config('api.route') . '/attachment', [
                                'id_imobiliaria'        => $idImobiliaria,
                                'id_movi'               => $idInadimplencia,
                                'movi'                  => 'inadimplencias',
                                'movi_sub'              => $dataInsert['tipo_conta'],
                                'data'                  => now()->format('Y-m-d H:i:s'),
                                'nome_arquivo'          => $nomeUnico,
                                'nome_arquivo_original' => $nomeOriginal,
                                'descricao'             => 'Arquivo anexado à Inadimplência',
                            ]);
                        }
                    }
                }
            }
        }

        $this->delinquenciesService->anexos($request->all(), $idImobiliaria, $idInadimplencia, $token);

        $anexosInadimplencias = Http::withToken($token)->get(config('api.route') . '/delinquencies/anexos/' . $idInadimplencia);

        $contasComAnexos = [];

        foreach ($anexosInadimplencias->json() as $attachments) {
            foreach ($attachments as $attachment) {
                if (isset($attachment['movi_sub'])) {
                    $contasComAnexos[] = $attachment['movi_sub'];
                }
            }
        }

        $contasComAnexo = array_unique($contasComAnexos);
        $qtd            = count($contasComAnexo);
        $usuario        = session('user')['nome'];

        if ($qtd === 0) {
            $historico = "{$usuario} não adicionou anexos à inadimplência {$idInadimplencia}.";
        } elseif ($qtd === 1) {
            $historico = "{$usuario} atribuiu à inadimplência {$idInadimplencia} 1 anexo da conta do tipo: {$contasComAnexo[0]}.";
        } else {
            $listaContas = implode(', ', $contasComAnexo);
            $historico   = "{$usuario} atribuiu à inadimplência {$idInadimplencia} {$qtd} anexos das contas do tipo: {$listaContas}.";
        }

        Http::withToken($token)->post(config('api.route') . '/history/create', [
            'id_imobiliaria' => $idImobiliaria,
            'id_movi'        => $idInadimplencia,
            'movi'           => 'Inadimplência',
            'data'           => date('Y-m-d'),
            'hora'           => date('H:i:s'),
            'id_usuario'     => session('user')['id'],
            'historico'      => $historico,
        ]);

        return redirect()->route('delinquencies.create', ['contrato_id' => $contrato_id, 'step' => 'step3', 'id' => $idInadimplencia]);
    }

     private function sendWhatsApp($numero, $tipo, $link) : JsonResponse
    {
        $to   = $this->corrigirNumero($numero);

        $token    = session('jwt_token');
        $response = Http::withToken($token)->post(config('api.route') . '/enviar-whatsapp/' . $tipo . '/' . $link, ['to' => $to]);

        if (! $response->successful()) {
            return response()->json("Não foi possível enviar mensagem!");
        }

        return response()->json("Mensagem enviada com sucesso!");
    }

     private function corrigirNumero($numero): string
{
    // Remove tudo que não for dígito
    $numero = preg_replace('/\D/', '', (string) $numero);

    // Remove possíveis zeros iniciais, DDI, etc.
    if (str_starts_with($numero, '55')) {
        $numero = substr($numero, 2); // tira o DDI se já vier com ele
    }

    // Se vier com 11 dígitos e começar com 9 (ex: 999911156), mantém
    // Se vier com 9 dígitos (sem DDD), pode tratar de acordo com sua lógica
    if (strlen($numero) === 11) {
        // já está completo com DDD
        return '+55' . $numero;
    }

    // Caso falte DDD, insere o 34
    if (strlen($numero) === 9) {
        return '+5534' . $numero;
    }

    // Fallback – retorna com +55 mesmo
    return '+55' . $numero;
}


    public function storeStep3(Request $request, int $contrato_id, int $idInadimplencia)
    {
        $token = session('jwt_token');

        $dataInsert = [
            'conta_bancaria_id'  => $request->all()['conta_bancaria_id'],
            'tipo_inadimplencia' => 'Simples',
            'forma_pagamento'    => $request->all()['ted'],
        ];

        $response  = Http::withToken($token)->put(config('api.route') . '/delinquencies/' . $idInadimplencia, $dataInsert);
        $propostal = Http::withToken($token)->get(config('api.route') . '/delinquencies/' . session('user')['id_imobiliaria'] . '/' . $idInadimplencia);
        $data      = $propostal->json();

        $name  = $data['propostal']['pessoa_nome'];
        $email = $data['propostal']['pessoa_email'];

        $this->emailService->send($email, $name, '', '', 'delinquencies', $response->json()['valor_original'], $response->json()['vencimento_original'], $response->json()['tipo_conta']);
        $this->sendWhatsApp($data['propostal']['pessoa_telefone'], 'abertura_inadimplencia', $data['propostal']['link_hash'],);

        return redirect()->route('assets.asset', ['id' => $contrato_id, 'inadimplencia' => $idInadimplencia])->with('showSweetAlert', true);
    }

    public function baixarAnexo(string $idInadimplencia, string $tipo)
    {
        $idImobiliaria = session('user')['id_imobiliaria'];

        // Buscar nome do arquivo no banco
        $response = Http::withToken(session('jwt_token'))->get(config('api.route') . '/search/attachment', [
            'id_imobiliaria' => $idImobiliaria,
            'id_movi'        => $idInadimplencia,
            'movi'           => 'inadimplencias',
            'movi_sub'       => $tipo,
        ]);

        if (! $response->ok() || empty($response->json())) {
            abort(404, 'Arquivo não encontrado');
        }

        $nomeArquivo = $response->json()[0]['nome_arquivo'] ?? null;

        $caminho = "anexos/{$idImobiliaria}/inadimplencia/{$nomeArquivo}";

        if (! Storage::disk('public')->exists($caminho)) {
            abort(404, 'Arquivo não encontrado no storage');
        }

        return response()->file(storage_path("app/public/{$caminho}"), [
            'Content-Disposition' => 'inline; filename="' . $nomeArquivo . '"',
        ]);
    }

    public function delete(string $id)
    {
        $response = Http::withToken(session('jwt_token'))
            ->delete(config('api.route') . '/delinquencies/' . $id);
        $response->json();

        if ($response->successful()) {
            return redirect()
                ->route('delinquencies.view', ['id' => $id])
                ->with('success', "Inadimplência $id cancelada com sucesso!");
        }

        return redirect()
            ->route('delinquencies.view', ['id' => $id])
            ->with('error', 'Não foi possível cancelar a inadimplência $id.');
    }

    public function adicionarMovimentacao(Request $request)
    {
        $data = Http::withToken(session('jwt_token'))->post(config('api.route') . '/history/create', [
            'id_imobiliaria' => session('user')['id_imobiliaria'],
            'id_movi'        => $request->input('id'),
            'movi'           => 'Inadimplência',
            'data'           => date('Y-m-d'),
            'hora'           => date('H:i:s'),
            'id_usuario'     => session('user')['id'],
            'historico'      => $request->input('mensagem'),
        ]);

        if ($data->json(['success'])) {
            return response()->json(['success' => true, 'data' => $data->json()]);
        }

        return response()->json(['success' => false, 'data' => $data->json()]);
    }
}
