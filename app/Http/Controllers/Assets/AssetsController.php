<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Assets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class AssetsController extends Controller
{
    public function index(string $link)
    {
        return view('assets.index', ['link' => $link]);
    }

    public function faceId(string $link)
    {
        // Por enquanto vai marcar face_id = 1;
        $token = session('jwt_token');

        $response = Http::withToken($token)->get(config('api.route') . '/assets/faceId/' . $link);
        $data     = $response->json();

        return view('assets.confirm', ['link' => $link]);
    }

    public function term(string $link)
    {
        return view('assets.term', ['link' => $link]);
    }

    public function formCheckout(string $link)
    {
        $token    = session('jwt_token');
        $response = Http::withToken($token)->get(config('api.route') . '/propostal/' . $link);
        $data     = $response->json();

        return view('assets.formCheckout', ['link' => $link, 'data' => $data]);
    }

    public function checkout(Request $request, string $link)
    {
        $paymentMethod = '';

        if ($request->all()['payment'] == 'pix') {
            $paymentMethod = 'PIX';
        }

        if ($request->all()['payment'] == 'boleto') {
            $paymentMethod = 'BOLETO';
        }

        if ($request->all()['payment'] == 'credit-card') {
            $paymentMethod = 'CARTÃO';
        }

        return view('assets.checkout', ['link' => $link, 'payment' => $paymentMethod]);
    }

    public function saveCheckout(Request $request, string $link)
    {
        $token         = session('jwt_token');
        $paymentMethod = $request->input('payment');

        $response = Http::withToken($token)->post(config('api.route') . '/assets/checkout/' . $link, ['payment' => $paymentMethod]);
        dd($response->json());
    }

    public function login(string $link): View
    {
        return view('assets.login', ['link' => $link]);
    }

    public function verifyLogin(Request $request)
    {
        $request->validate([
            'cpf'  => 'required|string',
            'link' => 'required|string',
        ]);

        $token = session('jwt_token');

        $response = Http::withToken($token)->get(config('api.route') . '/assets/active/' . $request->input('link'));
        $data     = $response->json();

        if (! $data) {
            return redirect()->back()->withErrors(['message' => 'Link inválido.']);
        }

        if ($data['data']['pessoa_doc'] !== $request->input('cpf')) {
            return redirect()->back()->withErrors(['message' => 'CPF inválido.']);
        }

        // Salva na sessão que este link foi autenticado
        session(["auth_link_{$request->input('link')}" => true]);

        return redirect()->route('assets.activation', ['link' => $request->input('link')]);
    }
}
