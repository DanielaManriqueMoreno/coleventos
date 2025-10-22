<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos - Ferias de Colombia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .event-card {
            transition: transform 0.3s;
            margin-bottom: 20px;
            border: none;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.2);
        }
        .btn-comprar {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            border: none;
        }
        .btn-login {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            border: none;
        }
    </style>
</head>
<body>
    <!-- Navbar Simple -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">
                ColEventos
            </a>
            <div>
                <a href="/login" class="btn btn-login text-white">Iniciar Sesión</a>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <div class="bg-primary text-white py-4">
        <div class="container text-center">
            <h1 class="mb-3">Eventos Disponibles</h1>
            <p class="lead mb-0">Descubre todas las ferias y eventos en Colombia</p>
        </div>
    </div>

    <!-- Lista de Eventos -->
    <div class="container py-5">
        <div class="row">
            @if(isset($eventos) && $eventos->count() > 0)
                @foreach($eventos as $evento)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card event-card h-100">
                            <div class="card-body">
                                <h5 class="card-title text-primary">{{ $evento->nombre }}</h5>
                                <p class="card-text">{{ $evento->descripcion }}</p>
                                
                                <div class="mb-3">
                                    <strong>📅 Fecha:</strong><br>
                                    <small class="text-muted">
                                        {{ \Carbon\Carbon::parse($evento->fecha_hora_inicio)->format('d M Y - h:i A') }}
                                    </small>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>📍 Lugar:</strong><br>
                                    <small class="text-muted">
                                        {{ $evento->municipio }}, {{ $evento->departamento }}
                                    </small>
                                </div>
                            </div>
                            <div class="card-footer bg-white">
                                <div class="d-grid gap-2">
                                    <a href="/login" class="btn btn-comprar text-white">Comprar Boletas</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center py-5">
                    <div class="alert alert-info">
                        <h4>📅 No hay eventos disponibles</h4>
                        <p class="mb-3">Actualmente no tenemos eventos programados.</p>
                        <a href="/login" class="btn btn-primary">Iniciar Sesión</a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0">&copy; 2025 ColEventos. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>