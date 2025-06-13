<?php

declare(strict_types = 1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyContractLink
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $link = $request->route('linkHash');

        // Verifica se o link está autenticado na sessão
        if ($request->session()->has("auth_link_{$link}")) {
            return $next($request);
        }

        // Armazena o link e redireciona para login
        return redirect()->route('activation.login', ['linkHash' => $link]);
    }
}
