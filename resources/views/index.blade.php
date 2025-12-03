@extends('layout.app')

@section('title','Inicio')

@section('content')

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="hero-wrapper">
          <div class="row g-4">

            <div class="col-lg-7">
              <div class="hero-content" data-aos="zoom-in" data-aos-delay="200">
                <div class="content-header">
                  <span class="hero-label">
                   <i class="ti ti-soccer-field"></i>
                    Las mejores canchas te esperan
                  </span>
                  <h1>Tu eliges cuando y donde reservar</h1>
                  <p>Ya no tienes excusas para no recrear, con PlayMatch reserva tu cancha sin importar el dia ni la hora podras encontrar tu cancha disponible en cualquir parte de la ciudad.</p>
                </div>

                <div class="search-container" data-aos="fade-up" data-aos-delay="300">
                  <div class="search-header">
                    <h3>Empieza a buscar la mejor opcion</h3>
                    <p>Hay canchas de todo tipo y tamaño</p>
                  </div>

                  <form action="" class="property-search-form">
                    <div class="search-grid">

                      <div class="search-field">
                        <label for="search-type" class="field-label">Tipo de cancha</label>
                        <select id="search-type" name="property_type" required="">
                          <option value="f5">Futbol 5</option>
                          <option value="f6">Futbol 6</option>
                          <option value="f9">Futbol 9</option>
                          <option value="f11">Futbol 11</option>
                        </select>
                        <i class="bi bi-building field-icon"></i>
                      </div>

                      <div class="search-field">
                        <label for="search-budget" class="field-label">Rango de precio</label>
                        <select id="search-budget" name="price_range" required="">
                          <option value="0-300000+">todos los precios</option>
                          <option value="0-100000">menos $100K</option>
                          <option value="100000-200000">$100K - $200K</option>
                          <option value="200000-300000">$200K - $300K</option>
                          <option value="300000+">Mas de 300k</option>
                        </select>
                        <i class="bi bi-currency-dollar field-icon"></i>
                      </div>

                    </div>

                    <button type="submit" class="search-btn">
                      <i class="bi bi-search"></i>
                      <span>Buscar</span>
                    </button>
                  </form>
                </div>

                <div class="achievement-grid" data-aos="fade-up" data-aos-delay="400">

                </div>
              </div>
            </div><!-- End Hero Content -->

            <div class="col-lg-5">
              <div class="hero-visual" data-aos="fade-left" data-aos-delay="400">
                <div class="visual-container">
                 @if($featured)
<div class="featured-property">
{{-- Imagen principal (campo canchas.imagen) --}}
<img src="{{ asset('storage/' . ltrim($featured->imagen_principal ?? '', '/')) }}"
     alt="{{ $featured->nombre }}"
     class="img-fluid mb-3"
     >



  <div class="property-info mt-2">
    <div class="property-price">${{ number_format($featured->precio ?? $featured->precio_hora ?? 0, 0, ',', '.') }}</div>
    <div class="property-details">
      <span><i class="bi bi-geo-alt"></i> {{ $featured->ubicacion ?? 'Sin ubicación' }}</span>
      <span><i class="ti ti-soccer-field"></i> {{ $featured->tipo ?? 'Cancha' }}</span>
    </div>
  </div>
</div>

@else
<!-- fallback estático -->
<div class="featured-property">
  <img src="{{ asset('assets/img/cancha1.jpeg') }}" alt="Featured Property" class="img-fluid">
</div>
@endif

<div class="overlay-images d-flex gap-2 mt-2">
    @if(isset($featured) && $featured->images && $featured->images->where('es_principal', false)->count() > 0)
        {{-- Mostramos hasta 2 imágenes adicionales --}}
        @foreach($featured->images->where('es_principal', false)->take(2) as $idx => $img)
            @php
                $imgPath = isset($img->ruta) ? ltrim($img->ruta, '/') : null;
            @endphp
            @if($imgPath && file_exists(public_path('storage/' . $imgPath)))
                <div class="overlay-img overlay-{{ $idx + 1 }}">
                    <img src="{{ asset('storage/' . $imgPath) }}"
                         alt="{{ $img->alt ?? $featured->nombre }}"
                         class="img-fluid rounded shadow-sm">
                </div>
            @endif
        @endforeach
    @endif
</div>



<div class="property-hero-content">
  <div class="property-header">
    <div class="property-info">
      <h2>
        @if($featured)
          <a href="{{ url('/canchas/'.$featured->id) }}">{{ $featured->nombre }}</a>
        @else
          <a href="#">Nombre del local</a>
        @endif
      </h2>
      <div class="property-address">
        <i class="bi bi-geo-alt-fill"></i>
        <span>{{ $featured->ubicacion ?? 'Dirección' }}</span>
      </div>
    </div>
    <div class="property-price-main">${{ number_format($featured->precio ?? $featured->precio_hora ?? 0, 0, ',', '.') }}</div>
  </div>

  <p class="property-description">{{ Str::limit($featured->descripcion ?? 'Descripción no disponible', 180) }}</p>

  <div class="property-actions-main">
    @if($featured)
      <a href="{{ route('reservas.create') }}" class="btn-primary-custom">Reservar cancha</a>
    {{-- 
  Preguntamos si $featured tiene datos (no es null).
  Si no tiene, el enlace simplemente no se mostrará.
--}}

    <a href="{{ route('detalle.cancha', ['id' => $featured->id_cancha]) }}" class="btn-outline-custom">
        Más detalles
    </a>
    @else
    <a class="btn-outline-custom disabled">No disponible</a>






    
    @endif
  </div>
</div>

                </div>
              </div>
            </div><!-- End Hero Visual -->

          </div>
        </div>

      </div>

    </section><!-- /Hero Section -->

    <!-- Home About Section -->
    <section id="home-about" class="home-about section">

      

    </section><!-- /Home About Section -->

    <!-- Featured Properties Section -->
    <section id="featured-properties" class="featured-properties section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Calidad precio</h2>
        <p>Aui encuentras las mejores canchas con mejores precios </p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-5">

          <div class="col-lg-8">

            <div class="featured-property-main" data-aos="zoom-in" data-aos-delay="200">
              <div class="property-hero">
                @if ($canchaMasBarata)
              <!--aqui va las igamenes de la base de datos -->
                 <img src="{{ asset('storage/' . ltrim($canchaMasBarata->imagen_principal ?? '', '/')) }}" alt="{{  $canchaMasBarata->nombre ?? '...' }}" class="img-fluid" onerror="this.src='{{ asset('assets/img/real-estate/property-exterior-2.webp') }}'"> <img src="" alt="" class="">
                <div class="property-overlay">
                
                  <div class="property-stats">
                    
                    <div class="stat-item">
                     <span><i class="ti ti-soccer-field"></i> {{ $canchaMasBarata->tipo ?? 'Sin dirección' }}</span>
                    </div>
                    
                  </div>
                </div>
              </div>
              <div class="property-hero-content">
                <div class="property-header">
                  <div class="property-info">
                    <h2><a href="property-details.html">nombre del local</a></h2>
                    <div class="property-address">
                      <i class="bi bi-geo-alt-fill"></i>
                      <span>{{ $canchaMasBarata->ubicacion ?? 'Sin dirección' }}</span>
                    </div>
                  </div>
                  <div class="property-price-main">${{ number_format($canchaMasBarata->precio ?? $mostReserved->precio_hora ?? 0,0,',','.') }}</div>
                </div>
                <p class="property-description">{{ $canchaMasBarata->descripcion ?? 'Sin descripcion' }}</p>
                <div class="property-actions-main">

                  <a href="{{ url('/canchas/'.$featured->id) }}" class="btn-primary-custom">reservar cancha</a>
                 
                       <a href="{{ route('detalle.cancha', ['id' => $canchaMasBarata->id_cancha]) }}" class="btn-outline-custom">mas detalles</a>
                        @else
                          <a class="btn-outline-custom disabled">No disponible</a>
                          @endif
                </div>
              </div>
            </div>

          </div>

          <div class="col-lg-4">

            <div class="properties-sidebar">

              <div class="sidebar-property-card" data-aos="fade-left" data-aos-delay="300">
  <div class="sidebar-property-image">
    <img src="{{ asset('storage/' . ltrim($mostReserved->imagen_principal ?? '', '/')) }}" alt="{{ $mostReserved->nombre ?? '...' }}" class="img-fluid" onerror="this.src='{{ asset('assets/img/real-estate/property-exterior-2.webp') }}'">
    <div class="sidebar-property-badge hot">Mas reservada</div>
  </div>
  <div class="sidebar-property-content">
    @if ($mostReserved)
    <h4><a href="{{ url('/canchas/'.($mostReserved->id ?? '#')) }}">{{ $mostReserved->nombre ?? 'Sin nombre' }}</a></h4>
    <div class="sidebar-location">
      <i class="bi bi-pin-map"></i>
      <span>{{ $mostReserved->ubicacion ?? 'Sin dirección' }}</span>
    </div>
    <div class="sidebar-price-row">
      <div class="sidebar-price">${{ number_format($mostReserved->precio ?? $mostReserved->precio_hora ?? 0,0,',','.') }}</div>
      <a href="{{ url('/canchas/'.($mostReserved->id ?? '#')) }}" class="sidebar-btn">Reservar</a>
      <a href="{{ route('detalle.cancha', ['id' => $mostReserved->id_cancha]) }}" class="sidebar-btn">Detalles</a>
       
    </div>
    @else
         <a class="btn-outline-custom disabled">No disponible</a>
       @endif
  </div>
</div>

@if($latest)
<div class="sidebar-property-card" data-aos="fade-left" data-aos-delay="400">
  <div class="sidebar-property-image">
    <img src="{{ asset('storage/' . ltrim($latest->imagen_principal ?? '', '/')) }}" alt="{{ $latest->nombre ?? '' }}" class="img-fluid" onerror="this.src='{{ asset('assets/img/real-estate/property-exterior-2.webp') }}'">
    <div class="sidebar-property-badge new">Lo mas nuevo</div>
  </div>
  <div class="sidebar-property-content">
    <h4><a href="{{ url('/canchas/'.($latest->id ?? '#')) }}">{{ $latest->nombre ?? 'Nombre' }}</a></h4>
    <div class="sidebar-location">
      <i class="bi bi-pin-map"></i>
      <span>{{ $latest->ubicacion ?? 'Dirección' }}</span>
    </div>
    <div class="sidebar-price-row">
      <div class="sidebar-price">${{ number_format($latest->precio ?? $latest->precio_hora ?? 0,0,',','.') }}</div>
      <a href="{{ url('/canchas/'.($latest->id ?? '#')) }}" class="sidebar-btn">Reservar</a>
      <a href="{{ route('detalle.cancha', ['id' => $latest->id_cancha]) }}" class="sidebar-btn">Detalles</a>
    </div>
  </div>
</div>
@endif

    </div>
  </div>

</section>

<!-- Reseñas -->
<section id="testimonials" class="testimonials section light-background">
  <div class="container section-title" data-aos="fade-up">
    <h2>Reseñas</h2>
    <p>Lo que dicen los usuarios sobre sus reservas y experiencia en PlayMatch.</p>
  </div>

  <div class="container">
    <div class="testimonial-grid">

      @php
        $reviews = [
          ['img'=>'assets/img/person/person-f-5.webp','nombre'=>'Sofía Martínez','cargo'=>'Jugador amateur','texto'=>'Reservé una cancha en 2 minutos, todo perfecto.'],
          ['img'=>'assets/img/person/person-m-5.webp','nombre'=>'Carlos Díaz','cargo'=>'Entrenador','texto'=>'Buena gestión de horarios y facilidad de pago.'],
          ['img'=>'assets/img/person/person-f-6.webp','nombre'=>'Laura Gómez','cargo'=>'Estudiante','texto'=>'Precios justos y canchas en buen estado.'],
          ['img'=>'assets/img/person/person-m-6.webp','nombre'=>'Javier Pérez','cargo'=>'Afiliado','texto'=>'Excelente atención y confirmación rápida.'],
        ];
      @endphp

      @foreach($reviews as $r)
        <div class="testimonial-item" data-aos="zoom-in">
          <div class="testimonial-card">
            <div class="testimonial-header">
              <div class="testimonial-image">
                <img src="{{ asset($r['img']) }}" class="img-fluid" alt="{{ $r['nombre'] }}">
              </div>
              <div class="testimonial-meta">
                <h3>{{ $r['nombre'] }}</h3>
                <h4>{{ $r['cargo'] }}</h4>
              </div>
            </div>
            <div class="testimonial-body">
              <i class="bi bi-chat-quote-fill quote-icon"></i>
              <p>{{ $r['texto'] }}</p>
            </div>
          </div>
        </div>
      @endforeach

    </div>
  </div>
</section>
<!-- Por qué elegir PlayMatch -->
<section id="why-us" class="why-us section">
  <div class="container section-title" data-aos="fade-up">
    <h2>¿Por qué elegir PlayMatch?</h2>
    <p>Reservas rápidas, canchas verificadas y soporte cuando lo necesitas.</p>
  </div>

  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row gy-4">
      <div class="col-lg-6" data-aos="fade-right">
        <div class="content">
          <h3>La forma más fácil de reservar canchas</h3>
          <p>Con PlayMatch puedes ver disponibilidad en tiempo real, filtrar por deporte y pagar desde tu celular.</p>

          <div class="features-list">
            <div class="feature-item d-flex align-items-center mb-3">
              <div class="icon-wrapper me-3"><i class="bi bi-clock-history"></i></div>
              <div><h5>Reservas instantáneas</h5><p>Confirma y juega en minutos.</p></div>
            </div>

            <div class="feature-item d-flex align-items-center mb-3">
              <div class="icon-wrapper me-3"><i class="bi bi-geo-alt"></i></div>
              <div><h5>Canchas cercanas</h5><p>Filtra por ubicación y tipo de cancha.</p></div>
            </div>

            <div class="feature-item d-flex align-items-center mb-3">
              <div class="icon-wrapper me-3"><i class="bi bi-shield-check"></i></div>
              <div><h5>Cancha verificada</h5><p>Solo locales con estándares mínimos de calidad.</p></div>
            </div>
          </div>

        </div>
      </div>

      <div class="col-lg-6" data-aos="fade-left">
        <div class="row gy-4">
          <div class="col-md-6">
            <div class="stat-card text-center">
              <div class="stat-icon mb-3"><i class="bi bi-calendar-check"></i></div>
              <div class="stat-number"><span class="purecounter" data-purecounter-start="0" data-purecounter-end="1200" data-purecounter-duration="2"></span>+</div>
              <div class="stat-label">Reservas</div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="stat-card text-center">
              <div class="stat-icon mb-3"><i class="bi bi-people"></i></div>
              <div class="stat-number"><span class="purecounter" data-purecounter-start="0" data-purecounter-end="500" data-purecounter-duration="2"></span>+</div>
              <div class="stat-label">Usuarios</div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="stat-card text-center">
              <div class="stat-icon mb-3"><i class="bi bi-award"></i></div>
              <div class="stat-number"><span class="purecounter" data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="2"></span>+</div>
              <div class="stat-label">Canchas Top</div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="stat-card text-center">
              <div class="stat-icon mb-3"><i class="bi bi-clock-history"></i></div>
              <div class="stat-number"><span class="purecounter" data-purecounter-start="0" data-purecounter-end="3" data-purecounter-duration="2"></span>+</div>
              <div class="stat-label">Años</div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
<!-- Noticias -->
<section id="recent-blog-posts" class="recent-blog-posts section">
  <div class="container section-title" data-aos="fade-up">
    <h2>Noticias</h2>
    <p>Últimas novedades y consejos para sacar el máximo provecho a PlayMatch.</p>
  </div>

  <div class="container" data-aos="fade-up" data-aos-delay="100">
    <div class="row">

      <div class="col-lg-8">
        <article class="featured-post" data-aos="fade-up">
          <div class="featured-img">
            <img src="{{ asset('assets/img/cancha2.jpeg') }}" alt="" class="img-fluid" loading="lazy">
            <div class="featured-badge">Destacado</div>
          </div>

          <div class="featured-content">
            <div class="post-header">
              <a href="#" class="category">Actualizaciones</a>
              <span class="post-date">Oct 10, 2025</span>
            </div>

            <h2 class="post-title">
              <a href="#">Nuevas canchas añadidas este mes</a>
            </h2>

            <p class="post-excerpt">
              Hemos incorporado nuevas canchas a nuestra plataforma con horarios ampliados y mejores precios para fines de semana.
            </p>

            <div class="post-footer">
              <div class="author-info">
                <img src="{{ asset('assets/img/person/person-m-8.webp') }}" alt="" class="author-avatar">
                <div class="author-details">
                  <span class="author-name">Equipo PlayMatch</span>
                  <span class="read-time">2 min read</span>
                </div>
              </div>
              <a href="#" class="read-more">Leer más</a>
            </div>
          </div>
        </article>
      </div>

      <div class="col-lg-4">
        <article class="recent-post" data-aos="fade-up">
          <div class="recent-img">
            <img src="{{ asset('assets/img/cancha1.jpeg') }}" alt="" class="img-fluid" loading="lazy">
          </div>
          <div class="recent-content">
            <a href="#" class="category">Consejos</a>
            <h3 class="recent-title"><a href="#">Cómo cuidar la cancha después de jugar</a></h3>
            <div class="recent-meta"><span class="author">Por PlayMatch</span><span class="date">Oct 5, 2025</span></div>
          </div>
        </article>
        <!-- añade más posts si quieres -->
      </div>

    </div>
  </div>
</section>


  </main>


  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>
@endsection