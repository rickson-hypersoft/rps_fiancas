<?php

declare(strict_types = 1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserCategory
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $requiredCategory): Response
    {
        $userCategory = session('user')['categoria'];

        if ($userCategory !== $requiredCategory) {
            abort(403, 'Acesso não autorizado.');
        }

        return $next($request);
    }
}
