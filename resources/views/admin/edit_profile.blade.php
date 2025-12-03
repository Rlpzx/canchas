@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">✏️ Editar Perfil del Administrador</h2>

    <form action="{{ route('admin.profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nombre del Local</label>
            <input type="text" name="nombre_local" value="{{ old('nombre_local', $admin->nombre_local) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Dirección</label>
            <input type="text" name="direccion" value="{{ old('direccion', $admin->direccion) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Teléfono</label>
            <input type="text" name="telefono" value="{{ old('telefono', $admin->telefono) }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Guardar Cambios</button>
        <a href="{{ route('admin.profile') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
