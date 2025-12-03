<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RolMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (! $user) {
            // no autenticado -> redirigir al login
            return redirect()->route('login');
        }

        // cargar relación rol si existe
        if (method_exists($user, 'loadMissing')) {
            $user->loadMissing('rol');
        }

        // obtener id_rol y nombre del rol desde relación o campo directo
        $idRol = $user->id_rol ?? $user->rol_id ?? null;
        $nombreRol = optional($user->rol)->nombre ?? $user->rol ?? $user->role ?? null;
        $nombreRolNormalizado = is_string($nombreRol) ? strtolower(trim($nombreRol)) : null;

        // condición de administrador: id = 2 o nombre = 'administrador' (case-insensitive)
        if ((int)$idRol === 2 || in_array($nombreRolNormalizado, ['admin','administrador'], true)) {
            return $next($request);
        }

        // DEBUG temporal (opcional): escribe en log para depurar desde el navegador
        // \Log::debug('RolMiddleware', ['user_id'=> $user->id, 'idRol'=>$idRol, 'nombreRol'=>$nombreRol]);

        abort(403, 'Acceso denegado.');
    }
}
