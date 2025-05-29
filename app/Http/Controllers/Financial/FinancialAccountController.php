<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Financial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class FinancialAccountController extends Controller
{
    public function index(Request $request)
    {
        $page     = $request->get('page', 1);
        $user     = session('user');
        $response = Http::withToken(session('jwt_token'))->get(getenv('API_ROUTE') . '/financial/financial_account/' . $user['id_imobiliaria'], ['page' => $page]);
        $data     = $response->json();

        return view('financial.financial_account.index', [
            'financialAccounts' => $data['data'],
            'pagination'        => $data['meta'],
            'links'             => $data['links'],
        ]);
    }

    public function create()
    {
        return view('financial.financial_account.form', [
            'financialAccount' => null,
            'action'           => route('financial.financial_account.store'),
            'method'           => 'POST',
        ]);
    }

    public function edit(string | int $id)
    {
        $response = Http::withToken(session('jwt_token'))->get(getenv('API_ROUTE') . "/financial/{$id}/financial_account/");
        $data     = $response->json();

        return view('financial.financial_account.form', [
            'financialAccount' => $data['data'],
            'action'           => route('financial.financial_account.update', $id),
            'method'           => 'PUT',
        ]);
    }

    public function store(Request $request)
    {
        $token           = session('jwt_token');
        $user            = session('user');
        $requestSanitize = $this->sanitizeData($request->all(), ['banco_cnpj']);

        $validator = Validator::make($requestSanitize, [
            'tipo_conta'       => 'required|string|max:50',
            'descricao'        => 'required|string|max:100',
            'banco_titular'    => 'required|string|max:100',
            'banco_cnpj'       => 'required|string|max:14',
            'banco'            => 'nullable|string|max:3',
            'banco_agencia'    => 'nullable|string|max:100',
            'banco_conta'      => 'nullable|string|max:100',
            'banco_finalidade' => 'nullable|string|max:100',
            'banco_pix'        => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $financialAccount                   = $validator->validated();
        $financialAccount['id_imobiliaria'] = $user['id_imobiliaria'];

        $response       = Http::withToken($token)->post(env('API_ROUTE') . '/financial/financial_account/', $financialAccount);
        $returnResponse = $response->json();

        if (! $returnResponse['success']) {
            return back()->withErrors($returnResponse['message'])->withInput();
        }

        return redirect()->route('financial.financial_account.index')->with('success', $returnResponse['message']);
    }

    public function update(Request $request, string | int $id)
    {
        $requestSanitize = $this->sanitizeData($request->all(), ['banco_cnpj']);

        $validator = Validator::make($requestSanitize, [
            'tipo_conta'       => 'required|string|max:50',
            'descricao'        => 'required|string|max:100',
            'banco_titular'    => 'required|string|max:100',
            'banco_cnpj'       => 'required|string|max:14',
            'banco'            => 'nullable|string|max:3',
            'banco_agencia'    => 'nullable|string|max:100',
            'banco_conta'      => 'nullable|string|max:100',
            'banco_finalidade' => 'nullable|string|max:100',
            'banco_pix'        => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $financialAccount = $validator->validated();

        $financialAccount['ativo'] = 0;

        $ativo = $request->get('ativo');

        if ($ativo) {
            $financialAccount['ativo'] = 1;
        }

        $response       = Http::withToken(session('jwt_token'))->put(getenv('API_ROUTE') . '/financial/financial_account/' . $id, $financialAccount);
        $returnResponse = $response->json();

        if (! $returnResponse['success']) {
            return back()->withErrors($returnResponse['message'])->withInput();
        }

        return redirect()->route('financial.financial_account.index')->with('success', $returnResponse['message']);
    }
}
