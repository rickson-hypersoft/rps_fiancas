<?php

declare(strict_types = 1);

namespace App\Http\Controllers\RealEstateSector;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class UserRealEstateSectorController extends Controller
{
    public function index(Request $request)
    {
        $page        = $request->get('page', 1);
        $token       = session('jwt_token');
        $queryParams = ['search' => $request->input('search'), 'page' => $page];

        $response = Http::withToken($token)->get(env('API_ROUTE') . '/users/realEstateSector/' . session('user')['id_imobiliaria'], $queryParams);

        $data = $response->json();

        return view('user.realEstateSector.index', [
            'users'      => $data['data'],
            'pagination' => $data['meta'],
            'links'      => $data['links'],
        ]);
    }

    public function create()
    {
        return view('user.realEstateSector.formStore');
    }

    public function store(Request $request)
    {
        $token = session('jwt_token');

        $requestSanitize = $this->sanitizeData($request->all(), ['cpf', 'telefone']);

        $validator = Validator::make($requestSanitize, [
            'usuario'  => 'required|string|max:30',
            'nome'     => 'required|string|max:50',
            'email'    => 'nullable|string|max:150',
            'cpf'      => 'nullable|string|max:11',
            'telefone' => 'nullable|string|max:16',
            'nivel'    => 'nullable|string|max:50',
            'ativo'    => 'nullable|numeric',
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

        $userData['id_imobiliaria'] = session('user')['id_imobiliaria'];
        $userData['categoria']      = session('user')['categoria'];
        $userData['permissoes']     = $permissoesString;
        $userData['senha']          = Hash::make($request->get('senha'));

        $response       = Http::withToken($token)->post(env('API_ROUTE') . '/users/', $userData);
        $returnResponse = $response->json();

        if (! $returnResponse['success']) {
            return back()->withErrors($returnResponse['message'])->withInput();
        }

        return redirect()->route('realestatesector.users.index')->with('success', $returnResponse['message']);
    }

    public function edit(string | int $id)
    {
        $response = Http::withToken(session('jwt_token'))->get(env('API_ROUTE') . '/users/' . $id);
        $data     = $response->json();

        return view('user.realEstateSector.formEdit', [
            'user'       => $data['data'],
            'permissoes' => $data['data']['permissoes'],
        ]);
    }

    public function update(string | int $id, Request $request)
    {
        $token = session('jwt_token');

        $requestSanitize = $this->sanitizeData($request->all(), ['cpf', 'telefone']);

        $validator = Validator::make($requestSanitize, [
            'usuario'  => 'required|string|max:30',
            'nome'     => 'required|string|max:50',
            'email'    => 'nullable|string|max:150',
            'cpf'      => 'nullable|string|max:11',
            'telefone' => 'nullable|string|max:16',
            'nivel'    => 'nullable|string|max:50',
            'ativo'    => 'nullable|numeric',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $userData         = $validator->validated();
        $permissoes       = $request->get('permissoes') ?? [];
        $permissoesString = '|' . implode('|', $permissoes) . '|';

        $userData['id_imobiliaria'] = session('user')['id_imobiliaria'];
        $userData['categoria']      = session('user')['categoria'];
        $userData['permissoes']     = $permissoesString;

        $response       = Http::withToken($token)->put(env('API_ROUTE') . '/users/' . $id, $userData);
        $returnResponse = $response->json();

        if (! $returnResponse['success']) {
            return back()->withErrors($returnResponse['message'])->withInput();
        }

        return redirect()->route('realestatesector.users.index')->with('success', $returnResponse['message']);
    }
}
