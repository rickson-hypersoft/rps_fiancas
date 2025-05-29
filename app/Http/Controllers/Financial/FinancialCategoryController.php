<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Financial;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class FinancialCategoryController extends Controller
{
    public function index(Request $request)
    {
        $page     = $request->get('page', 1);
        $user     = session('user');
        $response = Http::withToken(session('jwt_token'))->get(getenv('API_ROUTE') . '/financial/financial_category/' . $user['id_imobiliaria'], ['page' => $page]);
        $data     = $response->json();

        return view('financial.financial_category.index', [
            'financialCategories' => $data['data'],
            'pagination'          => $data['meta'],
            'links'               => $data['links'],
        ]);
    }

    public function create()
    {
        return view('financial.financial_category.form', [
            'financialCategory' => null,
            'action'            => route('financial.financial_category.store'),
            'method'            => 'POST',
        ]);
    }

    public function edit(string | int $id)
    {
        $response = Http::withToken(session('jwt_token'))->get(getenv('API_ROUTE') . "/financial/{$id}/financial_category/");
        $data     = $response->json();

        return view('financial.financial_category.form', [
            'financialCategory' => $data['data'],
            'action'            => route('financial.financial_category.update', $id),
            'method'            => 'PUT',
        ]);
    }

    public function store(Request $request)
    {
        $token = session('jwt_token');
        $user  = session('user');

        $requestSanitize = $request->all();

        $validator = Validator::make($requestSanitize, [
            'descricao' => 'required|string|max:100',
            'tipo'      => 'required|string|max:1',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $financialCategory                   = $validator->validated();
        $financialCategory['id_imobiliaria'] = $user['id_imobiliaria'];

        $response       = Http::withToken($token)->post(env('API_ROUTE') . '/financial/financial_category/', $financialCategory);
        $returnResponse = $response->json();

        if (! $returnResponse['success']) {
            return back()->withErrors($returnResponse['message'])->withInput();
        }

        return redirect()->route('financial.financial_category.index')->with('success', $returnResponse['message']);
    }

    public function update(Request $request, string | int $id)
    {
        $requestSanitize = $this->sanitizeData($request->all(), ['banco_cnpj']);

        $validator = Validator::make($requestSanitize, [
            'descricao' => 'required|string|max:100',
            'sistema'   => 'nullable|numeric|between:0,1',
            'tipo'      => 'required|string|max:1',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $financialCategory          = $validator->validated();
        $financialCategory['ativo'] = 0;

        $ativo = $request->get('ativo');

        if ($ativo) {
            $financialCategory['ativo'] = 1;
        }

        $response       = Http::withToken(session('jwt_token'))->put(getenv('API_ROUTE') . '/financial/financial_category/' . $id, $financialCategory);
        $returnResponse = $response->json();

        if (! $returnResponse['success']) {
            return back()->withErrors($returnResponse['message'])->withInput();
        }

        return redirect()->route('financial.financial_category.index')->with('success', $returnResponse['message']);
    }
}
