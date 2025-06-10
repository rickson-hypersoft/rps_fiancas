<?php

declare(strict_types = 1);

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

        return view('payments.formCheckout', ['link' => $link, 'data' => $data]);
    }

    public function checkout(Request $request, string $link, string $method): View
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)->get(config('api.route') . '/propostal/' . $link);
        $data     = $response->json();

        $propostaTotalValor              = $data['proposta_total_valor'];
        $valorNumericoPropostaTotalValor = floatval(str_replace(',', '.', preg_replace('/[^\d,]/', '', $propostaTotalValor)));
        $parcelasTotalValor              = [];

        for ($i = 1; $i <= 12; $i++) {
            $valorParcela           = $valorNumericoPropostaTotalValor / $i;
            $parcelasTotalValor[$i] = $i . 'x de R$ ' . number_format($valorParcela, 2, ',', '.');
        }
        $data['parcelas_total_valor_disponiveis'] = $parcelasTotalValor;

        $propostaSetupValor              = $data['proposta_setup_valor'];
        $valorNumericoPropostaSetupValor = floatval(str_replace(',', '.', preg_replace('/[^\d,]/', '', $propostaSetupValor)));
        $parcelasSetupValor              = [];

        for ($i = 1; $i <= 3; $i++) {
            $valorParcela           = $valorNumericoPropostaSetupValor / $i;
            $parcelasSetupValor[$i] = $i . 'x de R$ ' . number_format($valorParcela, 2, ',', '.');
        }
        $data['parcelas_setup_disponiveis'] = $parcelasSetupValor;

        if ($method == 'PIX') {
            return view('payments.methods.pix', ['link' => $link, 'data' => $data]);
        }

        if ($method == 'BOLETO') {
            $paymentMethod = 'BOLETO';
        }

        if ($method == 'CREDIT_CARD') {
            return view('payments.methods.credit-card', ['link' => $link, 'data' => $data]);
        }

        return view('payments.checkout', ['link' => $link, 'payment' => $method]);
    }

    public function saveCheckout(Request $request, string $link)
    {
        $token = session('jwt_token');

        $requestData               = $request->all();
        $requestData['id_usuario'] = session('user')['id'];

        if (! $requestData['metodo_pagamento']) {
            $requestData['metodo_pagamento'] = 'CREDIT_CARD';
        }

        $response = Http::withToken($token)->post(config('api.route') . '/payment/checkout/' . $link, $requestData);

        return view('payments.paymentConfirmation', [
            'data' => $response->json(),
            'link' => $link,
        ]);
    }
}
