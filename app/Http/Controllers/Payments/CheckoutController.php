<?php

declare(strict_types=1);

namespace App\Http\Controllers\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function index(string $link): View
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)->get(config('api.route') . '/propostal/' . $link);
        $data     = $response->json();

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

        return view('payments.methods.pix', ['linkHash' => $linkHash, 'data' => $data]);
    }

    public function criarPagamentoPix(string $linkHash): JsonResponse
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)->post(
            config('api.route') . '/checkout/pix/' . $linkHash,
            ['id_usuario' => session('user')['id']]
        );
        $data = $response->json();

        return response()->json($data);
    }

    public function carregarFormBoleto(string $linkHash): View
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)->get(config('api.route') . '/propostal/' . $linkHash);
        $data     = $response->json();

        return view('payments.methods.boleto', ['linkHash' => $linkHash, 'data' => $data]);
    }

    public function criarPagamentoBoleto(string $linkHash): JsonResponse
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)->post(
            config('api.route') . '/checkout/boleto/' . $linkHash,
            ['id_usuario' => session('user')['id']]
        );
        $data = $response->json();

        return response()->json($data);
    }

    public function carregarFormCartao(string $linkHash): View
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)->get(config('api.route') . '/propostal/' . $linkHash);
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

        return view('payments.methods.credit-card', ['linkHash' => $linkHash, 'data' => $data]);
    }

    public function criarPagamentoCartao(Request $request, string $linkHash): JsonResponse
    {
        $request->merge([
            'id_usuario' => session('user')['id'],
        ]);

        $token    = session('jwt_token');
        $response = Http::withToken($token)->post(
            config('api.route') . '/checkout/cartao/' . $linkHash,
            $request->all()
        );
        $data = $response->json();

        return response()->json($data);
    }
}
