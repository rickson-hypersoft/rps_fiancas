<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        $idImobiliaria = session('user')['id_imobiliaria'];

        $token           = session('jwt_token');
        $response       = Http::withToken($token)->get(config('api.route') . '/home/' . $idImobiliaria);
        $contratos = $response->json()['contratos'];
        $propostas = $response->json()['propostas'];

        return view('home', ['contratos' => $contratos, 'propostas' => $propostas]);
    }
}
