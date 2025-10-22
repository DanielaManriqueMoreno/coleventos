@extends('templates.base')
@section('title', 'Crear Artistas')
@section('header', 'Crear Artistas')
@section('content')
    @include('templates.messages')

<div class="row">
    <div class="col-lg-12 mb-4">
        <form action="{{ route('artista.store') }}" method="post">
            @csrf
            <div class="row form-group">
                <div class="col-lg-12 mb-4">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" 
                    required value="{{ old('nombre') }}">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-12 mb-4">
                    <label for="genero">Genero</label>
                    <input type="text" class="form-control" name="genero" id="genero" 
                    required value="{{ old('genero') }}">
                </div>
            </div>
            <div class="row form-group">
                <div class="col-lg-12 mb-4">
                    <label for="ciudad_origen">Ciudad Origen</label>
                    <input type="text" class="form-control" name="ciudad_origen" id="ciudad_origen" 
                    required value="{{ old('ciudad_origen') }}">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                </div>
                <br><br>
                <div class="col-lg-6">
                    <a href="{{ route('artista.index') }}" class="btn btn-secondary btn-block">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</div>
    
@endsection