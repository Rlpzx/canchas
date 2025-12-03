<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Mostrar la vista de registro.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Registrar un nuevo usuario.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // ✅ Validación corregida
        $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'correo' => ['required', 'string', 'email', 'max:255', 'unique:usuarios,correo'],
            'contrasena' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // ✅ Crear usuario con los nombres de columnas correctos
        $user = User::create([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'contrasena' => Hash::make($request->contrasena),
             'id_rol' => 1,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('home');
 // o ->intended('/index');
    }
}
