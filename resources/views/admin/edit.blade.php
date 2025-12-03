@extends('layouts.admin')

@section('title', 'Editar Cancha')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-center">Editar Cancha</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('canchaA.update', ['id' => $cancha->id_cancha]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre de la Cancha</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre', $cancha->nombre) }}" required>
        </div>

        <div class="mb-3">
            <label for="ubicacion" class="form-label">Ubicación</label>
            <input type="text" name="ubicacion" id="ubicacion" class="form-control" value="{{ old('ubicacion', $cancha->ubicacion) }}" required>
        </div>

        <div class="mb-3">
            <label for="precio" class="form-label">Precio por hora</label>
            <input type="number" name="precio" id="precio" class="form-control" value="{{ old('precio', $cancha->precio) }}" required>
        </div>

        <div class="mb-3">
            <label for="disponibilidad" class="form-label">Disponibilidad</label>
            <select name="disponibilidad" id="disponibilidad" class="form-select" required>
                <option value="Disponible" {{ $cancha->disponibilidad == 'Disponible' ? 'selected' : '' }}>Disponible</option>
                <option value="No disponible" {{ $cancha->disponibilidad == 'No disponible' ? 'selected' : '' }}>No disponible</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" name="imagen" id="imagen" class="form-control">
            @if ($cancha->imagen)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $cancha->imagen) }}" alt="Imagen actual" width="150" class="rounded shadow-sm">
                </div>
            @endif
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary px-4">Actualizar</button>
            <a href="{{ route('canchaA') }}" class="btn btn-secondary ms-2 px-4">Cancelar</a>
        </div>
    </form>
</div>
@endsection
