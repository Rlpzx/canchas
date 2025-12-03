<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PlayMatch | Canchas Sintéticas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url("{{ asset('assets/img/cancha-futbol.jpg') }}") no-repeat center center/cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-shadow: 1px 1px 8px rgba(0,0,0,0.6);
            font-family: 'Poppins', sans-serif;
        }

        .overlay {
            background: rgba(0, 0, 0, 0.6);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .welcome-box {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        h1 {
            font-size: 3rem;
            font-weight: 700;
            color: #00ff7f;
        }

        p {
            font-size: 1.2rem;
        }

        .btn-login {
            background-color: #00ff7f;
            border: none;
            color: #000;
            font-weight: 600;
            padding: 10px 25px;
            border-radius: 25px;
            text-decoration: none;
        }

        .btn-login:hover {
            background-color: #00e070;
            color: #000;
        }

        .navbar {
            position: absolute;
            top: 15px;
            left: 0;
            width: 100%;
            background: transparent;
        }

        .navbar-brand {
            color: #00ff7f !important;
            font-weight: bold;
            font-size: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="overlay"></div>
    <nav class="navbar px-4">
        <a class="navbar-brand" href="#">⚽ PlayMatch</a>
        <div>
            @if (Route::has('login'))
                <div class="d-inline">
                    @auth
                        <a href="{{ url('/index') }}" class="btn btn-success">Ir al Panel</a>
                    @else
                        <a href="{{ route('login') }}" class="btn-login">Iniciar sesión</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-login ms-2">Registrarse</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </nav>

    <div class="welcome-box">
        <h1>Bienvenido a PlayMatch</h1>
        <p>Reserva, administra y descubre las mejores canchas sintéticas de tu ciudad.</p>
        <div class="mt-4">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/index') }}" class="btn-login">Entrar al sistema</a>
                @else
                    <a href="{{ route('login') }}" class="btn-login">Comenzar ahora</a>
                @endauth
            @endif
        </div>
    </div>
</body>
</html>
