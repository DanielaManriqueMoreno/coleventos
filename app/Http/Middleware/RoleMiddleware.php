<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login')->with('warning', 'Debes iniciar sesión.');
        }

        // Verificar el rol del usuario
        if (Auth::user()->rol !== $role) {
            return abort(403, 'Acceso denegado. No tienes permiso para acceder a esta sección.');
        }

        return $next($request);
    }
}
