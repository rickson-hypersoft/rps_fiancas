<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Financial;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class FinancialAccountController extends Controller
{
    public function index(Request $request): View
    {
        $queryParams = [
            'page'   => $request->get('page', 1),
            'search' => $request->input('search'),
        ];

        $user     = session('user');
        $response = Http::withToken(session('jwt_token'))->get(config('api.route') . '/financial/financial_account/' . $user['id_imobiliaria'], $queryParams);
        $data     = $response->json();

        return view('financial.financial_account.index', [
            'financialAccounts' => $data['data'],
            'pagination'        => $data['meta'],
            'links'             => $data['links'],
        ]);
    }

    public function create(): View
    {
        return view('financial.financial_account.form', [
            'financialAccount' => null,
            'action'           => route('financial.financial_account.store'),
            'method'           => 'POST',
        ]);
    }

    public function edit(string | int $id): View
    {
        $response = Http::withToken(session('jwt_token'))->get(config('api.route') . "/financial/{$id}/financial_account/");
        $data     = $response->json();

        return view('financial.financial_account.form', [
            'financialAccount' => $data['data'],
            'action'           => route('financial.financial_account.update', $id),
            'method'           => 'PUT',
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $token           = session('jwt_token');
        $user            = session('user');
        $requestSanitize = $this->sanitizeData($request->all(), ['banco_cnpj']);

        if ($requestSanitize['tipo_conta'] == 'Conta Bancária') {
            $validator = Validator::make($requestSanitize, [
                'tipo_conta'       => 'required|string|max:50',
                'descricao'        => 'required|string|max:100',
                'banco_titular'    => 'required|string|max:100',
                'banco_cnpj'       => 'required|string|max:100',
                'banco'            => 'required|string|max:3',
                'banco_agencia'    => 'required|string|max:100',
                'banco_conta'      => 'required|string|max:100',
                'banco_finalidade' => 'nullable|string|max:100',
                'banco_pix'        => 'nullable|string|max:100',
                'ativo'            => 'nullable|numeric|between:0,1',
            ]);
        } else {
            $validator = Validator::make($requestSanitize, [
                'tipo_conta'       => 'nullable|string|max:50',
                'descricao'        => 'required|string|max:100',
                'banco_titular'    => 'nullable|string|max:100',
                'banco_cnpj'       => 'nullable|string|max:100',
                'banco'            => 'nullable|string|max:3',
                'banco_agencia'    => 'nullable|string|max:100',
                'banco_conta'      => 'nullable|string|max:100',
                'banco_finalidade' => 'nullable|string|max:100',
                'banco_pix'        => 'nullable|string|max:100',
                'ativo'            => 'nullable|numeric|between:0,1',
            ]);
        }

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $financialAccount                   = $validator->validated();
        $financialAccount['id_imobiliaria'] = $user['id_imobiliaria'];

        $response       = Http::withToken($token)->post(config('api.route') . '/financial/financial_account/', $financialAccount);
        $returnResponse = $response->json();

        if (! $returnResponse['success']) {
            return back()->withErrors($returnResponse['message'])->withInput();
        }

        return redirect()->route('financial.financial_account.index')->with('success', $returnResponse['message']);
    }

    public function update(Request $request, string | int $id): RedirectResponse
    {
        $requestSanitize = $this->sanitizeData($request->all(), ['banco_cnpj']);

        $validator = Validator::make($requestSanitize, [
            'tipo_conta'       => 'nullable|string|max:50',
            'descricao'        => 'nullable|string|max:100',
            'banco_titular'    => 'nullable|string|max:100',
            'banco_cnpj'       => 'nullable|string|max:14',
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

        $financialAccount['id_imobiliaria'] = session('user')['id_imobiliaria'];

        $response       = Http::withToken(session('jwt_token'))->put(config('api.route') . '/financial/financial_account/' . $id, $financialAccount);
        $returnResponse = $response->json();

        if (! $returnResponse['success']) {
            return back()->withErrors($returnResponse['message'])->withInput();
        }

        return redirect()->route('financial.financial_account.index')->with('success', $returnResponse['message']);
    }

    public function delete(string | int $id): RedirectResponse
    {
        $response       = Http::withToken(session('jwt_token'))->delete(config('api.route') . '/financial/financial_account/' . $id);
        $returnResponse = $response->json();

        if (! $returnResponse['success']) {
            return back()->withErrors($returnResponse['message'])->withInput();
        }

        return redirect()->route('financial.financial_account.index')->with('success', $returnResponse['message']);
    }
}
