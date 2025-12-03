@extends('layout.app')

@section('title', 'Reservar Cancha')

@section('content')

<section class="section py-5" style="background: linear-gradient(135deg, #f5f7fa, #c3cfe2); min-height: 100vh;">
  <div class="container py-4">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-6">
        <div class="card shadow-lg border-0 rounded-4 mb-5" style="background: #fff;">
          <div class="card-body p-4 p-md-5">
            <h2 class="text-center mb-4 fw-bold" style="color: #2b3a55;">Reservar Cancha</h2>
            <hr class="mb-4" style="border-top: 2px solid #eaeaea;">

            @if ($errors->any())
              <div class="alert alert-danger rounded-3">
                <ul class="mb-0">
                  @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <form action="{{ route('reservas.store') }}" method="POST">
              @csrf

              <div class="mb-3">
                <label for="id_cancha" class="form-label fw-semibold">Cancha</label>
                <select name="id_cancha" id="id_cancha" class="form-select form-select-lg rounded-3 shadow-sm" required>
                  <option value="">-- Selecciona una cancha --</option>
                  @foreach ($canchas as $c)
                    <option value="{{ $c->id_cancha }}">{{ $c->nombre }}</option>
                  @endforeach
                </select>
              </div>

              <div class="mb-3">
                <label for="fecha" class="form-label fw-semibold">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="form-control form-control-lg rounded-3 shadow-sm" value="{{ old('fecha') }}" required>
              </div>

              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="hora_inicio" class="form-label fw-semibold">Hora inicio</label>
                  <input type="time" name="hora_inicio" id="hora_inicio" class="form-control form-control-lg rounded-3 shadow-sm" value="{{ old('hora_inicio') }}" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="hora_fin" class="form-label fw-semibold">Hora fin</label>
                  <input type="time" name="hora_fin" id="hora_fin" class="form-control form-control-lg rounded-3 shadow-sm" value="{{ old('hora_fin') }}" required>
                </div>
              </div>

              <div class="d-flex justify-content-between align-items-center mt-4">
                <a href="{{ route('reservas.index') }}" class="btn btn-outline-secondary px-4 py-2 rounded-3">Volver</a>
                <button class="btn btn-primary px-4 py-2 rounded-3 shadow-sm" type="submit" style="background-color: #2b3a55; border: none;">
                  Reservar
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
  body {
    font-family: 'Poppins', sans-serif;
    overflow-x: hidden;
  }

  .form-control:focus, .form-select:focus {
    border-color: #2b3a55;
    box-shadow: 0 0 5px rgba(43, 58, 85, 0.3);
  }

  .btn-primary:hover {
    background-color: #1f2b3a !important;
  }

  .card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
  }

  @media (max-width: 576px) {
    .card-body {
      padding: 2rem 1.5rem !important;
    }
  }
</style>
@endsection