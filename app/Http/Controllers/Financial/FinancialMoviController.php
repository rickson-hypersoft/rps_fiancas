<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Financial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class FinancialMoviController extends Controller
{
    public function index(): View
    {
        $user = session('user');

        $responseContas = Http::withToken(session('jwt_token'))->get(config('api.route') . '/financial/financial_account/' . $user['id_imobiliaria']);
        $contas         = $responseContas->json()['data'];

        $responseCategorias = Http::withToken(session('jwt_token'))->get(config('api.route') . '/financial/financial_category/' . $user['id_imobiliaria']);
        $categorias         = $responseCategorias->json()['data'];

        $response      = Http::withToken(session('jwt_token'))->get(config('api.route') . '/financial/financial_movi/' . $user['id_imobiliaria']);
        $movimentacoes = $response->json()['data'];

        return view('financial.financial_movi.index', [
            'movimentacoes' => $movimentacoes,
            'contas'        => $contas,
            'categorias'    => $categorias,
        ]);
    }

    public function create(): View
    {
        $user = session('user');

        $response = Http::withToken(session('jwt_token'))->get(config('api.route') . '/financial/financial_account/' . $user['id_imobiliaria']);
        $contas   = $response->json()['data'];

        $response   = Http::withToken(session('jwt_token'))->get(config('api.route') . '/financial/financial_category/' . $user['id_imobiliaria']);
        $categorias = $response->json()['data'];

        return view('financial.financial_movi.form', [
            'contas'     => $contas,
            'categorias' => $categorias,
        ]);
    }

    public function edit(): View
    {
        $user = session('user');

        $response = Http::withToken(session('jwt_token'))->get(config('api.route') . '/financial/financial_account/' . $user['id_imobiliaria']);
        $contas   = $response->json()['data'];

        $response   = Http::withToken(session('jwt_token'))->get(config('api.route') . '/financial/financial_category/' . $user['id_imobiliaria']);
        $categorias = $response->json()['data'];

        return view('financial.financial_movi.form', [
            'contas'     => $contas,
            'categorias' => $categorias,
        ]);
    }

    public function store(Request $request)
    {
        $token = session('jwt_token');
        $user  = session('user');

        $requestSanitize = $request->all();

        $validator = Validator::make($requestSanitize, [
            'id_conta'     => 'nullable|numeric',
            'id_categoria' => 'nullable|numeric',
            'tipo'         => 'nullable|string',
            'historico'    => 'nullable|string',
            'valor'        => 'nullable|numeric',
            'data'         => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $financialMovi                   = $validator->validated();
        $financialMovi['id_imobiliaria'] = $user['id_imobiliaria'];

        $response       = Http::withToken($token)->post(config('api.route') . '/financial/financial_movi/', $financialMovi);
        $returnResponse = $response->json();

        if (! $returnResponse['success']) {
            return back()->withErrors($returnResponse['message'])->withInput();
        }

        return redirect()->route('financial.financial_movi.index')->with('success', $returnResponse['message']);
    }
}
