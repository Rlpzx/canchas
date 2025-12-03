@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">👤 Perfil del Administrador</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card p-4 shadow-sm">
        <p><strong>Usuario:</strong> {{ auth()->user()->nombre ?? auth()->user()->name ?? 'Administrador' }}</p>
        <p><strong>Correo:</strong> {{ auth()->user()->correo ?? auth()->user()->email ?? '' }}</p>
        <p><strong>Nombre del Local:</strong> {{ $admin->nombre_local ?? '—' }}</p>
        <p><strong>Dirección:</strong> {{ $admin->direccion ?? '—' }}</p>
        <p><strong>Teléfono:</strong> {{ $admin->telefono ?? '—' }}</p>

        <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary mt-3">Editar Perfil</a>
    </div>
</div>
@endsection
