@extends('templates.base')
@section('title', 'Dashboard')
@section('header', 'Dashboard - Panel de Control')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endsection

@section('content')

@include('templates.messages')
<body>
    <a href="{{ url()->previous() }}" class="btn btn-secondary">
    ← Volver
</a>

<div class="container mt-5">
    <h2>Comprar boletas para: {{ $evento->nombre }}</h2>
    <p>{{ $evento->descripcion }}</p>
    <p><strong>Fecha inicio:</strong> {{ $evento->fecha_hora_inicio }}</p>
    <p><strong>Fecha fin:</strong> {{ $evento->fecha_hora_fin }}</p>
    <p><strong>Ubicación:</strong> {{ $evento->municipio }}, {{ $evento->departamento }}</p>

    @if(session('warning'))
        <p style="color:red">{{ session('warning') }}</p>
    @endif

    <form action="{{ route('compras.store') }}" method="POST">
        @csrf
        <input type="hidden" name="evento_id" value="{{ $evento->id }}">

        <label for="localidad_id">Selecciona localidad:</label>
        <select name="localidad_id" required>
            <option value="">-- Seleccione --</option>
            @foreach($localidades as $loc)
                <option value="{{ $loc['id'] }}">
                    {{ $loc['nombre_localidad'] }} - ${{ $loc['valor_boleta'] }} (Disponibles: {{ $loc['cantidad_disponible'] }})
                </option>
            @endforeach
        </select>
        @error('localidad_id')
            <p style="color:red">{{ $message }}</p>
        @enderror

        <br><br>
        <label for="cantidad_boletas">Cantidad de boletas:</label>
        <input type="number" name="cantidad_boletas" min="1" max="10" value="{{ old('cantidad_boletas',1) }}">
        @error('cantidad_boletas')
            <p style="color:red">{{ $message }}</p>
        @enderror

        <br><br>
        <label for="numero_tarjeta">Número de tarjeta:</label>
        <input type="text" name="numero_tarjeta" maxlength="15" value="{{ old('numero_tarjeta') }}">
        @error('numero_tarjeta')
            <p style="color:red">{{ $message }}</p>
        @enderror

        <br><br>
        <button type="submit">Comprar</button>
    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
