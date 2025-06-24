<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class RealEstateSectorController extends Controller
{
    public function index(Request $request): View
    {
        $search          = $request->input('search');
        $requestSanitize = $this->sanitizeData($request->all(), ['search']);

        // Se o search contém apenas números e tem 14 dígitos, provavelmente é um CNPJ
        if ($search) {
            // Decodifica o parâmetro, se estiver vindo via URL encoded
            $decodedSearch = urldecode((string) $search);

            // Se for um CNPJ, remove os caracteres especiais
            if (preg_match('/\d{2}\.?\d{3}\.?\d{3}\/?\d{4}-?\d{2}/', $decodedSearch)) {
                $search = preg_replace('/[.\-\/]/', '', $decodedSearch);
            }
        }

        $queryParams = [
            'page'   => $request->get('page', 1),
            'search' => $requestSanitize['search'] ?? null,
        ];

        $token    = session('jwt_token');
        $response = Http::withToken($token)
            ->get(config('api.route') . '/realestatesector', $queryParams);

        $data = $response->json();

        return view('realEstateSector.index', [
            'realEstateSectors' => $data['data'],
            'pagination'        => $data['meta'],
            'links'             => $data['links'],
        ]);
    }

    public function listAll(): JsonResponse
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)
            ->get(config('api.route') . '/realestatesector/listAll');

        $data = $response->json();

        return response()->json($data);
    }

    public function setup(int | string $id)
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)->get(config('api.route') . '/realestatesectorsetup/' . $id);

        return $response->json()['data'];
    }

    public function create(): View
    {
        return view('realEstateSector.form', [
            'realEstateSector' => null,
            'action'           => route('realestatesector.store'),
            'method'           => 'POST',
        ]);
    }

    public function store(Request $request): RedirectResponse
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

        $response       = Http::withToken($token)->post(config('api.route') . '/realestatesector/', $realEstateSectorData);
        $returnResponse = $response->json();

        if (! $returnResponse['success']) {
            return back()->withErrors($returnResponse['message'])->withInput();
        }

        return redirect()->route('realestatesector.index')->with('success', $returnResponse['message']);
    }

    public function edit(string | int $id): View
    {
        $response = Http::withToken(session('jwt_token'))->get(config('api.route') . '/realestatesector/' . $id);
        $data     = $response->json();

        return view('realEstateSector.form', [
            'realEstateSector' => $data['data'],
            'setups'           => $data,
            'action'           => route('realestatesector.update', $id),
            'method'           => 'PUT',
        ]);
    }

    public function update(string | int $id, Request $request): RedirectResponse
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

        $realEstateSectorData['ativo'] = 0;

        $ativo = $request->get('ativo');

        if ($ativo) {
            $realEstateSectorData['ativo'] = 1;
        }

        $realEstateSectorData['id_imobiliaria'] = session('user')['id_imobiliaria'];

        $response       = Http::withToken($token)->put(config('api.route') . '/realestatesector/' . $id, $realEstateSectorData);
        $returnResponse = $response->json();

        if (! $returnResponse['success']) {
            return back()->withErrors($returnResponse['message'])->withInput();
        }

        return redirect()->route('realestatesector.index')->with('success', $returnResponse['message']);
    }

    public function storeSetup(string | int $id, Request $request): RedirectResponse
    {
        $token           = session('jwt_token');
        $requestSanitize = $this->sanitizeData($request->all(), ['taxa']);

        if(isset($requestSanitize['ativo'])) {
            $requestSanitize['ativo'] = 1;
        } else {
            $requestSanitize['ativo'] = 0;
        }

        $requestSanitize['id_imobiliaria'] = $id;

        $response = Http::withToken($token)->post(config('api.route') . '/realestatesectorsetup/' . $id, $requestSanitize);

        $returnResponse = $response->json();

        if (! $returnResponse['success']) {
            return back()->withErrors($returnResponse['message'])->withInput();
        }

        return back()->with('success', $returnResponse['message']);
    }

    public function updateSetup(string | int $idImobiliaria, string | int $id, Request $request): RedirectResponse
    {
        $token           = session('jwt_token');
        $requestSanitize = $this->sanitizeData($request->all(), ['taxa']);

        $validator = Validator::make($requestSanitize, [
            'taxa' => 'required|numeric|between:0,9999999.99',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $requestSanitize['ativo'] = isset($requestSanitize['ativo']) ? 1 : 0;

        $requestSanitize['id_imobiliaria'] = $idImobiliaria;
        $requestSanitize['taxa']           = floatval($requestSanitize['taxa']);

        $route = config('api.route') . '/realestatesectorsetup/' . $id;

        $response = Http::withToken($token)->put($route, $requestSanitize);

        $returnResponse = $response->json();

        if (! $returnResponse['success']) {
            return back()->withErrors($returnResponse['message'])->withInput();
        }

        return back()->with('success', $returnResponse['message']);
    }

    public function delete(string | int $id): RedirectResponse
    {
        $response       = Http::withToken(session('jwt_token'))->delete(config('api.route') . '/realestatesector/' . $id);
        $returnResponse = $response->json();

        if (! $returnResponse['success']) {
            return back()->withErrors($returnResponse['message'])->withInput();
        }

        return redirect()->route('realestatesector.index')->with('success', $returnResponse['message']);
    }
}
