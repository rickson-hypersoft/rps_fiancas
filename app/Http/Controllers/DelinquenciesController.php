<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DelinquenciesController extends Controller
{
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

    public function storeStep2(Request $request, int $contrato_id, int $idInadimplencia)
    {
        // Valida e salva os dados do passo 3...
        dd($request->all(), $contrato_id, $idInadimplencia);

        return redirect()->route('delinquencies.create', ['contrato_id' => $contrato_id, 'step' => 'step3', 'id' => $idInadimplencia]);
    }
}
