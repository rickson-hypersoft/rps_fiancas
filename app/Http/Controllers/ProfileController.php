<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile', ['user' => session('user')]);
    }

    public function update(int | string $id, Request $request)
    {
        $token           = session('jwt_token');
        $requestSanitize = $this->sanitizeData($request->all(), ['cpf', 'telefone']);

        if ($request->hasFile('imagem')) {
            $file = $request->file('imagem');
            $path = public_path("assets/user-profiles/{$id}.png");

            if (file_exists($path)) {
                unlink($path);
            }
            $file->move(public_path('assets/user-profiles'), "{$id}.png");
        }

        $validator = Validator::make($requestSanitize, [
            'usuario'  => 'required|string|max:30',
            'nome'     => 'required|string|max:50',
            'email'    => 'required|string|max:150',
            'cpf'      => 'required|string|max:11',
            'telefone' => 'nullable|string|max:16',
            'nivel'    => 'nullable|string|max:50',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $userData          = $validator->validated();
        $userData['ativo'] = 0;

        $ativo = $request->get('ativo');

        if ($ativo) {
            $userData['ativo'] = 1;
        }

        $response       = Http::withToken($token)->put(env('API_ROUTE') . '/users/' . $id, $userData);
        $returnResponse = $response->json();

        if (! $returnResponse['success']) {
            return back()->withErrors($returnResponse['message'])->withInput();
        }

        session(['user' => $returnResponse['data']]);

        return back()->with('success', $returnResponse['message']);
    }
}
