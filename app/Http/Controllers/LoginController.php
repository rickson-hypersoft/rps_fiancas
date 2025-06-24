<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class LoginController extends Controller
{
    public function index(): View
    {
        return view('login');
    }

    public function login(Request $request): RedirectResponse
    {
        $response = Http::post(config('api.route') . '/login', [
            'login'    => $request->login,
            'password' => $request->password,
        ]);

        if ($response->failed()) {
            $data = $response->json();

            return back()->withErrors($data['message'])->withInput();
        }

        $data                      = $response->json();
        $token                     = $data['token'];
        $user                      = $data['user'];
        $realEstateSectorOrCompany = $data['realEstateSectorOrCompany'];

        session(['jwt_token' => $token, 'user' => $user, 'realEstateSectorOrCompany' => $realEstateSectorOrCompany]);

        return redirect()->route('home');
    }

    public function logout(): RedirectResponse
    {
        session()->forget('jwt_token');
        $response = Http::post(config('api.route') . '/logout');

        if ($response->failed()) {
            return back()->withErrors(['error' => 'Não foi possível realizar logout']);
        }

         return redirect()->route('login');
    }
}