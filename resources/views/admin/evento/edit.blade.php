@extends('templates.base')
@section('title', 'Editar Evento')
@section('header', 'Editar Evento')

@section('content')

@include('templates.messages')

<div class="row">
    <div class="col-lg-7">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Modificar Evento #{{ $evento->id }}</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.evento.update', $evento->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Nombre --}}
                    <div class="form-group">
                        <label for="nombre">Nombre del Evento</label>
                        <input type="text"
                               name="nombre"
                               id="nombre"
                               class="form-control @error('nombre') is-invalid @enderror"
                               value="{{ old('nombre', $evento->nombre) }}"
                               required>
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Descripción --}}
                    <div class="form-group mt-3">
                        <label for="descripcion">Descripción</label>
                        <textarea name="descripcion"
                                  id="descripcion"
                                  rows="4"
                                  class="form-control @error('descripcion') is-invalid @enderror"
                                  required>{{ old('descripcion', $evento->descripcion) }}</textarea>
                        @error('descripcion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Fechas --}}
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fecha_hora_inicio">Fecha y hora de inicio</label>
                                <input type="datetime-local"
                                       name="fecha_hora_inicio"
                                       id="fecha_hora_inicio"
                                       class="form-control @error('fecha_hora_inicio') is-invalid @enderror"
                                       value="{{ old('fecha_hora_inicio', \Carbon\Carbon::parse($evento->fecha_hora_inicio)->format('Y-m-d\TH:i')) }}"
                                       required>
                                @error('fecha_hora_inicio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fecha_hora_fin">Fecha y hora de fin</label>
                                <input type="datetime-local"
                                       name="fecha_hora_fin"
                                       id="fecha_hora_fin"
                                       class="form-control @error('fecha_hora_fin') is-invalid @enderror"
                                       value="{{ old('fecha_hora_fin', \Carbon\Carbon::parse($evento->fecha_hora_fin)->format('Y-m-d\TH:i')) }}"
                                       required>
                                @error('fecha_hora_fin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Municipio y departamento --}}
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="municipio">Municipio</label>
                                <input type="text"
                                       name="municipio"
                                       id="municipio"
                                       class="form-control @error('municipio') is-invalid @enderror"
                                       value="{{ old('municipio', $evento->municipio) }}"
                                       required>
                                @error('municipio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="departamento">Departamento</label>
                                <input type="text"
                                       name="departamento"
                                       id="departamento"
                                       class="form-control @error('departamento') is-invalid @enderror"
                                       value="{{ old('departamento', $evento->departamento) }}"
                                       required>
                                @error('departamento')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Botones --}}
                    <button type="submit" class="btn btn-primary mt-4">Actualizar Evento</button>
                    <a href="{{ route('admin.evento.index') }}" class="btn btn-secondary mt-4">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
