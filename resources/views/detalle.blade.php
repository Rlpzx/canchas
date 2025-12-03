@extends('layout.app')

@section('content')
    <section id="hero" class="hero section">
<div class="container py-5">

  <div class="row">
    <div class="col-lg-8">
      <h1 class="mb-3">{{ $cancha->nombre }}</h1>

      {{-- Imagen principal --}}
      <img src="{{ asset('storage/' . ltrim($cancha->imagen_principal ?? '', '/')) }}"
           alt="{{ $cancha->nombre }}"
           class="img-fluid rounded mb-3"
           onerror="this.src='{{ asset('assets/img/default-cancha.jpg') }}'">

      {{-- Galería de imágenes --}}
      @if($cancha->images->count() > 0)
        <div class="d-flex gap-2 flex-wrap mb-4">
          @foreach($cancha->images as $img)
            <img src="{{ asset('storage/' . ltrim($img->ruta ?? '', '/')) }}"
     class="img-thumbnail"
     style="width: 150px; height: 100px; object-fit: cover;">
          @endforeach
        </div>
      @endif

      <p><strong>Descripción:</strong> {{ $cancha->descripcion ?? 'Sin descripción disponible' }}</p>
      <p><strong>Tipo de cancha:</strong> {{ $cancha->tipo ?? 'No especificado' }}</p>
      <p><strong>Medidas:</strong> {{ $cancha->medidas ?? 'N/A' }}</p>
      <p><strong>Precio:</strong> ${{ number_format($cancha->precio, 0, ',', '.') }}</p>

      <a href="#" class="btn btn-success mt-3">Reservar</a>
    </div>

    <div class="col-lg-4">
      <div class="card">
        <div class="card-body">
          <h5>Información del administrador</h5>
          <p><strong>Local:</strong> {{ $cancha->administrador->nombre_local ?? 'N/A' }}</p>
          <p><strong>Dirección:</strong> {{ $cancha->administrador->direccion ?? 'N/A' }}</p>
          <p><strong>Teléfono:</strong> {{ $cancha->administrador->telefono ?? 'N/A' }}</p>
          <p><strong>Usuario:</strong> {{ $cancha->administrador->usuario->nombre ?? 'Sin usuario asignado' }}</p>
        </div>
      </div>
    </div>
  </div>

</div>
</section>
@endsection
