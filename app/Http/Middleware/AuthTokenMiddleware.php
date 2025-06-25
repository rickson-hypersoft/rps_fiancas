<?php

declare(strict_types = 1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthTokenMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = session('jwt_token');

        if (! $token) {
            return redirect()->route('login');
        }

        // Decodifica o payload do token JWT
        $parts = explode('.', (string) $token);

        if (count($parts) !== 3) {
            session()->forget('jwt_token');

            return redirect()->route('login');
        }

        $payload = json_decode(base64_decode(strtr($parts[1], '-_', '+/')), true);

        // Verifica se o token expirou
        if (! isset($payload['exp']) || time() >= $payload['exp']) {
            session()->forget('jwt_token');

            return redirect()->route('login')->withErrors(['Sessão expirada. Faça login novamente.']);
        }

        return $next($request);
    }
}
