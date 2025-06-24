<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class ActivationController extends Controller
{
    public function index(string $linkHash)
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)->get(config('api.route') . '/propostal/' . $linkHash);

        $data = $response->json();

        if ($data['face_id'] == 1) {
            return redirect()->route('activation.term', ['linkHash' => $linkHash]);
        }

        return view('activation.index', ['linkHash' => $linkHash]);
    }

    public function faceId(string $link): View
    {
        // Por enquanto vai marcar face_id = 1;
        $token = session('jwt_token');

        $response = Http::withToken($token)->get(config('api.route') . '/activation/faceId/' . $link);
        $response->json();
        $responseData = Http::withToken($token)->get(config('api.route') . '/activation/' . $link);

        $this->saveHistory([
            'id_imobiliaria' => session('user')['id_imobiliaria'],
            'id_movi'        => $responseData->json()['data']['id'],
            'movi'           => 'Contratos',
            'data'           => now()->format('Y-m-d'),
            'historico'      => 'Inquilino ativou o Face ID',
            'id_usuario'     => session('user')['id'],
            'hora'           => now()->format('H:i:s'),
        ]);

        Http::withToken($token)->post(
            config('api.route') . '/propostal/editStatus/' . $responseData->json()['data']['id'],
            ['contrato_sub_status' => 'Análise biométrica ativada']
        );

        return view('activation.confirm', ['linkHash' => $link]);
    }

    public function term(string $link): View
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)->get(config('api.route') . '/propostal/' . $link);
        $data     = $response->json();

        return view('activation.term', ['linkHash' => $link, 'data' => $data]);
    }

    public function activeTerm(string $linkHash)
    {
        $token        = session('jwt_token');
        $responseData = Http::withToken($token)->get(config('api.route') . '/activation/' . $linkHash);

        $this->saveHistory([
            'id_imobiliaria' => session('user')['id_imobiliaria'],
            'id_movi'        => $responseData->json()['data']['id'],
            'movi'           => 'Contratos',
            'data'           => now()->format('Y-m-d'),
            'historico'      => 'Inquilino aceitou o termo',
            'id_usuario'     => session('user')['id'],
            'hora'           => now()->format('H:i:s'),
        ]);

        Http::withToken($token)->post(
            config('api.route') . '/propostal/editStatus/' . $responseData->json()['data']['id'],
            ['contrato_sub_status' => 'Termo aceito pelo inquilino']
        );

        $response = Http::withToken($token)->get(config('api.route') . '/propostal/' . $linkHash);
        $data     = $response->json();

        return view('payments.index', ['linkHash' => $linkHash, 'data' => $data]);
    }

    public function login(string $linkHash): View
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

        $response = Http::withToken($token)->get(config('api.route') . '/activation/' . $request->input('link'));
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

    private function saveHistory(array $data): void
    {
        $token = session('jwt_token');
        Http::withToken($token)->post(config('api.route') . '/history/create', $data);
    }
}