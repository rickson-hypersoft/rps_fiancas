<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DelinquenciesController extends Controller
{
    public function index()
    {
        $token         = session('jwt_token');
        $idImobiliaria = session('user')['id_imobiliaria'];

        $response = Http::withToken($token)->get(config('api.route') . '/delinquencies/' . $idImobiliaria);
        $data     = $response->json();

        return view('deliquencies.index', ['data' => $data]);
    }

    public function view(string | int $id)
    {
        $token         = session('jwt_token');
        $idImobiliaria = session('user')['id_imobiliaria'];

        $response = Http::withToken($token)->get(config('api.route') . '/delinquencies/' . $idImobiliaria . '/' . $id);
        $data     = $response->json();

        $propostal    = $data['propostal'];
        $deliquencies = $data['deliquencies'];

        return view('deliquencies.view', ['propostal' => $propostal, 'deliquencies' => [$deliquencies]]);
    }

    public function create(string $step = 'step1')
    {
        // Protege contra steps inválidos, se quiser
        if (! in_array($step, ['step1', 'step2', 'step3'])) {
            abort(404); // ou redirect()->route('delinquencies.index', 'step1');
        }

        return view('deliquencies.create', ['step' => $step]);
    }

    public function storeStep1(Request $request)
    {
        // Valida e salva os dados do passo 2...

        return redirect()->route('delinquencies.create', 'step2');
    }

    public function storeStep2(Request $request)
    {
        // Valida e salva os dados do passo 3...

        return redirect()->route('delinquencies.create', 'step3');
    }
}
