<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class OldPaymentController extends Controller
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

    public function formCheckout(string $link, string $idPayment = null): View
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)->get(config('api.route') . '/propostal/' . $link);
        $data     = $response->json();

        return view('payments.formCheckout', ['link' => $link, 'data' => $data, 'id' => $idPayment]);
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
            return view('payments.methods.boleto', ['link' => $link, 'data' => $data]);
        }

        if ($method == 'CREDIT_CARD') {
            return view('payments.methods.credit-card', ['link' => $link, 'data' => $data]);
        }

        return view('payments.checkout', ['link' => $link, 'payment' => $method]);
    }

    public function saveCheckout(Request $request, string $link)
    {
        $token = session('jwt_token');

        $request->merge([
            'metodo_pagamento' => $request->input('metodo_pagamento', 'CREDIT_CARD'),
            'id_usuario'       => session('user')['id'],
        ]);

        $response = Http::withToken($token)->post(config('api.route') . '/payment/checkout/' . $link, $request->all());

        if ($response->successful() && isset($response['detalhes_pagamentos'])) {
            // Redireciona para a rota confirmation com o id_pagamento na URL
            return redirect()->route('payment.confirmation', ['method' => $request->input('metodo_pagamento'), 'link' => $link, 'id_pagamento' => $response['detalhes_pagamentos']]);
        }

        return redirect()->back()->withErrors([
            'checkout' => 'Erro ao processar o pagamento. Tente novamente.',
        ]);
    }

    public function confirmation(Request $request, string $link, string $idPagamento, string $method)
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)->get(config('api.route') . '/payment/info/' . $idPagamento . '/' . $method);

        return view('payments.paymentConfirmation', ['paymentInfo' => $response->json()['detalhes_pagamentos']]);
    }

    public function pixCheckout(Request $request, string $link)
    {
        $token = session('jwt_token');

        $response = Http::withToken($token)->post(config('api.route') . '/payment/pix/' . $link, ['id_usuario' => session('user')['id']]);

        $data = $response->json();

        if (! empty($data['success']) && ! empty($data['detalhes_pagamentos'])) {
            session([
                'pix_qrcode_image' => $data['detalhes_pagamentos']['encodedImage'] ?? null,
                'pix_payload'      => $data['detalhes_pagamentos']['payload'] ?? null,
                'pix_id'           => $data['id'] ?? null,
            ]);

            return response()->json(['redirect' => route('payment.pix', ['linkHash' => $link])]);
        }

        return response()->json(['error' => $data], 500);
    }

    public function pix(string $link)
    {
        $qrcode  = session('pix_qrcode_image');
        $payload = session('pix_payload');
        $pixId   = session('pix_id');

        return view('payments.pix', compact('qrcode', 'payload', 'pixId'));
    }
}
