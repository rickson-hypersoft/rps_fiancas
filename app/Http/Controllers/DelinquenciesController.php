<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Services\Delinquencies\DelinquenciesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class DelinquenciesController extends Controller
{
    public function __construct(
        protected DelinquenciesService $delinquenciesService
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

        if ($step == 'step3') {
            $user     = session('user');
            $response = Http::withToken(session('jwt_token'))->get(config('api.route') . '/financial/financial_account/' . $user['id_imobiliaria'], [
                'type'   => 'Conta Bancária',
                'active' => 1,
            ]);
            $data = $response->json();

            $deliquencies = Http::withToken(session('jwt_token'))->get(config('api.route') . '/delinquencies/delinquencie/' . $idInadimplencia);
            $deliquencies = $deliquencies->json();

            $anexosResponse = Http::withToken(session('jwt_token'))->get(config('api.route') . '/attachment', [
                'id_imobiliaria' => session('user')['id_imobiliaria'],
                'id_movi'        => $idInadimplencia,
            ]);
            $anexos = $anexosResponse->json();

            return view('deliquencies.create', [
                'step'            => $step,
                'contrato_id'     => request()->route('contrato_id'),
                'idInadimplencia' => request()->route('id'),
                'contas'          => $data['data'],
                'delinquencie'    => $deliquencies['delinquencies'],
                'anexos'          => $anexos,
            ]);
        }

        return view('deliquencies.create', [
            'step'            => $step,
            'contrato_id'     => request()->route('contrato_id'),
            'idInadimplencia' => request()->route('id'),
        ]);
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

        $response = Http::withToken($token)->post(config('api.route') . '/delinquencies/', $dataRequest);
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

                break;
        }

        if (isset($request->all()['maisBoletos']) && $request->all()['maisBoletos'] == 'sim') {
            $dataInsert['outrosBoletos'] = $this->delinquenciesService->maisBoletos($request->all());
        }

        $dataInsert['contrato_id'] = $contrato_id;

        $response = Http::withToken($token)->put(config('api.route') . '/delinquencies/' . $idInadimplencia, $dataInsert);
        $data     = $response->json();

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
                        'movi_sub'              => 'inadimplencias ' . $dataInsert['tipo_conta'],
                        'data'                  => now()->format('Y-m-d H:i:s'),
                        'nome_arquivo'          => $nomeUnico,
                        'nome_arquivo_original' => $nomeOriginal,
                        'descricao'             => 'Arquivo anexado à Inadimplência',
                    ]);
                }
            }
        }

        $this->delinquenciesService->anexos($request->all(), $idImobiliaria, $idInadimplencia, $token);

        return redirect()->route('delinquencies.create', ['contrato_id' => $contrato_id, 'step' => 'step3', 'id' => $idInadimplencia]);
    }

    public function storeStep3(Request $request, int $contrato_id, int $idInadimplencia)
    {
        $token = session('jwt_token');

        $dataInsert = [
            'conta_bancaria_id'  => $request->all()['conta_bancaria_id'],
            'tipo_inadimplencia' => 'Simples',
            'forma_pagamento'    => $request->all()['ted'],
        ];

        $response = Http::withToken($token)->put(config('api.route') . '/delinquencies/' . $idInadimplencia, $dataInsert);
        $response->json();

        return redirect()->route('assets.asset', ['id' => $contrato_id, 'inadimplencia' => $idInadimplencia]);
    }

    public function baixarAnexo(string $idInadimplencia, string $tipo)
    {
        $idImobiliaria = session('user')['id_imobiliaria'];

        // Buscar nome do arquivo no banco
        $response = Http::withToken(session('jwt_token'))->get(config('api.route') . '/search/attachment', [
            'id_imobiliaria' => $idImobiliaria,
            'id_movi'        => $idInadimplencia,
            'movi'           => 'inadimplencias',
            'movi_sub'       => 'inadimplencias ' . $tipo,
        ]);

        if (! $response->ok() || empty($response->json())) {
            abort(404, 'Arquivo não encontrado');
        }

        $nomeArquivo = $response->json()[0]['NOME_ARQUIVO'] ?? null;

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
}
