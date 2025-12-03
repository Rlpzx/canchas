<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - PlayMatch</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background-color: #f4f6f8;
            font-family: 'Poppins', sans-serif;
        }
        .panel {
            max-width: 900px;
            margin: 60px auto;
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        h1 {
            color: #00b894;
            text-align: center;
            font-size: 2rem;
            margin-bottom: 20px;
        }
        .btn {
            display: inline-block;
            background: #00b894;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s;
        }
        .btn:hover {
            background: #019874;
        }
    </style>
</head>
<body>

    <div class="panel">
        <h1>🏆 Bienvenido al Panel de Administración</h1>
        <p style="text-align:center;">Desde aquí podrás gestionar las canchas, usuarios, reservas y pagos.</p>

        <div style="text-align:center; margin-top:30px;">
            <a href="{{ route('index') }}" class="btn">Ir al sitio principal</a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn" style="background:#d63031;">Cerrar sesión</button>
            </form>
        </div>
    </div>

</body>
</html>
