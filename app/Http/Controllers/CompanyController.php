<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function index()
    {
        return view('company.index', ['company' => session('realEstateSectorOrCompany')]);
    }

    public function update(string | int $id, Request $request)
    {
        $token           = session('jwt_token');
        $requestSanitize = $this->sanitizeData($request->all(), ['cnpj', 'cep', 'telefone']);

        $validator = Validator::make($requestSanitize, [
            'razao'         => 'required|string|max:100',
            'fantasia'      => 'required|string|max:100',
            'cnpj'          => 'required|string|max:14',
            'endereco'      => 'nullable|string|max:100',
            'numero'        => 'nullable|string|max:30',
            'bairro'        => 'nullable|string|max:100',
            'cidade'        => 'nullable|string|max:100',
            'uf'            => 'nullable|string|max:2',
            'cep'           => 'nullable|string|max:10',
            'complemento'   => 'nullable|string|max:100',
            'telefone'      => 'nullable|string|max:16',
            'contato'       => 'nullable|string|max:100',
            'cargo'         => 'nullable|string|max:100',
            'representante' => 'nullable|string|max:100',
            'email'         => 'nullable|string|max:150',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $companyData = $validator->validated();

        $response       = Http::withToken($token)->put(env('API_ROUTE') . '/companies/' . $id, $companyData);
        $returnResponse = $response->json();

        if (! $returnResponse['success']) {
            return back()->withErrors($returnResponse['message'])->withInput();
        }

        session(['company' => $returnResponse['data']]);

        return back()->with('success', $returnResponse['message']);
    }
}
