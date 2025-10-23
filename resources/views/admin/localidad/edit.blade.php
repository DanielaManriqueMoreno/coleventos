@extends('templates.base')
@section('title', 'Editar Localidad')
@section('header', 'Editar Localidad')

@section('content')

@include('templates.messages')

<div class="row">
    <div class="col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Modificar Localidad #{{ $localidad->id }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.localidad.update', $localidad->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Código de la localidad --}}
                    <div class="form-group">
                        <label for="codigo_localidad">Código de Localidad</label>
                        <input type="text"
                               name="codigo_localidad"
                               id="codigo_localidad"
                               class="form-control @error('codigo_localidad') is-invalid @enderror"
                               value="{{ old('codigo_localidad', $localidad->codigo_localidad) }}"
                               required>
                        @error('codigo_localidad')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Nombre de la localidad --}}
                    <div class="form-group mt-3">
                        <label for="nombre_localidad">Nombre de Localidad</label>
                        <input type="text"
                               name="nombre_localidad"
                               id="nombre_localidad"
                               class="form-control @error('nombre_localidad') is-invalid @enderror"
                               value="{{ old('nombre_localidad', $localidad->nombre_localidad) }}"
                               required>
                        @error('nombre_localidad')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Botones --}}
                    <button type="submit" class="btn btn-primary mt-4">Actualizar Localidad</button>
                    <a href="{{ route('admin.localidad.index') }}" class="btn btn-secondary mt-4">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
