@extends('layouts.admin')

@section('content')
<div class="panel">
    <h1 style="text-align:center;">📅 Gestión de Reservas</h1>

    @if (session('success'))
        <div style="background:#d4edda;color:#155724;padding:10px;border-radius:6px;margin-bottom:10px;">
            {{ session('success') }}
        </div>
    @endif

    <table style="width:100%;border-collapse:collapse;margin-top:20px;">
        <thead style="background:#00b894;color:white;">
            <tr>
                <th style="padding:8px;">ID</th>
                <th>Usuario</th>
                <th>Cancha</th>
                <th>Fecha</th>
                <th>Hora de inicio</th>
                <th>Hora de fin</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reservas as $reserva)
                <tr style="border-bottom:1px solid #ddd;text-align:center;">
                    <td>{{ $reserva->id_usuario }}</td>
                    <td>{{ $reserva->usuario->nombre ?? 'N/A' }}</td>
                    <td>{{ $reserva->cancha->nombre ?? 'N/A' }}</td>
                    <td>{{ $reserva->fecha }}</td>
                    <td>{{ $reserva->hora_inicio }}</td>
                     <td>{{ $reserva->hora_fin }}</td>
                    <td>{{ ucfirst($reserva->estado ?? '') }}</td>
                    <td>
                        <form action="{{ route('admin.reservas.destroy', $reserva->id_reserva) }}" method="POST" onsubmit="return confirm('¿Eliminar esta reserva?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-logout" style="padding:6px 10px;">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" style="text-align:center;padding:20px;">No hay reservas registradas.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top:20px;">
        {{ $reservas->links() }}
    </div>
</div>
@endsection
