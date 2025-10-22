@extends('templates.base')
@section('title', 'Editar Mi Perfil')
@section('header', 'Editar Mi Perfil')

@section('content')

@include('templates.messages')

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Mis Datos Personales</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nombres</label>
                                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                                </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="apellidos">Apellidos</label>
                                <input type="text" name="apellidos" id="apellidos" class="form-control @error('apellidos') is-invalid @enderror" value="{{ old('apellidos', $user->apellidos) }}" required>
                                </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                        </div>

                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tipo_documento">Tipo de Documento</label>
                            <select id="tipo_documento" class="form-control" disabled>
                                <option value="CC" {{ $user->tipo_documento == 'CC' ? 'selected' : '' }}>Cédula de Ciudadanía</option>
                                <option value="CE" {{ $user->tipo_documento == 'CE' ? 'selected' : '' }}>Cédula de Extranjería</option>
                                <option value="PP" {{ $user->tipo_documento == 'PP' ? 'selected' : '' }}>Pasaporte</option>
                            </select>
                            <small class="form-text text-muted">El tipo de documento no se puede modificar.</small>
                        </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="numero_documento">Número de Documento</label>
                                <input type="text" id="numero_documento" class="form-control" value="{{ $user->numero_documento }}" disabled>
                                <small class="form-text text-muted">El número de documento no se puede modificar.</small>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Teléfono (Opcional)</label>
                        <input type="text" name="telefono" id="telefono" class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono', $user->telefono) }}">
                        </div>

                    <button type="submit" class="btn btn-primary">Actualizar Perfil</button>
                    
                    <hr>

                    <h6 class="text-muted">Seguridad</h6>
                    <a href="{{ route('profile.password.edit') }}" class="btn btn-outline-danger">
                        Ir a Cambiar Contraseña
                    </a>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection