<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        // Sprawdzanie roli użytkownika
        if (!Auth::check() || Auth::user()->role->name !== $role) {
            abort(403, 'Access denied');
        }

        // Jeśli rola pasuje, przekazujemy żądanie dalej
        return $next($request);
    }
}
