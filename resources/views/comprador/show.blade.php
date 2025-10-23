@extends('templates.base')
@section('title', 'Dashboard')
@section('header', 'Dashboard - Panel de Control')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endsection

@section('content')

@include('templates.messages')
<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">
                🎪 Ferias Colombia
            </a>
            <div>
                @auth
                    <span class="text-white me-3">Hola, {{ Auth::user()->name }}</span>
                    <form method="POST" action="/logout" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm">Cerrar Sesión</button>
                    </form>
                @else
                    <a href="/login" class="btn btn-primary text-white">Iniciar Sesión</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="card event-card">
            <div class="card-body p-4">
                <h3 class="event-title">{{ $evento->nombre }}</h3>

                <div class="info-item">
                    <span class="info-label">Fecha:</span>
                    <span class="ms-2">{{ $evento->fecha }}</span>
                </div>

                <div class="info-item">
                    <span class="info-label">Lugar:</span>
                    <span class="ms-2">{{ $evento->lugar }}</span>
                </div>

                <div class="info-item">
                    <span class="info-label">Descripción:</span>
                    <p class="mt-2">{{ $evento->descripcion }}</p>
                </div>

                @if($evento->imagen)
                    <img src="{{ asset('storage/' . $evento->imagen) }}" alt="Imagen del evento" class="event-image">
                @endif

                <div class="mt-4">
                    <a href="{{ route('compras.create', $evento->id) }}" class="btn btn-success">Comprar Boletas</a>
                    <a href="{{ route('comprador.eventos.index') }}" class="btn btn-secondary">Volver</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>