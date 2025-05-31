<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $response = Http::post(env('API_ROUTE') . '/login', [
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

        return redirect('/dashboard');
    }

    public function logout()
    {
        session()->forget('jwt_token');
        $response = Http::post(env('API_ROUTE') . '/logout');

        if ($response->failed()) {
            return back()->withErrors(['error' => 'Não foi possível realizar logout']);
        }

        return redirect('/login');
    }
}