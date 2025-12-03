<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Panel Administrativo')</title>

  <!-- Bootstrap e iconos -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f8f9fa;
      min-height: 100vh;
      display: flex;
    }

    /* Sidebar */
    .sidebar {
      width: 250px;
      background-color: #212529;
      color: #fff;
      min-height: 100vh;
      position: fixed;
      left: 0;
      top: 0;
      padding: 20px 0;
      display: flex;
      flex-direction: column;
    }

    .sidebar .logo {
      font-size: 1.4rem;
      font-weight: 600;
      text-align: center;
      margin-bottom: 30px;
      color: #fff;
    }

    .sidebar a {
      display: block;
      padding: 12px 20px;
      color: #adb5bd;
      text-decoration: none;
      transition: 0.3s;
    }

    .sidebar a:hover,
    .sidebar a.active {
      background-color: #0d6efd;
      color: #fff;
    }

    /* Main content */
    .content {
      margin-left: 250px;
      width: calc(100% - 250px);
      padding: 30px;
    }

    /* Header */
    .admin-header {
      background: #fff;
      padding: 15px 25px;
      border-radius: 8px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
    }

    .admin-header h1 {
      font-size: 1.5rem;
      font-weight: 600;
      margin: 0;
    }

    .admin-header .user-info {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .admin-header img {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      object-fit: cover;
    }

    footer {
      text-align: center;
      margin-top: 40px;
      color: #6c757d;
      font-size: 0.9rem;
    }
  </style>

  @stack('styles')
</head>
<body>

  <!-- Sidebar -->
  <aside class="sidebar">
    <div class="logo">⚽ PlayMatch Admin</div>

    <nav>
      <a href="{{ route('admin.dashboard') }}" class="{{ request()->is('admin.dashboard') ? 'active' : '' }}">
        <i class="bi bi-house-door"></i> Dashboard
      </a>
      <a href="{{ route('canchaA') }}" class="{{ request()->is('canchaAdmi*') ? 'active' : '' }}">
        <i class="bi bi-building"></i> Canchas
      </a>
      <a href="{{ route('admin.reservas') }}" class="{{ request()->is('index*') ? 'active' : '' }}">
        <i class="bi bi-calendar-check"></i> Reservas
      </a>
      
        <form action="{{ route('logout') }}" method="POST" style="display:inline-block; margin:0;">
    @csrf
    <button type="submit" class="btn btn-link text-danger p-0" style="text-decoration:none;">
      <i class="bi bi-box-arrow-right"></i> Cerrar sesión
    </button>
  </form>
    </nav>
  </aside>

  <!-- Contenido principal -->
  <main class="content">
    <div class="admin-header">
      <h1>@yield('header', 'Panel Administrativo')</h1>
      <div class="user-info">
        <a href="{{ route('admin.profile') }}" class="btn btn-outline-primary">{{ auth()->user()->nombre ?? auth()->user()->name ?? 'Administrador' }}
            <img src="{{ asset('assets/img/admin.jpg') }}" alt="Usuario">
        </a>

        
      </div>
    </div>

    @yield('content')

    <footer>
      <p>&copy; {{ date('Y') }} PlayMatch — Panel Administrativo</p>
    </footer>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')
</body>
</html>
