@extends('templates.base')
@section('title', 'Crear Evento')
@section('header', 'Crear Evento')
@section('content')
    @include('templates.messages')
    <div class="row">
        <div class="col-lg-12 mb-4">
            <form action="{{ route('evento.store') }}" method="post">
                @csrf
                <div class="row form-group">
                    <div class="col-lg-6 mb-4">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" 
                                name="nombre" required value="{{ old('nombre') }}">
                    </div>
                    <div class="col-lg-6 mb-4">
                        <label for="descripcion">Descripción</label>
                        <input type="text" class="form-control" id="descripcion" 
                                name="descripcion" required value="{{ old('descripcion') }}">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-lg-3 mb-4">
                        <label for="fecha_inicio">Hora inicio (HH:mm)</label>
                        <input type="datetime-local" class="form-control" name="fecha_inicio" id="fecha_inicio" required value="{{ old('fecha_inicio') }}">
                    </div>
                    <div class="col-lg-3 mb-4">
                        <label for="fecha_fin">Hora fin (HH:mm)</label>
                        <input type="datetime-local" class="form-control" name="fecha_fin" id="fecha_fin" required value="{{ old('fecha_fin') }}">
                    </div>
                    <div class="col-lg-3 mb-4">
                        <label for="municipio">Municipio</label>
                        <input type="text" class="form-control" name="municipio" id="municipio" value="{{ old('municipio') }}">
                    </div>
                    <div class="col-lg-3 mb-4">
                        <label for="departamento">Departamento</label>
                        <input type="text" class="form-control" name="departamento" id="departamento" value="{{ old('departamento') }}">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-lg-6 mb-4">
                        <label for="id_artista">Artista</label>
                        <select name="id_artista" id="id_artista" class="form-control">
                            <option value="">-- Seleccione un artista --</option>
                            @foreach ($artistas as $artista)
                                <option value="{{ $artista->id ?? $artista['id'] }}"
                                    @if (old('id_artista') == ($artista->id ?? $artista['id'])) selected @endif>
                                    {{ $artista->nombre ?? $artista['nombre'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                    </div>
                    <br><br>
                    <div class="col-lg-6">
                        <a href="{{ route('evento.index') }}" class="btn btn-secondary btn-block">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
        
@endsection