@extends('layout.app')

@section('title','canchas')

@section('content')

<main class="main">

  <!-- Page Title -->
  <div class="page-title light-background">
    <div class="container d-lg-flex justify-content-between align-items-center">
      <h1 class="mb-2 mb-lg-0">Canchas</h1>
      <nav class="breadcrumbs">
        <ol>
          <li><a href="{{ url('/') }}">Inicio</a></li>
          <li class="current">Canchas</li>
        </ol>
      </nav>
    </div>
  </div><!-- End Page Title -->

  <!-- Canchas Section -->
  <section id="properties" class="properties section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <!-- Search bar (GET simple, action directo a /canchas) -->
      <div class="search-bar mb-5" data-aos="fade-up" data-aos-delay="150">
        <form action="/canchas" method="GET">
          <div class="row justify-content-center">
            <div class="col-lg-10">
              <div class="search-wrapper">
                <div class="row g-3">
                  <div class="col-lg-3 col-md-6">
                    <div class="search-field">
                      <label>Ubicación</label>
                      <input type="text" name="ubicacion" class="form-control" placeholder="Ciudad o barrio" value="{{ request('ubicacion') }}">
                    </div>
                  </div>

               

                  <div class="col-lg-2 col-md-6">
                    <div class="search-field">
                      <label>Precio / hora</label>
                      <select name="precio" class="form-select">
                        <option value="">Cualquiera</option>
                        <option value="0-20" {{ request('precio')=='0-50000' ? 'selected':'' }}>$0 - $20</option>
                        <option value="20-50" {{ request('precio')=='50000-10000' ? 'selected':'' }}>$20 - $50</option>
                        <option value="50-9999" {{ request('precio')=='10000-20000' ? 'selected':'' }}>$50+</option>
                      </select>
                    </div>
                  </div>

        
                  <div class="col-lg-2 col-md-12">
                    <div class="search-field">
                      <label>&nbsp;</label>
                      <button class="btn btn-primary w-100 search-btn" type="submit">
                        <i class="bi bi-search"></i> Buscar
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>

      <!-- Results header -->
      <div class="results-header mb-4" data-aos="fade-up" data-aos-delay="200">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="results-info">
              {{-- si usas paginación dinámica, $canchas->total(); si pruebas estaticamente muestra un número fijo --}}
              <h5>{{ isset($canchas) ? $canchas->total().' canchas encontradas' : '— canchas encontradas' }}</h5>
              <p class="text-muted">Mostrando disponibilidad según filtros</p>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="results-controls">
              <div class="d-flex gap-3 align-items-center justify-content-lg-end">
                <div class="sort-dropdown">
                  <select class="form-select form-select-sm" onchange="if(this.value) location.search = new URLSearchParams(Object.fromEntries(new FormData(document.querySelector('.search-bar form')))).toString() + '&orden='+this.value;">
                    <option value="">Ordenar</option>
                    <option value="precio_asc" {{ request('orden')=='precio_asc' ? 'selected':'' }}>Precio: menor a mayor</option>
                    <option value="precio_desc" {{ request('orden')=='precio_desc' ? 'selected':'' }}>Precio: mayor a menor</option>
                    <option value="nuevo" {{ request('orden')=='nuevo' ? 'selected':'' }}>Más recientes</option>
                  </select>
                </div>
                <div class="view-toggle">
                  <button class="view-btn active" data-view="masonry"><i class="bi bi-grid"></i></button>
                  <button class="view-btn" data-view="rows"><i class="bi bi-view-stacked"></i></button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Grid view: tarjetas de cancha -->
      <div class="properties-container">
        <div class="properties-masonry view-masonry active" data-aos="fade-up" data-aos-delay="250">
          <div class="row g-4">

            {{-- Si estás probando sin BD, puedes usar un array estático arriba de la vista.
                 Si usas datos reales, $canchas debe venir del controlador. --}}
            @php
              if(!isset($canchas)) {
                $canchas = collect([
                  (object)[
                    'id'=>1,'nombre'=>'Cancha Central','tipo'=>'Fútbol 5','precio_hora'=>30,
                    'ubicacion'=>'Montería','capacidad'=>10,'duracion'=>'1h',
                    'imagen'=>'assets/img/real-estate/property-exterior-2.webp','encargado'=>'PlayMatch','telefono'=>'+573140000000'
                  ],
                  (object)[
                    'id'=>2,'nombre'=>'Polideportivo Norte','tipo'=>'Fútbol 7','precio_hora'=>50,
                    'ubicacion'=>'Montería','capacidad'=>14,'duracion'=>'1h',
                    'imagen'=>'assets/img/real-estate/property-interior-1.webp','encargado'=>'Admin Norte','telefono'=>'+573140000001'
                  ],
                  (object)[
                    'id'=>3,'nombre'=>'Arena Indoor','tipo'=>'Tenis','precio_hora'=>20,
                    'ubicacion'=>'Montería','capacidad'=>4,'duracion'=>'1h',
                    'imagen'=>'assets/img/real-estate/property-exterior-5.webp','encargado'=>'Arena Team','telefono'=>'+573140000002'
                  ],
                ]);
              }
            @endphp

            @forelse($canchas as $cancha)
              <div class="col-lg-4 col-md-6">
                <div class="property-item">
                  <a href="{{ route('detalle.cancha', ['id' => $cancha->id_cancha]) }}" class="property-link">
                    <div class="property-image-wrapper">
                      <img src="{{ asset('storage/' . ltrim($cancha->imagen_principal, '/')) }}"
     alt="{{ $cancha->nombre }}"
     class="img-fluid"
     onerror="this.src='{{ asset('assets/img/cancha3.jpeg') }}'">

                      <div class="property-actions">
                        <a href="{{ url('/detalle.cancha/'.($cancha->id ?? '') ) }}" class="action-btn gallery-btn" title="Ver detalles">
                          <i class="bi bi-images"></i>
                        </a>
                      </div>
                    </div>
                  </a>

                  <div class="property-details">
                    <a href="{{ url('/canchas/'.($cancha->id ?? '') ) }}" class="property-link">
                      <div class="property-header d-flex justify-content-between align-items-start">
                        <div>
                          <div class="property-type text-muted">{{ ucfirst($cancha->tipo ?? 'Cancha') }}</div>
                          <h4 class="property-title">{{ $cancha->nombre }}</h4>
                        </div>
                        <div class="text-end">
                          <div class="property-price">${{ number_format($cancha->precio ?? 0,0,',','.') }} <small>/hora</small></div>
                        </div>
                      </div>

                      <p class="property-address">
                        <i class="bi bi-geo-alt"></i>
                        {{ $cancha->ubicacion ?? 'Sin ubicación' }}
                      </p>

                      <div class="property-specs d-flex gap-3">
                        <div class="spec-item"><i class="bi bi-clock"></i> {{ $cancha->duracion ?? '1h' }}</div>
                        <div class="spec-item"><i class="bi bi-people"></i> {{ $cancha->capacidad ?? '—' }} pers.</div>
                      </div>
                    </a>

                    <div class="property-agent-info d-flex align-items-center justify-content-between mt-3">
                      <div class="d-flex align-items-center">
                        <div class="agent-avatar me-2">
                          <img src="{{ asset($cancha->avatar ?? 'assets/img/real-estate/agent-2.webp') }}" alt="Encargado" class="rounded-circle" style="width:44px;height:44px;object-fit:cover;">
                        </div>
                        <div class="agent-details">
                          <strong>    {{ $cancha->administrador->usuario->nombre ?? 'Administrador sin usuario' }}</strong>
                          <span class="d-block small text-muted">{{ $cancha->administrador->telefono ?? '' }}</span>
                        </div>
                      </div>
                      <div class="agent-contact">
                        <a href="tel:{{ $cancha->administrador->telefono ?? '' }}" class="contact-btn btn btn-outline-primary btn-sm">
                          <i class="bi bi-telephone"></i>
                        </a>
                        <a href="{{ url('/reservas') }}?cancha_id={{ $cancha->id ?? '' }}" class="btn btn-primary btn-sm ms-2">Reservar</a>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            @empty
              <div class="col-12">
                <div class="alert alert-info">No se encontraron canchas con esos filtros.</div>
              </div>
            @endforelse

          </div>
        </div>

        <!-- Rows view (opcional) -->
        <div class="properties-rows view-rows" style="display:none;">
          <div class="row g-4">
            @foreach($canchas as $cancha)
              <div class="col-12">
                <div class="property-row-item">
                  <a href="{{ url('/canchas/'.($cancha->id ?? '') ) }}" class="property-row-link">
                    <div class="row align-items-center">
                      <div class="col-lg-4">
                        <div class="property-image-wrapper">
                  <img src="{{ asset('storage/canchas/' . $cancha->imagen) }}" alt="{{ $cancha->nombre }}" class="img-fluid">






                        </div>
                      </div>
                      <div class="col-lg-8">
                        <div class="property-row-content">
                          <div class="property-info">
                            <div class="property-header d-flex justify-content-between">
                              <h4 class="property-title">{{ $cancha->nombre }}</h4>
                              <div class="property-price">${{ number_format($cancha->precio ?? 0,0,',','.') }} /hora</div>
                            </div>
                            <p class="property-address"><i class="bi bi-geo-alt"></i> {{ $cancha->ubicacion }}</p>
                            <div class="property-specs"><span><i class="bi bi-people"></i> {{ $cancha->capacidad ?? '—' }} pers.</span></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
            @endforeach
          </div>
        </div>

      </div>

      {{-- Paginación (si usas páginas dinámicas, $canchas->links()) --}}
      <nav class="pagination-wrapper mt-5" data-aos="fade-up" data-aos-delay="350">
        <div class="row justify-content-between align-items-center">
          <div class="col-lg-6">
            <div class="pagination-info">
              @if(isset($canchas) && $canchas instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <p>Mostrando <strong>{{ $canchas->firstItem() ?? 0 }}-{{ $canchas->lastItem() ?? 0 }}</strong> de <strong>{{ $canchas->total() }}</strong> canchas</p>
              @else
                <p>Mostrando <strong>1-{{ $canchas->count() }}</strong> de <strong>{{ $canchas->count() }}</strong> canchas</p>
              @endif
            </div>
          </div>
          <div class="col-lg-6">
            <div class="d-flex justify-content-lg-end">
              @if(isset($canchas) && $canchas instanceof \Illuminate\Pagination\LengthAwarePaginator)
                {{ $canchas->withQueryString()->links() }}
              @else
                <ul class="pagination">
                  <li class="page-item active"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                </ul>
              @endif
            </div>
          </div>
        </div>
      </nav>

    </div>
  </section><!-- /Canchas Section -->

</main>


@endsection

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
