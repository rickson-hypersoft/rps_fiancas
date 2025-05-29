<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class RealEstateSectorController extends Controller
{
    public function index(Request $request)
    {
        $page     = $request->get('page', 1);
        $token    = session('jwt_token');
        $response = Http::withToken($token)
            ->get(getenv('API_ROUTE') . '/realestatesector', ['page' => $page]);

        $data = $response->json();

        return view('realEstateSector.index', [
            'realEstateSectors' => $data['data'],
            'pagination'        => $data['meta'],
            'links'             => $data['links'],
        ]);
    }

    public function listAll()
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)
            ->get(getenv('API_ROUTE') . '/realestatesector/listAll');

        $data = $response->json();

        return response()->json($data);
    }

    public function setup(int | string $id)
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)->get(getenv('API_ROUTE') . '/realestatesectorsetup/' . $id);

        return $response->json()['data'];
    }

    public function create()
    {
        return view('realEstateSector.form', [
            'realEstateSector' => null,
            'action'           => route('realestatesector.store'),
            'method'           => 'POST',
        ]);
    }

    public function store(Request $request)
    {
        $token = session('jwt_token');

        $requestSanitize = $request->all();
        $requestSanitize = $this->sanitizeData($request->all(), ['cnpj', 'telefone', 'cep', 'taxa_padrao', 'custo_saida', 'cobertura_total']);

        $validator = Validator::make($requestSanitize, [
            'razao'           => 'required|string|max:100',
            'fantasia'        => 'required|string|max:100',
            'creci'           => 'required|string|max:50',
            'cnpj'            => 'required|string|max:14',
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

        $response       = Http::withToken($token)->post(env('API_ROUTE') . '/realestatesector/', $realEstateSectorData);
        $returnResponse = $response->json();

        if (! $returnResponse['success']) {
            return back()->withErrors($returnResponse['message'])->withInput();
        }

        return redirect()->route('realestatesector.index')->with('success', $returnResponse['message']);
    }

    public function edit(string | int $id)
    {
        $response = Http::withToken(session('jwt_token'))->get(getenv('API_ROUTE') . '/realestatesector/' . $id);
        $data     = $response->json();

        return view('realEstateSector.form', [
            'realEstateSector' => $data['data'],
            'setups'           => $data,
            'action'           => route('realestatesector.update', $id),
            'method'           => 'PUT',
        ]);
    }

    public function update(string | int $id, Request $request)
    {
        $token = session('jwt_token');

        $requestSanitize = $request->all();
        $requestSanitize = $this->sanitizeData($request->all(), ['cnpj', 'telefone', 'cep', 'taxa_padrao', 'custo_saida', 'cobertura_total']);

        $validator = Validator::make($requestSanitize, [
            'razao'           => 'required|string|max:100',
            'fantasia'        => 'required|string|max:100',
            'creci'           => 'required|string|max:50',
            'cnpj'            => 'required|string|max:14',
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

        $response       = Http::withToken($token)->put(env('API_ROUTE') . '/realestatesector/' . $id, $realEstateSectorData);
        $returnResponse = $response->json();

        if (! $returnResponse['success']) {
            return back()->withErrors($returnResponse['message'])->withInput();
        }

        return redirect()->route('realestatesector.index')->with('success', $returnResponse['message']);
    }

    public function storeSetup(string | int $id, Request $request)
    {
        $token           = session('jwt_token');
        $requestSanitize = $this->sanitizeData($request->all(), ['taxa']);

        if (! $requestSanitize['ativo']) {
            $requestSanitize['ativo'] = 0;
        } else {
            $requestSanitize['ativo'] = 1;
        }

        $requestSanitize['id_imobiliaria'] = $id;

        $response = Http::withToken($token)->post(getenv('API_ROUTE') . '/realestatesectorsetup/' . $id, $requestSanitize);

        $returnResponse = $response->json();

        if (! $returnResponse['success']) {
            return back()->withErrors($returnResponse['message'])->withInput();
        }

        return back()->with('success', $returnResponse['message']);
    }

    public function updateSetup(string | int $id, string | int $idImobiliaria, Request $request)
    {
        $token           = session('jwt_token');
        $requestSanitize = $this->sanitizeData($request->all(), ['taxa']);

        if (! isset($requestSanitize['ativo'])) {
            $requestSanitize['ativo'] = 0;
        } else {
            $requestSanitize['ativo'] = 1;
        }

        $requestSanitize['id_imobiliaria'] = $idImobiliaria;

        $route = getenv('API_ROUTE') . '/realestatesectorsetup/' . $id;

        $response = Http::withToken($token)->put($route, $requestSanitize);

        $returnResponse = $response->json();

        if (! $returnResponse['success']) {
            return back()->withErrors($returnResponse['message'])->withInput();
        }

        return back()->with('success', $returnResponse['message']);
    }
}
