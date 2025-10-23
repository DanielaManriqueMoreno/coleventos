@extends('templates.base')
@section('title', 'Dashboard')
@section('header', 'Dashboard - Panel de Control')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endsection

@section('content')

@include('templates.messages')
<div class="container mt-5">
    <h1 class="mb-4">Eventos Disponibles</h1>
{{-- z<a href="{{ route('compras/index') }}">Ver historial de compras</a> --}}

    @if($eventos->count())
        <div class="accordion" id="eventosAccordion">
            @foreach ($eventos as $evento)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $evento->id }}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $evento->id }}" aria-expanded="false" aria-controls="collapse{{ $evento->id }}">
                            {{ $evento->nombre }}
                        </button>
                    </h2>
                    <div id="collapse{{ $evento->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $evento->id }}" data-bs-parent="#eventosAccordion">
                        <div class="accordion-body">
                            <p><strong>Fecha:</strong> {{ $evento->fecha_hora_inicio->format('d/m/Y H:i') }} - {{ $evento->fecha_hora_fin->format('d/m/Y H:i') }}</p>
                            <p><strong>Descripción:</strong> {{ $evento->descripcion }}</p>
                            <p><strong>Localidades disponibles:</strong></p>
                            <ul>
                                @foreach ($evento->localidades as $localidad)
                                    <li>
                                        {{ $localidad->nombre_localidad }} - {{ number_format($localidad->pivot->valor_boleta, 0, ',', '.') }} COP
                                        (Disponibles: {{ $localidad->pivot->cantidad_disponible }})
                                    </li>
                                @endforeach
                            </ul>
                            <a href="{{ route('comprador.compras.create', ['evento' => $evento->id]) }}" class="btn btn-primary">Comprar</a>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Paginación -->
        <div class="mt-3">
            {{ $eventos->links() }}
        </div>
    @else
        <p>No hay eventos disponibles.</p>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
