<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use App\Services\Delinquencies\DelinquenciesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
        $step = request()->route('step', 'step1');

        // Protege contra steps inválidos, se quiser
        if (! in_array($step, ['step1', 'step2', 'step3'])) {
            abort(404); // ou redirect()->route('delinquencies.index', 'step1');
        }

        return view('deliquencies.create', ['step' => $step, 'contrato_id' => request()->route('contrato_id'),
            'idInadimplencia'                      => request()->route('id')]);
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

    public function storeStep2(Request $request, int $contrato_id, int $idInadimplencia): void
    {
        $token         = session('jwt_token');
        $idImobiliaria = session('user')['id_imobiliaria'];

        $dataInsert = [];
        switch ($request->all()['tipo_conta']) {
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

        dd($dataInsert);

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

                if (! $verificaAnexo->ok() && ($verificaAnexo->json()['exists'] !== false)) {
                    $caminho   = "anexos/{$idImobiliaria}/inadimplencia/{$idInadimplencia}.{$ext}";
                    $nomeUnico = uniqid($idInadimplencia . '_') . '.' . $ext;
                    // Salva o arquivo localmente
                    $file->storeAs("anexos/{$idImobiliaria}/propostas", $nomeUnico, 'public');

                    // Chamada para a API registrar o anexo no banco
                    Http::withToken($token)->post(config('api.route') . '/attachment', [
                        'id_imobiliaria'        => $idImobiliaria,
                        'id_movi'               => $idInadimplencia,
                        'movi'                  => 'inadimplencias',
                        'movi_sub'              => null,
                        'data'                  => now()->format('Y-m-d H:i:s'),
                        'nome_arquivo'          => $nomeUnico,
                        'nome_arquivo_original' => $nomeOriginal,
                        'descricao'             => 'Arquivo anexado à Inadimplência',
                    ]);
                }
            }
        }

        // return redirect()->route('delinquencies.create', ['contrato_id' => $contrato_id, 'step' => 'step3', 'id' => $idInadimplencia]);
    }
}
