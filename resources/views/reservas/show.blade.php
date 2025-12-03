@extends('layout.app')

@section('title','Detalle reserva')

@section('content')
    <section id="hero" class="hero section">
<div class="container">
    <h1>Reserva #{{ $reserva->id }}</h1>

    <p><strong>Cancha:</strong> {{ $reserva->cancha->nombre ?? '—' }}</p>
   <p><strong>Usuario:</strong> {{ optional($reserva->user)->name ?? optional($reserva->user)->correo ?? '—' }}</p>

    <p><strong>Fecha / Hora:</strong> {{ \Carbon\Carbon::parse($reserva->fecha)->format('d/m/Y') }}
        - {{ \Carbon\Carbon::createFromFormat('H:i:s', $reserva->hora_inicio)->format('H:i') ?? $reserva->hora_inicio }}
         a {{ \Carbon\Carbon::createFromFormat('H:i:s', $reserva->hora_fin)->format('H:i') ?? $reserva->hora_fin }}</p>
    <p><strong>Precio:</strong> {{ $reserva->precio ? '$'.number_format($reserva->precio,2) : '—' }}</p>
    <p><strong>Estado:</strong> {{ ucfirst($reserva->estado) }}</p>

    <a href="{{ route('reservas.index') }}" class="btn btn-secondary">Volver</a>
</div>
</section>
@endsection
