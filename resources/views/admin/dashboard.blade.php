<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel Admin - PlayMatch</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: Poppins, sans-serif; background:#f4f6f8; }
        .panel { max-width:1000px; margin:50px auto; background:#fff; padding:30px; border-radius:10px; box-shadow:0 6px 30px rgba(0,0,0,0.08);}
        .actions { margin-top:20px; display:flex; gap:12px; justify-content:center; }
        .btn { padding:10px 16px; border-radius:8px; text-decoration:none; font-weight:600; }
        .btn-primary { background:#00b894; color:#fff; }
        .btn-logout { background:#e74c3c; color:#fff; }
    </style>
</head>
<body>
    <div class="panel">
        <h1 style="text-align:center;">🏆 Panel de administración — PlayMatch</h1>
        <p style="text-align:center;color:#666;">Bienvenido, {{ auth()->user()->nombre ?? auth()->user()->name ?? 'Administrador' }}.</p>

        <div style="display:flex;justify-content:center;gap:20px;margin-top:20px;flex-wrap:wrap;">
            <a href="{{ route('canchaA') }}" class="btn btn-primary">Gestionar canchas</a>
            <a href="{{ route('crear_cancha') }}" class="btn btn-primary">Agregar cancha</a>
            <a href="{{ route('admin.profile') }}" class="btn btn-outline-primary"> 👤 Mi Perfil</a>
        </div>

        <div class="actions">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-logout">Cerrar sesión</button>
            </form>
        </div>

        <hr style="margin:24px 0;">
        <div>
            <h3>Información rápida</h3>
           @php $adminId = auth()->id(); @endphp

<ul>
  <li>Total canchas: {{ \App\Models\Cancha::where('id_admin', $adminId)->count() }}</li>

  <li>
    Total reservas hoy:
    {{ \App\Models\Reserva::whereDate('fecha', now()->toDateString())
         ->whereHas('cancha', function($q) use ($adminId) {
             $q->where('id_admin', $adminId);
         })
         ->count() }}
  </li>
</ul>

        </div>
    </div>
</body>
</html>
