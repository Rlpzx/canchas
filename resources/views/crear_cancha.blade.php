@extends('layouts.admin') {{-- tu layout de administrador --}}

@section('content')
<main class="main">
<!-- ======= Formulario de creación de cancha ======= -->
<div class="container bg-white p-5 rounded shadow">
    <h2 class="mb-4 text-center fw-bold text-success">Registrar Nueva Cancha</h2>

    <form action="{{ route('canchas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Ubicación</label>
                <input type="text" name="ubicacion" class="form-control" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Tipo</label>
                <input type="text" name="tipo" class="form-control" placeholder="Ej: Fútbol 5, Fútbol 7, Voleibol">
            </div>

            <div class="col-md-6 mb-3">
                <label>Precio por hora</label>
                <input type="number" step="0.01" name="precio" class="form-control" required>
            </div>
              <div class="col-md-6 mb-3">
                <label>Capacidad</label>
                <input type="number" step="0.01" name="capacidad" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="descripcion" class="form-control" rows="3" placeholder="Describe brevemente la cancha"></textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Horario de apertura</label>
                <input type="time" name="horario_apertura" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Horario de cierre</label>
                <input type="time" name="horario_cierre" class="form-control">
            </div>
        </div>

        <div class="mb-3">
            <label>Servicios adicionales</label>
            <textarea name="servicios" class="form-control" rows="2" placeholder="Ej: parqueadero, iluminación, camerinos, cafetería..."></textarea>
        </div>

        <div class="mb-3">
            <label>Imagen principal</label>
            <input type="file" name="imagen_principal" class="form-control" accept="image/*">
        </div>

        <div class="mb-3">
            <label>Imágenes adicionales (puedes seleccionar varias)</label>
            <input type="file" name="imagenes[]" class="form-control" accept="image/*" multiple>
        </div>

        <!-- El id_admin se envía oculto -->
        <input type="hidden" name="id_admin" value="{{ auth()->user()->id }}">

        <div class="text-center">
            <button type="submit" class="btn btn-success px-5">Guardar Cancha</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</main>
@endsection