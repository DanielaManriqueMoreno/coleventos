<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Evento - Ferias Colombia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .event-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            margin-top: 2rem;
        }
        .event-title {
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }
        .event-image {
            border-radius: 8px;
            margin: 1rem 0;
            max-height: 300px;
            object-fit: cover;
            width: 100%;
        }
        .info-item {
            margin-bottom: 1rem;
            padding: 0.5rem 0;
        }
        .info-label {
            font-weight: 600;
            color: #2c3e50;
        }
        .btn-success {
            background-color: #28a745;
            border: none;
            padding: 10px 25px;
            font-weight: 600;
        }
        .btn-secondary {
            background-color: #6c757d;
            border: none;
            padding: 10px 25px;
            font-weight: 600;
        }
    </style>
</head>
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