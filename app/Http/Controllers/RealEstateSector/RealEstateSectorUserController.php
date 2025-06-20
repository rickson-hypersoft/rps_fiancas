<?php

declare(strict_types = 1);

namespace App\Http\Controllers\RealEstateSector;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class RealEstateSectorUserController extends Controller
{
    public function index(Request $request, string | int $id): View
    {
        $response = Http::withToken(session('jwt_token'))->get(config('api.route') . '/realestatesector/' . $id);
        $data     = $response->json();

        return view('realEstateSector.index_real_estate_sector', [
            'realEstateSector' => $data['data'],
        ]);
    }

    public function update(string | int $id, Request $request): RedirectResponse
    {
        $token = session('jwt_token');

        $requestSanitize = $request->all();
        $requestSanitize = $this->sanitizeData($request->all(), ['telefone', 'cep', 'taxa_padrao', 'custo_saida',
            'cobertura_total']);

        $validator = Validator::make($requestSanitize, [
            'razao'           => 'required|string|max:100',
            'fantasia'        => 'required|string|max:100',
            'creci'           => 'required|string|max:50',
            'endereco'        => 'nullable|string|max:100',
            'numero'          => 'nullable|string|max:30',
            'bairro'          => 'nullable|string|max:100',
            'cidade'          => 'nullable|string|max:100',
            'uf'              => 'nullable|string|max:2',
            'cep'             => 'nullable|string|max:10',
            'complemento'     => 'nullable|string|max:100',
            'telefone'        => 'nullable|string|max:16',
            'contato'         => 'nullable|string|max:100',
            'cargo'           => 'nullable|string|max:100',
            'representante'   => 'nullable|string|max:100',
            'email'           => 'nullable|string|max:150',
            'tipo_pagamento'  => 'nullable|string|max:30',
            'taxa_padrao'     => 'nullable|numeric|between:0,9999999.99',
            'custo_saida'     => 'nullable|numeric|between:0,9999999.99',
            'cobertura_total' => 'nullable|numeric|between:0,9999999.99',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $realEstateSectorData = $validator->validated();

        $response = Http::withToken($token)->put(
            config('api.route') . '/realestatesector/' . $id,
            $realEstateSectorData
        );
        $returnResponse = $response->json();

        if (! $returnResponse['success']) {
            return back()->withErrors($returnResponse['message'])->withInput();
        }

        return back()->with('success', $returnResponse['message']);
    }
}
