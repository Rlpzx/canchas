
<header id="header" class="header">
  <div class="container-fluid container-xl">
    <a href="{{ url('/index') }}" class="logo">
      <img src="{{ asset('assets/img/logo.png') }}" alt="logo">
    </a>

      

    <!-- Nav: visible en desktop, oculto en móvil hasta activar -->
    <nav id="navmenu" class="navmenu d-none d-xl-flex">
      <ul>
        <li><a href="{{ url('/index') }}" class="active">Inicio</a></li>
        <li><a href="{{ url('/canchas') }}">Canchas</a></li>
        <li><a href="{{ route('reservas.index') }}">Reservas</a></li>
        <li><a href="{{ url('/contacto') }}">Contacto</a></li>
        <li><a href="{{ url('/acerca') }}">Acerca</a></li>
        <li><a href="{{ url('/ayuda') }}">Ayuda</a></li>
      </ul>
    </nav>

    <div class="header-actions">
      
      <i class="mobile-nav-toggle d-xl-none bi bi-list" aria-hidden="true"></i>
      @auth
        <form method="POST" action="{{ route('logout') }}" class="inline">
          @csrf
          <button type="submit" class="btn-cta">Cerrar sesión</button>
        </form>
      @else
        <a href="{{ route('login') }}" class="btn-cta">Iniciar sesión</a>
      @endauth

    </div>
  </div>
</header>

