@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4" Eventos Disponibles</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="row">
        @foreach($eventos as $evento)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ $evento->nombre }}</h5>
                        <p class="text-muted mb-2">{{ $evento->municipio }}, {{ $evento->departamento }}</p>
                        <p><strong>📅</strong> {{ \Carbon\Carbon::parse($evento->fecha_hora_inicio)->format('d M Y - h:i A') }}</p>
                    </div>
                    <div class="card-footer bg-white text-center">
                        <a href="{{ route('comprador.eventos.show', $evento->id) }}" class="btn btn-outline-primary btn-sm me-2">Ver Info</a>
                        <a href="{{ route('comprador.eventos.comprar', $evento->id) }}" class="btn btn-success btn-sm">Comprar</a>
                    </div>
                </div>
            </div>
        @endforeach

        @if($eventos->isEmpty())
            <div class="col-12 text-center">
                <div class="alert alert-info">No hay eventos disponibles por el momento.</div>
            </div>
        @endif
    </div>
</div>
@endsection
