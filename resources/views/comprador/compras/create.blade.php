@extends('templates.base')
@section('title', 'Comprar Boletas')
@section('header', 'Comprar Boletas para ' . $evento->nombre)

@section('content')
@include('templates.messages')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detalles del Evento</h6>
    </div>
    <div class="card-body">
        <p><strong>Descripción:</strong> {{ $evento->descripcion }}</p>
        <p><strong>Ubicación:</strong> {{ $evento->municipio }}, {{ $evento->departamento }}</p>
        <p><strong>Fecha y Hora:</strong> 
            {{ $evento->fecha_hora_inicio->format('d/m/Y H:i') }} -
            {{ $evento->fecha_hora_fin->format('d/m/Y H:i') }}
        </p>

        <hr>

        <form action="{{ route('compras.store') }}" method="POST">
            @csrf
            <input type="hidden" name="evento_id" value="{{ $evento->id }}">

            <div class="form-group">
                <label for="localidad_id">Seleccione una Localidad:</label>
                <select name="localidad_id" id="localidad_id" class="form-control" required>
                    <option value="">-- Seleccione --</option>
                    @foreach ($evento->boleteria as $boleteria)
                        <option value="{{ $boleteria->localidad->id }}">
                            {{ $boleteria->localidad->nombre_localidad }}
                            - ${{ number_format($boleteria->valor_boleta, 0, ',', '.') }}
                            (Disponibles: {{ $boleteria->cantidad_disponible }})
                        </option>
                    @endforeach
                </select>
                @error('localidad_id')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="cantidad_boletas">Cantidad de Boletas (máx. 10):</label>
                <input type="number" name="cantidad_boletas" id="cantidad_boletas" class="form-control"
                       min="1" max="10" value="{{ old('cantidad_boletas', 1) }}" required>
                @error('cantidad_boletas')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="numero_tarjeta">Número de Tarjeta (15 dígitos - prueba):</label>
                <input type="text" name="numero_tarjeta" id="numero_tarjeta" class="form-control"
                       maxlength="15" value="{{ old('numero_tarjeta') }}" required>
                @error('numero_tarjeta')
                    <span class="text-danger small">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-check"></i> Confirmar Compra
                </button>
                <a href="{{ route('comprador.eventos.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
