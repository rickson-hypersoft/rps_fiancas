<?php

namespace App\Http\Controllers\Payments;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function formCheckout(string $link)
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)->get(config('api.route') . '/propostal/' . $link);
        $data     = $response->json();

        return view('payments.formCheckout', ['link' => $link, 'data' => $data]);
    }

    public function checkout(Request $request, string $link)
    {
        $paymentMethod = '';

        if ($request->all()['payment'] == 'PIX') {
            $paymentMethod = 'PIX';
        }

        if ($request->all()['payment'] == 'BOLETO') {
            $paymentMethod = 'BOLETO';
        }

        if ($request->all()['payment'] == 'CREDIT_CARD') {
            $paymentMethod = 'CARTÃO';
        }

        return view('payments.checkout', ['link' => $link, 'payment' => $paymentMethod]);
    }

    public function saveCheckout(Request $request, string $link)
    {
        $token         = session('jwt_token');
        $paymentMethod = $request->input('payment');

        $response = Http::withToken($token)->post(config('api.route') . '/payment/checkout/' . $link, ['payment' => $paymentMethod]);
    }
}