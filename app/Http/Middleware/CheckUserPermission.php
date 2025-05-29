<?php

declare(strict_types = 1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string | int $permId): Response
    {
        $userPermission = session('user')['permissoes'];
        $permissions    = explode('|', trim($userPermission, '|'));

        if (! in_array($permId, $permissions)) {
            return redirect()->route('permission_denied');
        }

        return $next($request);
    }
}
