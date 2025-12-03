@extends('layouts.admin') {{-- tu layout de administrador --}}

@section('content')
<main class="main">

  <!-- Page Title -->
  <div class="page-title light-background">
    <div class="container d-lg-flex justify-content-between align-items-center">
      <h1 class="mb-2 mb-lg-0">Gestión de Canchas</h1>
      <nav class="breadcrumbs">
        <ol>
          <li><a href="{{ route('admin.dashboard') }}">Panel</a></li>
          <li class="current">Canchas</li>
        </ol>
      </nav>
    </div>
  </div><!-- End Page Title -->

  <!-- Canchas Section -->
  <section id="properties" class="properties section">
    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <!-- Botón Crear Nueva Cancha -->
      <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('crear_cancha') }}" class="btn btn-success">
          <i class="bi bi-plus-circle"></i> Nueva Cancha
        </a>
      </div>

      <!-- Grid view -->
      <div class="properties-container">
        <div class="properties-masonry view-masonry active" data-aos="fade-up" data-aos-delay="250">
          <div class="row g-4">

            @forelse($canchas as $cancha)
              <div class="col-lg-4 col-md-6">
                <div class="property-item border shadow-sm p-2 rounded">
                  <div class="property-image-wrapper position-relative">
                    <img src="{{ asset('storage/' . $cancha->imagen_principal) }}"
                         alt="{{ $cancha->nombre }}"
                         class="img-fluid rounded"
                         onerror="this.src='{{ asset('assets/img/real-estate/property-exterior-2.webp') }}'">

                    <!-- Acciones del admin -->
                    <div class="property-actions position-absolute top-0 end-0 m-2">
                      <a href="{{ route('canchaA.edit', $cancha->id_cancha) }}" class="btn btn-sm btn-primary me-1" title="Editar">
                        <i class="bi bi-pencil"></i>
                      </a>
                      <form action="{{ route('canchaA.destroy', $cancha->id_cancha) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" title="Eliminar"
                          onclick="return confirm('¿Seguro que deseas eliminar esta cancha?')">
                          <i class="bi bi-trash"></i>
                        </button>
                      </form>
                    </div>
                  </div>

                  <div class="property-details mt-3">
                    <h4 class="property-title">{{ $cancha->nombre }}</h4>
                    <p class="property-address text-muted mb-1"><i class="bi bi-geo-alt"></i> {{ $cancha->ubicacion }}</p>
                    <p class="mb-0"><strong>Tipo:</strong> {{ ucfirst($cancha->tipo) }}</p>
                    <p class="mb-0"><strong>Precio:</strong> ${{ number_format($cancha->precio,0,',','.') }}/hora</p>
                    <p class="mb-0"><strong>Capacidad:</strong> {{ $cancha->capacidad ?? '—' }} pers.</p>
                  </div>
                </div>
              </div>
            @empty
              <div class="col-12">
                <div class="alert alert-info">No hay canchas registradas.</div>
              </div>
            @endforelse

          </div>
        </div>
      </div>

      <!-- Paginación -->
      <div class="mt-4">
        {{ $canchas->links() }}
      </div>

    </div>
  </section>

</main>
@endsection
