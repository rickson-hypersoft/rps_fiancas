<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Financial;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class FinancialMoviController extends Controller
{
    public function index(Request $request): View
    {
        $queryParams = [
            "id_conta"     => $request->input('id_conta'),
            "data_inicial" => $request->input('data_inicial'),
            "data_final"   => $request->input('data_final'),
            "id_categoria" => $request->input('id_categoria'),
            'descricao'    => $request->input('search'),
        ];

        $user = session('user');

        $responseContas = Http::withToken(session('jwt_token'))->get(config('api.route') . '/financial/financial_account/' . $user['id_imobiliaria']);
        $contas         = $responseContas->json()['data'];

        $responseCategorias = Http::withToken(session('jwt_token'))->get(config('api.route') . '/financial/financial_category/' . $user['id_imobiliaria']);
        $categorias         = $responseCategorias->json()['data'];

        $response      = Http::withToken(session('jwt_token'))->get(config('api.route') . '/financial/financial_movi/' . $user['id_imobiliaria'], $queryParams);
        $movimentacoes = $response->json()['data'];
        $valores       = $response->json()['valores'];

        return view('financial.financial_movi.index', [
            'movimentacoes' => $movimentacoes,
            'contas'        => $contas,
            'categorias'    => $categorias,
            'valores'       => $valores,
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
            'method'     => null,
            'action'     => route('financial.financial_movi.store'),
            'contas'     => $contas,
            'categorias' => $categorias,
            'movi'       => null,
        ]);
    }

    public function edit(string | int $id): View
    {
        $user = session('user');

        $response = Http::withToken(session('jwt_token'))->get(config('api.route') . '/financial/financial_account/' . $user['id_imobiliaria']);
        $contas   = $response->json()['data'];

        $response   = Http::withToken(session('jwt_token'))->get(config('api.route') . '/financial/financial_category/' . $user['id_imobiliaria']);
        $categorias = $response->json()['data'];

        $response = Http::withToken(session('jwt_token'))->get(config('api.route') . '/financial/' . $id . '/financial_movi');
        $movi     = $response->json()['data'];

        return view('financial.financial_movi.form', [
            'method'     => 'PUT',
            'action'     => route('financial.financial_movi.update', $id),
            'contas'     => $contas,
            'categorias' => $categorias,
            'movi'       => $movi,
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
            'valor'        => 'numeric|between:1,9999999.99',
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

    public function update(Request $request, string | int $id)
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

        $response       = Http::withToken($token)->put(config('api.route') . '/financial/financial_movi/' . $id, $financialMovi);
        $returnResponse = $response->json();

        if (! $returnResponse['success']) {
            return back()->withErrors($returnResponse['message'])->withInput();
        }

        return redirect()->route('financial.financial_movi.index')->with('success', $returnResponse['message']);
    }

    public function delete(string | int $id): RedirectResponse
    {
        $response       = Http::withToken(session('jwt_token'))->delete(config('api.route') . '/financial/financial_movi/' . $id);
        $returnResponse = $response->json();

        if (! $returnResponse['success']) {
            return back()->withErrors($returnResponse['message'])->withInput();
        }

        return redirect()->route('financial.financial_movi.index')->with('success', $returnResponse['message']);
    }
}
