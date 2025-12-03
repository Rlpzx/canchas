<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse - PlayMatch</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<style>
    body {
        background: url("{{ asset('assets/img/cancha-futbol.jpg') }}") no-repeat center center/cover;
        font-family: 'Poppins', sans-serif;
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        z-index: 0;
    }

    .register-card {
        position: relative;
        z-index: 1;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 20px;
        padding: 30px 40px;
        box-shadow: 0 0 20px rgba(0,0,0,0.3);
        max-width: 420px;
        margin: 80px auto;
    }

    .register-title {
        text-align: center;
        color: #00ff7f;
        font-weight: 700;
        font-size: 1.8rem;
        margin-bottom: 20px;
    }

    .btn-register {
        background-color: #00ff7f !important;
        border: none;
        color: #000;
        font-weight: bold;
        width: 100%;
        border-radius: 25px;
        padding: 10px;
        transition: 0.3s;
    }

    .btn-register:hover {
        background-color: #00e070 !important;
    }

    .text-link {
        color: #333;
        font-size: 0.9rem;
    }

    .text-link a {
        color: #00ff7f;
        text-decoration: none;
    }

    .text-link a:hover {
        text-decoration: underline;
    }
</style>

<div class="overlay"></div>

<div class="register-card">
    <h2 class="register-title">⚽ Crea tu cuenta en PlayMatch</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nombre -->
        <div>
            <x-input-label for="nombre" :value="__('Nombre completo')" />
            <x-text-input id="nombre" class="block mt-1 w-full rounded-md"
                          type="text"
                          name="nombre"
                          :value="old('nombre')"
                          required autofocus autocomplete="nombre" />
            <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
        </div>

        <!-- Correo -->
        <div class="mt-4">
            <x-input-label for="correo" :value="__('Correo electrónico')" />
            <x-text-input id="correo" class="block mt-1 w-full rounded-md"
                          type="email"
                          name="correo"
                          :value="old('correo')"
                          required autocomplete="correo" />
            <x-input-error :messages="$errors->get('correo')" class="mt-2" />
        </div>

        <!-- Contraseña -->
        <div class="mt-4">
            <x-input-label for="contrasena" :value="__('Contraseña')" />
            <x-text-input id="contrasena" class="block mt-1 w-full rounded-md"
                          type="password"
                          name="contrasena"
                          required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('contrasena')" class="mt-2" />
        </div>

        <!-- Confirmar contraseña -->
        <div class="mt-4">
            <x-input-label for="contrasena_confirmation" :value="__('Confirmar contraseña')" />
            <x-text-input id="contrasena_confirmation" class="block mt-1 w-full rounded-md"
                          type="password"
                          name="contrasena_confirmation"
                          required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('contrasena_confirmation')" class="mt-2" />
        </div>

        <!-- Botón -->
        <div class="mt-5">
            <button type="submit" class="btn btn-register">Registrarse</button>
        </div>

        <!-- Enlace a login -->
        <div class="text-center mt-3 text-link">
            ¿Ya tienes una cuenta? <a href="{{ route('login') }}">Inicia sesión</a>
        </div>
    </form>
</div>
</body>
</html>
