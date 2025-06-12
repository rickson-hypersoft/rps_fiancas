<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class ActivationController extends Controller
{
    public function index(string $link): View
    {
        return view('activation.index', ['linkHash' => $link]);
    }

    public function faceId(string $link): View
    {
        // Por enquanto vai marcar face_id = 1;
        $token = session('jwt_token');

        $response = Http::withToken($token)->get(config('api.route') . '/assets/faceId/' . $link);
        $data     = $response->json();

        return view('activation.confirm', ['linkHash' => $link]);
    }

    public function term(string $link): View
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)->get(config('api.route') . '/propostal/' . $link);
        $data     = $response->json();

        return view('activation.term', ['linkHash' => $link, 'data' => $data]);
    }

    public function login(string $linkHash)
    {
        return view('activation.login', ['linkHash' => $linkHash]);
    }

    public function verifyLogin(Request $request): RedirectResponse
    {
        $request->validate([
            'cpf'  => 'required|string',
            'link' => 'required|string',
        ]);

        $token = session('jwt_token');

        $response = Http::withToken($token)->get(config('api.route') . '/assets/' . $request->input('link'));
        $data     = $response->json();

        if (! $data) {
            return redirect()->back()->withErrors(['message' => 'Link inválido.']);
        }

        if ($data['data']['pessoa_doc'] !== $request->input('cpf')) {
            return redirect()->back()->withErrors(['message' => 'CPF inválido.']);
        }

        // Salva na sessão que este link foi autenticado
        session(["auth_link_{$request->input('link')}" => true]);

        return redirect()->route('activation.index', ['linkHash' => $request->input('link')]);
    }
}
