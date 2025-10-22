<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Ferias Colombia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">
                ColEventos
            </a>
            <a href="/" class="btn btn-outline-light btn-sm">Volver al Inicio</a>
        </div>
    </nav>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h4 class="mb-0">Crear Cuenta</h4>
                        <small>Regístrate para comprar boletas</small>
                    </div>
                    <div class="card-body p-4">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="/register">
                            @csrf
                            
                            <!-- Datos Personales -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">name *</label>
                                    <input type="text" class="form-control" id="name" name="name" 
                                           value="{{ old('name') }}" required autofocus>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="apellidos" class="form-label">Apellidos *</label>
                                    <input type="text" class="form-control" id="apellidos" name="apellidos" 
                                           value="{{ old('apellidos') }}" required>
                                </div>
                            </div>

                            <!-- Documento -->
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label for="tipo_documento" class="form-label">Tipo de Documento *</label>
                                    <select class="form-select" id="tipo_documento" name="tipo_documento" required>
                                        <option value="">Seleccionar</option>
                                        <option value="CC" {{ old('tipo_documento') == 'CC' ? 'selected' : '' }}>Cédula de Ciudadanía</option>
                                        <option value="CE" {{ old('tipo_documento') == 'CE' ? 'selected' : '' }}>Cédula de Extranjería</option>
                                        <option value="TI" {{ old('tipo_documento') == 'TI' ? 'selected' : '' }}>Tarjeta de Identidad</option>
                                        <option value="PAS" {{ old('tipo_documento') == 'PAS' ? 'selected' : '' }}>Pasaporte</option>
                                    </select>
                                </div>

                                <div class="col-md-8 mb-3">
                                    <label for="numero_documento" class="form-label">Número de Documento *</label>
                                    <input type="text" class="form-control" id="numero_documento" name="numero_documento" 
                                           value="{{ old('numero_documento') }}" required>
                                </div>
                            </div>

                            <!-- Contacto -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Correo Electrónico *</label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="{{ old('email') }}" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="telefono" class="form-label">Teléfono (Opcional)</label>
                                    <input type="tel" class="form-control" id="telefono" name="telefono" 
                                           value="{{ old('telefono') }}">
                                </div>
                            </div>

                            <!-- Contraseña -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">Contraseña *</label>
                                    <input type="password" class="form-control" id="password" name="password" 
                                           required minlength="8">
                                    <div class="form-text">Mínimo 8 caracteres</div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="password_confirmation" class="form-label">Confirmar Contraseña *</label>
                                    <input type="password" class="form-control" id="password_confirmation" 
                                           name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">Registrarse</button>
                            </div>
                        </form>

                        <div class="text-center mt-3">
                            <p class="mb-0">¿Ya tienes cuenta? 
                                <a href="/login" class="text-decoration-none">Inicia Sesión</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>