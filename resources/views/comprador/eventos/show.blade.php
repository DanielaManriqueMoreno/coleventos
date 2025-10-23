@extends('templates.base')
@section('title', 'Detalle del Evento')
@section('header', 'Detalle del Evento')

@section('content')
@include('templates.messages')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">{{ $evento->nombre }}</h5>
    </div>
    <div class="card-body">
        <p><strong>Descripción:</strong> {{ $evento->descripcion }}</p>
        <p><strong>Ubicación:</strong> {{ $evento->municipio }}, {{ $evento->departamento }}</p>
        <p><strong>Fecha:</strong> 
            {{ \Carbon\Carbon::parse($evento->fecha_hora_inicio)->format('d/m/Y H:i') }} - 
            {{ \Carbon\Carbon::parse($evento->fecha_hora_fin)->format('d/m/Y H:i') }}
        </p>

        @if ($evento->artistas->isNotEmpty())
            <p><strong>Artistas:</strong> {{ $evento->artistas->pluck('nombres')->join(', ') }}</p>
        @endif

        <hr>
        <h5>🎟️ Localidades Disponibles</h5>

        @if ($evento->boleteria->isNotEmpty())
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Localidad</th>
                            <th>Valor</th>
                            <th>Disponibles</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($evento->boleteria as $boleteria)
                            <tr>
                                <td>{{ $boleteria->localidad->nombre_localidad }}</td>
                                <td>${{ number_format($boleteria->valor_boleta, 0, ',', '.') }}</td>
                                <td>{{ $boleteria->cantidad_disponible }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('compras.create', $evento->id) }}" class="btn btn-success">
                    <i class="fas fa-ticket-alt"></i> Comprar Boletas
                </a>
                <a href="{{ route('comprador.eventos.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Volver
                </a>
            </div>
        @else
            <p class="text-muted">No hay localidades disponibles para este evento.</p>
        @endif
    </div>
</div>
@endsection
