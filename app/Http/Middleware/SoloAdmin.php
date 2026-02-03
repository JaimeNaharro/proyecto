<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SoloAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Verifica que el rol sea 0 (Admin)
        if ((int)session('usuario_rol') !== 0) {
            return redirect()->route('vehiculos.index')
                             ->with('error', 'Acceso denegado.');
        }

        return $next($request);
    }
}