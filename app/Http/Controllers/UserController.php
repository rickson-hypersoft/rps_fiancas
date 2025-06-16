<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $page        = $request->get('page', 1);
        $requestSanitize = $this->sanitizeData($request->all(), ['search']);

        $queryParams = ['search' => $requestSanitize['search'] ?? null, 'page' => $page];
        $token       = session('jwt_token');
        $response    = Http::withToken($token)->get(config('api.route') . '/users', $queryParams);
        $data        = $response->json();

        return view('user.index', [
            'users'      => $data['data'],
            'pagination' => $data['meta'],
            'links'      => $data['links'],
        ]);
    }

    public function create(): View
    {
        return view('user.formStore');
    }

    public function store(Request $request): RedirectResponse
    {
        $token = session('jwt_token');

        $requestSanitize = $this->sanitizeData($request->all(), ['cpf', 'telefone']);

        $validator = Validator::make($requestSanitize, [
            'usuario'        => 'required|string|max:30',
            'nome'           => 'required|string|max:50',
            'email'          => 'nullable|string|max:150',
            'cpf'            => 'nullable|string|max:11',
            'telefone'       => 'nullable|string|max:16',
            'nivel'          => 'nullable|string|max:50',
            'categoria'      => 'nullable|string|max:50',
            'id_imobiliaria' => 'nullable|numeric',
            'ativo'          => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (! $this->validaCpf($requestSanitize['cpf'])) {
            return back()
                ->withErrors(['cpf' => 'O CPF informado é inválido.'])
                ->withInput();
        }

        $userData         = $validator->validated();
        $permissoes       = $request->get('permissoes') ?? [];
        $permissoesString = '|' . implode('|', $permissoes) . '|';

        if ($request->get('imobiliaria_id')) {
            $userData['id_imobiliaria'] = $request->get('imobiliaria_id');
        }

        $userData['permissoes'] = $permissoesString;
        $userData['senha']      = Hash::make($request->get('senha'));

        $response       = Http::withToken($token)->post(config('api.route') . '/users/', $userData);
        $returnResponse = $response->json();

        if (! $returnResponse['success']) {
            return back()->withErrors($returnResponse['message'])->withInput();
        }

        return redirect()->route('user.index')->with('success', $returnResponse['message']);
    }

    public function edit(string | int $id): View
    {
        $response = Http::withToken(session('jwt_token'))->get(config('api.route') . '/users/' . $id);
        $data     = $response->json();

        return view('user.formEdit', [
            'user'       => $data['data'],
            'permissoes' => $data['data']['permissoes'],
        ]);
    }

    public function update(string | int $id, Request $request): RedirectResponse
    {
        $token = session('jwt_token');

        $requestSanitize = $this->sanitizeData($request->all(), ['cpf', 'telefone']);

        $validator = Validator::make($requestSanitize, [
            'usuario'        => 'required|string|max:30',
            'nome'           => 'required|string|max:50',
            'email'          => 'nullable|string|max:150',
            'cpf'            => 'nullable|string|max:11',
            'telefone'       => 'nullable|string|max:16',
            'nivel'          => 'nullable|string|max:50',
            'categoria'      => 'nullable|string|max:50',
            'id_imobiliaria' => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (! $this->validaCpf($requestSanitize['cpf'])) {
            return back()
                ->withErrors(['cpf' => 'O CPF informado é inválido.'])
                ->withInput();
        }

        $userData         = $validator->validated();
        $permissoes       = $request->get('permissoes') ?? [];
        $permissoesString = '|' . implode('|', $permissoes) . '|';

        $userData['permissoes'] = $permissoesString;

        $userData['id_imobiliaria'] = $request->get('imobiliaria_id') ?? null;

        $userData['ativo'] = 0;

        if ($request->get('ativo')) {
            $userData['ativo'] = 1;
        }

        $response       = Http::withToken($token)->put(config('api.route') . '/users/' . $id, $userData);
        $returnResponse = $response->json();

        if (! $returnResponse['success']) {
            return back()->withErrors($returnResponse['message'])->withInput();
        }

        return redirect()->route('user.index')->with('success', $returnResponse['message']);
    }

    public function delete(string | int $id): RedirectResponse
    {
        $response       = Http::withToken(session('jwt_token'))->delete(config('api.route') . '/users/' . $id);
        $returnResponse = $response->json();

        if (! $returnResponse['success']) {
            return back()->withErrors($returnResponse['message'])->withInput();
        }

        return redirect()->route('user.index')->with('success', $returnResponse['message']);
    }
}
