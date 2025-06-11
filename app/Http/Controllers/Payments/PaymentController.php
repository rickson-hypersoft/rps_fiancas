<?php

declare(strict_types=1);

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function index(string $link): View
    {
        return view('payments.index', ['link' => $link]);
    }

    public function faceId(string $link): View
    {
        // Por enquanto vai marcar face_id = 1;
        $token = session('jwt_token');

        $response = Http::withToken($token)->get(config('api.route') . '/assets/faceId/' . $link);
        $data     = $response->json();

        return view('payments.confirm', ['link' => $link]);
    }

    public function term(string $link): View
    {
        return view('payments.term', ['link' => $link]);
    }

    public function login(string $link): View
    {
        return view('payments.login', ['link' => $link]);
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

        return redirect()->route('payment.activation', ['link' => $request->input('link')]);
    }

    public function formCheckout(string $link): View
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)->get(config('api.route') . '/propostal/' . $link);
        $data     = $response->json();

        $responsePayment = Http::withToken($token)->post(config('api.route') . '/payment/create/' . $link, ['id_usuario' => session('user')['id']]);

        return view('payments.formCheckout', ['link' => $link, 'data' => $data, 'id' => $responsePayment->json()['id']]);
    }

    public function pixCheckout(string $link, $id)
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)->get(config('api.route') . '/propostal/' . $link);
        $data     = $response->json();

        return view('payments.methods.pix', ['link' => $link, 'data' => $data, 'id' => $id]);
    }

    public function boletoCheckout(string $link, $id)
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)->get(config('api.route') . '/propostal/' . $link);
        $data     = $response->json();

        return view('payments.methods.boleto', ['link' => $link, 'data' => $data, 'id' => $id]);
    }

    public function editarPagamento(Request $request, $id)
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)->post(config('api.route') . '/paymentedit/' . $id, ['metodo_pagamento' => $request->all()['metodo_pagamento']]);
        $data     = $response->json();
        return response()->json($data);
    }
}