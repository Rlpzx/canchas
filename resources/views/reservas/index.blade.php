@extends('layout.app')

@section('title','Mis reservas')

@section('content')
<section class="section py-5" style="background: linear-gradient(135deg, #f5f7fa, #eef3fb); min-height: 100vh;">
  <div class="container py-4">
    <div class="row justify-content-center">
      <div class="col-12 col-lg-10">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h1 class="h3 mb-0 fw-bold" style="color:#203048;">Mis reservas</h1>
          <a href="{{ route('reservas.create') }}" class="btn btn-primary btn-lg px-4" style="background-color:#2b3a55; border:none;">
            Reservar cancha
          </a>
        </div>

        @if(session('success'))
          <div class="alert alert-success rounded-3">
            {{ session('success') }}
          </div>
        @endif

        <div class="card shadow-sm border-0 rounded-4">
          <div class="card-body p-0">
            @if($reservas->count())
              <div class="table-responsive">
                <table class="table table-hover table-striped align-middle mb-0">
                  <thead class="bg-white">
                    <tr>
                      <th class="ps-4">Cancha</th>
                      <th>Fecha</th>
                      <th>Hora</th>
                      <th>Precio</th>
                      <th>Estado</th>
                      <th class="text-end pe-4">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($reservas as $r)
                      <tr>
                        <td class="ps-4 fw-semibold">{{ $r->cancha->nombre ?? '—' }}</td>
                        <td>{{ \Carbon\Carbon::parse($r->fecha)->format('d/m/Y') }}</td>
                        <td>
                          {{ \Carbon\Carbon::createFromFormat('H:i:s', $r->hora_inicio)->format('H:i') ?? $r->hora_inicio }}
                          - 
                          {{ \Carbon\Carbon::createFromFormat('H:i:s', $r->hora_fin)->format('H:i') ?? $r->hora_fin }}
                        </td>
                        <td>{{ $r->precio ? '$'.number_format($r->precio,2) : '—' }}</td>
                        <td>
                          @php
                            $estado = strtolower($r->estado ?? '');
                            $badge = 'secondary';
                            if($estado === 'confirmada' || $estado === 'confirmado' || $estado === 'activa') $badge = 'success';
                            if($estado === 'pendiente') $badge = 'warning';
                            if($estado === 'cancelada' || $estado === 'cancelado') $badge = 'danger';
                          @endphp
                          <span class="badge bg-{{ $badge }} text-capitalize">{{ ucfirst($r->estado ?? '—') }}</span>
                        </td>
                        <td class="text-end pe-4">
                          <a href="{{ route('reservas.show', $r->id_reserva) }}" class="btn btn-sm btn-outline-primary me-2">Ver</a>

                          <form action="{{ route('reservas.destroy', $r->id_reserva) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Cancelar reserva?')">Cancelar</button>
                          </form>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>

              <div class="p-4 d-flex justify-content-center">
                {{ $reservas->links() }}
              </div>

            @else
              <div class="p-5 text-center">
                <!-- Icono SVG simple -->
                <div class="mb-4">
                  <svg xmlns="http://www.w3.org/2000/svg" width="72" height="72" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color:#9aa7bf;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10.5a9 9 0 1118 0v6.75a.75.75 0 01-.75.75H3.75A.75.75 0 013 17.25V10.5z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.25 10.5v-1.5a3.75 3.75 0 017.5 0v1.5"/>
                  </svg>
                </div>

                <h3 class="mb-2 fw-semibold" style="color:#24344a;">Aún no tienes reservas</h3>
                <p class="mb-4 text-muted">Reserva una cancha y aquí aparecerán todas tus reservas activas y pasadas.</p>
                <a href="{{ route('reservas.create') }}" class="btn btn-primary px-4 py-2" style="background-color:#2b3a55; border:none;">
                  Reservar ahora
                </a>
              </div>
            @endif
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<style>
  body {
    font-family: 'Poppins', sans-serif;
  }

  .table thead th {
    border-bottom: 0;
    color: #55627b;
    font-weight: 600;
    background: transparent;
  }

  .table > :not(:first-child) > :last-child > td {
    border-top: 1px solid #f1f3f6;
  }

  .table tbody tr:hover {
    background: rgba(43,58,85,0.03);
  }

  .badge {
    font-weight: 600;
    padding: .45em .6em;
    border-radius: .5rem;
  }

  /* Paginación centrada y limpia (Bootstrap default paginación puede variar por versión) */
  .pagination {
    margin: 0;
  }

  /* Ajustes responsive */
  @media (max-width: 768px) {
    .table thead {
      display: none;
    }
    .table, .table tbody, .table tr, .table td {
      display: block;
      width: 100%;
    }
    .table tr {
      margin-bottom: 1rem;
      border: 1px solid #eef3fb;
      border-radius: .5rem;
      padding: .75rem;
    }
    .table td {
      padding: .5rem .75rem;
    }
    .table td::before {
      content: attr(data-label);
      display: block;
      font-weight: 600;
      color: #6c7a8b;
    }
    /* Para mostrar los labels en cada celda, ponte los data-label en caso de necesitar */
  }
</style>

@endsection
