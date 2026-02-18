<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function index(string $link): View
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)->get(config('api.route') . '/propostal/' . $link);
        $data     = $response->json();

        // Marcar termo como ativado e lido
        return view('payments.index', ['link' => $link, 'data' => $data]);
    }

    public function cancelarPagamento(string $idPagamento, string $linkHash): JsonResponse
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)->post(config('api.route') . '/checkout/canceled/' . $idPagamento . '/' . $linkHash);
        $data     = $response->json();

        return response()->json($data);
    }

    public function carregarFormPix(string $linkHash): View
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)->get(config('api.route') . '/propostal/' . $linkHash);
        $data     = $response->json();

        $responsePagamento = Http::withToken($token)->post(
            config('api.route') . '/checkout/pix/' . $linkHash
        );
        $dataPagamento = $responsePagamento->json();

        if (isset($dataPagamento['pago'])) {
            $paymentInfo = $dataPagamento['pagamento'] ?? [];

            return view('payments.confirmation.pix', ['paymentInfo' => $paymentInfo]);
        }

        return view('payments.methods.pix', ['linkHash' => $linkHash, 'data' => $data]);
    }

    public function criarPagamentoPix(Request $request, string $linkHash)
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)->post(
            config('api.route') . '/checkout/pix/' . $linkHash
        );
        $data = $response->json();

        if (! empty($data['pago'])) {
            $paymentInfo = $data['pagamento'] ?? [];

            if ($request->expectsJson() || $request->ajax()) {
                $html = view('payments.confirmation.pix', ['paymentInfo' => $paymentInfo])->render();

                return response()->json([
                    'success' => true,
                    'pago'    => true,
                    'html'    => $html,
                ]);
            }

            // fallback para navegação não-AJAX
            return view('payments.confirmation.pix', ['paymentInfo' => $paymentInfo]);
        }

        // Fluxo normal (ainda aguardando pagamento): devolve o JSON da API
        return response()->json($data);
    }

    public function carregarFormBoleto(string $linkHash): View
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)->get(config('api.route') . '/propostal/' . $linkHash);
        $data     = $response->json();

        $responsePagamento = Http::withToken($token)->post(
            config('api.route') . '/checkout/boleto/' . $linkHash
        );

        $dataPagamento = $responsePagamento->json();

        if (isset($dataPagamento['pago'])) {
            $paymentInfo = $dataPagamento['pagamento'] ?? [];

            return view('payments.confirmation.boleto', ['paymentInfo' => $paymentInfo]);
        }

        return view('payments.methods.boleto', ['linkHash' => $linkHash, 'data' => $data]);
    }

    public function criarPagamentoBoleto(Request $request, string $linkHash)
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)->post(
            config('api.route') . '/checkout/boleto/' . $linkHash
        );
        $data = $response->json();

        if (! empty($data['pago'])) {
            $paymentInfo = $data['pagamento'] ?? [];

            if ($request->expectsJson() || $request->ajax()) {
                $html = view('payments.confirmation.pix', ['paymentInfo' => $paymentInfo])->render();

                return response()->json([
                    'success' => true,
                    'pago'    => true,
                    'html'    => $html,
                ]);
            }

            // fallback para navegação não-AJAX
            return view('payments.confirmation.pix', ['paymentInfo' => $paymentInfo]);
        }

        return response()->json($data);
    }

    public function carregarFormCartao(string $linkHash): View
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)->get(config('api.route') . '/propostal/' . $linkHash);
        $data     = $response->json();

        $propostaTotalValor              = $data['proposta_total_valor'];
        $valorNumericoPropostaTotalValor = floatval(str_replace(',', '.', preg_replace('/[^\d,]/', '', (string) $propostaTotalValor)));
        $parcelasTotalValor              = [];

        for ($i = 1; $i <= 12; $i++) {
            $valorParcela           = $valorNumericoPropostaTotalValor / $i;
            $parcelasTotalValor[$i] = $i . 'x de R$ ' . number_format($valorParcela, 2, ',', '.');
        }
        $data['parcelas_total_valor_disponiveis'] = $parcelasTotalValor;

        $propostaSetupValor              = $data['proposta_setup_valor'];
        $valorNumericoPropostaSetupValor = floatval(str_replace(',', '.', preg_replace('/[^\d,]/', '', (string) $propostaSetupValor)));
        $parcelasSetupValor              = [];

        for ($i = 1; $i <= 3; $i++) {
            $valorParcela           = $valorNumericoPropostaSetupValor / $i;
            $parcelasSetupValor[$i] = $i . 'x de R$ ' . number_format($valorParcela, 2, ',', '.');
        }
        $data['parcelas_setup_disponiveis'] = $parcelasSetupValor;

        return view('payments.methods.credit-card', ['linkHash' => $linkHash, 'data' => $data]);
    }

    public function criarPagamentoCartao(Request $request, string $linkHash)
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)->post(
            config('api.route') . '/checkout/cartao/' . $linkHash,
            $request->all()
        );

        Log::info('Resposta do checkout com cartão de crédito: ', [config('api.route') . '/checkout/cartao/' . $linkHash, $request->all()]);

        if ($response->successful() && isset($response['detalhes_pagamentos'])) {
            // Redireciona para a rota confirmation com o id_pagamento na URL
            if (is_array($response['ids_pagamentos']) && count($response['ids_pagamentos']) > 1) {
                // Se tiver dois pagamentos, junte com vírgula (ou outro separador) e envie como string
                $ids = implode(',', $response['ids_pagamentos']);
            } else {
                // Apenas um pagamento
                $ids = is_array($response['ids_pagamentos']) ? $response['ids_pagamentos'][0] : $response['ids_pagamentos'];
            }

            return redirect()->route('checkout.confirmation.cart', ['linkHash' => $linkHash, 'idPagamento' => $ids]);
        }

        Log::info('Erro no checkout com cartão de crédito: ', [$response->json()]);

        return back()->withErrors([
            'checkout' => $response->json()['message'][0]['description'],
        ])->withInput();
    }

    public function cartaoConfirmacao(string $linkHash, string $idPagamento)
    {
        $token = session('jwt_token');

        // Monte a URL de chamada para API
        $url = config('api.route') . '/checkout/info/' . $idPagamento;

        $response = Http::withToken($token)->get($url);

        return view('payments.confirmation.credit-card', [
            'paymentInfo'   => $response->json()['detalhes_pagamentos'],
            'propostalInfo' => $response->json()['propostas'],
        ]);
    }
}
