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
        $token    = session('jwt_token');
        $response = Http::withToken($token)->get(config('api.route') . '/propostal/' . $link);
        $data     = $response->json();

        return view('payments.term', ['link' => $link, 'data' => $data]);
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

        $responsePayment = Http::withToken($token)->post(config('api.route') . '/payments/create/' . $link, ['id_usuario' => session('user')['id']]);

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

    public function creditCardCheckout(string $link, $id)
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

        return view('payments.methods.credit-card', ['link' => $link, 'data' => $data, 'id' => $id]);
    }

    public function creditCardSaveCheckout(Request $request, string $link, $id)
    {
        $token = session('jwt_token');

        $request->merge([
            'id_usuario'       => session('user')['id'],
        ]);

        var_dump(config('api.route') . '/payment/credit_card/' . $id . '/' . $link, $request->all());
        exit;

        $response = Http::withToken($token)->post(config('api.route') . '/payment/credit_card/' . $id . '/' . $link, $request->all());

        if ($response->successful() && isset($response['detalhes_pagamentos'])) {
            // Redireciona para a rota confirmation com o id_pagamento na URL
            return redirect()->route('payment.confirmation', ['id' => $id]);
        }
        return redirect()->back()->withErrors([
            'checkout' => 'Erro ao processar o pagamento. Tente novamente.',
        ]);
    }

    public function confirmation(string $idPagamento)
    {
        $token = session('jwt_token');
        $response = Http::withToken($token)->get(config('api.route') . '/payment/info/' . $idPagamento);
        return view('payments.confirmation.credit-card', ['paymentInfo' => $response->json()['detalhes_pagamentos'], 'propostalInfo' => $response->json()['propostas']]);
    }

    public function editarPagamento(Request $request, $id)
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)->post(config('api.route') . '/paymentedit/' . $id, ['metodo_pagamento' => $request->all()['metodo_pagamento']]);
        $data     = $response->json();
        return response()->json($data);
    }
}