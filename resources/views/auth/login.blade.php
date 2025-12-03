<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión - PlayMatch</title>
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

        .login-card {
            position: relative;
            z-index: 1;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            padding: 30px 40px;
            box-shadow: 0 0 20px rgba(0,0,0,0.3);
            max-width: 420px;
            margin: 80px auto;
        }

        .login-title {
            text-align: center;
            color: #00ff7f;
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 20px;
        }

        .btn-login {
            background-color: #00ff7f !important;
            border: none;
            color: #000;
            font-weight: bold;
            width: 100%;
            border-radius: 25px;
            padding: 10px;
            transition: 0.3s;
        }

        .btn-login:hover {
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

    <div class="login-card">
        <h2 class="login-title">⚽ Bienvenido a PlayMatch</h2>

        <!-- Mensajes de estado -->
        @if (session('status'))
            <div class="mb-4 text-sm text-green-600 text-center">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Correo -->
            <div>
                <x-input-label for="correo" :value="__('Correo electrónico')" />
                <x-text-input id="correo" class="block mt-1 w-full rounded-md"
                              type="email" name="correo" :value="old('correo')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('correo')" class="mt-2" />
            </div>

            <!-- Contraseña -->
            <div class="mt-4">
                <x-input-label for="contrasena" :value="__('Contraseña')" />
                <x-text-input id="contrasena" class="block mt-1 w-full rounded-md"
                              type="password" name="contrasena" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('contrasena')" class="mt-2" />
            </div>

            <!-- Recordarme -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500"
                        name="remember">
                    <span class="ms-2 text-sm text-gray-600">Recordarme</span>
                </label>
            </div>

            <!-- Botón -->
            <div class="mt-5">
                <button type="submit" class="btn btn-login">Iniciar sesión</button>
            </div>

            <!-- Enlace a registro -->
            <div class="text-center mt-3 text-link">
                ¿No tienes una cuenta? <a href="{{ route('register') }}">Regístrate aquí</a>
            </div>

            <!-- Recuperar contraseña -->
            @if (Route::has('password.request'))
                <div class="text-center mt-2 text-link">
                    <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                </div>
            @endif
        </form>
    </div>

</body>
</html>
