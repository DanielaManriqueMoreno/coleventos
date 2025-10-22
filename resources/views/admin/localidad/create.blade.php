@extends('templates.base')
@section('title', 'Crear Localidad')
@section('header', 'Crear Localidad')
@section('content')
    @include('templates.messages')

<div class="row">
    <div class="col-lg-12 mb-4">
        <form action="{{ route('localidad.store') }}" method="post">
            @csrf
            <div class="row form-group">
                <div class="col-lg-12 mb-4">
                    <label for="nombre">Localidad</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" 
                    required value="{{ old('nombre') }}">
                </div>
            </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                </div>
                <br><br>
                <div class="col-lg-6">
                    <a href="{{ route('localidad.index') }}" class="btn btn-secondary btn-block">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
</div>
    
@endsection