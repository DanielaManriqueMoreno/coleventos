@extends('templates.base')
@section('title', 'Cambiar Contraseña')
@section('header', 'Cambiar Contraseña')

@section('content')

@include('templates.messages')

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Actualizar Contraseña</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('profile.password.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="current_password">Contraseña Actual</label>
                        <input type="password" name="current_password" id="current_password" class="form-control @error('current_password') is-invalid @enderror" required>
                        @error('current_password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <hr>

                    <div class="form-group">
                        <label for="password">Nueva Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirmar Nueva Contraseña</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Actualizar Contraseña</button>
                    <a href="{{ route('profile.edit') }}" class="btn btn-secondary">Volver al Perfil</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection