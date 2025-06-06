<?php

declare(strict_types=1);

namespace App\Http\Controllers\Assets;

use DateTime;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Services\EmailService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class AssetsController extends Controller
{
    public function index()
    {
        return view('assets.index');
    }

    public function login(string $link): View
    {
        return view('assets.login', ['link' => $link]);
    }

    public function verifyLogin(Request $request)
    {
        $request->validate([
            'cpf' => 'required|string',
            'link' => 'required|string',
        ]);

        $token = session('jwt_token');

        $response = Http::withToken($token)->get(config('api.route') . '/assets/active/' . $request->input('link'));
        $data     = $response->json();

        if (!$data) {
            return redirect()->back()->withErrors(['message' => 'Link inválido.']);
        }

        if ($data['data']['pessoa_doc'] !== $request->input('cpf')) {
            return redirect()->back()->withErrors(['message' => 'CPF inválido.']);
        }

        // Salva na sessão que este link foi autenticado
        session(["auth_link_{$request->input('link')}" => true]);

        return redirect()->route('assets.active', ['link' => $request->input('link')]);
    }
}
