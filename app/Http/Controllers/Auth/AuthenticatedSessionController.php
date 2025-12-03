<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;




class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();
    $request->session()->regenerate();

    $usuario = Auth::user();

    // Aseguramos que la relación rol esté cargada (si existe relación)
    if (method_exists($usuario, 'loadMissing')) {
        $usuario->loadMissing('rol');
    }

    // 1) Intentamos detectar el rol vía relación Rol
    $nombreRol = null;
    if ($usuario->rol) {
        // busca distintos nombres de campo en el modelo Rol
        $nombreRol = $usuario->rol->nombre ?? $usuario->rol->nombre_rol ?? $usuario->rol->tipo ?? null;
        $idRol = $usuario->rol->id ?? $usuario->rol->id_rol ?? null;
    } else {
        // 2) Si no hay relación, comprueba campos directos en usuarios
        $nombreRol = $usuario->rol ?? $usuario->rol_nombre ?? null;
        $idRol = $usuario->id_rol ?? $usuario->rol_id ?? null;
    }

    // Normaliza
    $rolNormalizado = is_string($nombreRol) ? strtolower(trim($nombreRol)) : $nombreRol;
    $idRolInt = $idRol ? (int)$idRol : null;

    // Si el id de rol es 2 (tu admin) o el nombre es 'admin', redirige al admin
    if ($idRolInt === 2 || $rolNormalizado === 'admin' || $rolNormalizado === 'administrador') {
        return redirect()->intended(route('admin.dashboard'));
    }

    // Si no, va al index normal
    return redirect()->intended('/index');
}


    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
