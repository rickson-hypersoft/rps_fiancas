<?php

declare(strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $idImobiliaria = session('user')['id_imobiliaria'] ?? null;

        $token     = session('jwt_token');
        $response  = Http::withToken($token)->get(config('api.route') . '/home/' . $idImobiliaria);
        $contratos = $response->json()['contratos'];
        $propostas = $response->json()['propostas'];
        $cards     = $response->json()['propostasCard'];

        return view('home', ['contratos' => $contratos, 'propostas' => $propostas, 'cards' => $cards]);
    }
}
