@extends('templates.base')
@section('title', 'Artistas')
@section('header', 'Artistas')
@section('content')

<div class="row">
    <div class="col-lg-12 mb-4 d-grid gap-2 d-md-block">
        <a href="{{ route('artista.create') }}" class="btn btn-primary">Crear</a>
    </div>
</div>

@include('templates.messages')

<div class="row">
    <div class="col-lg-12 mb-4">
        <table id="table_data" class="table table-striped table-hover">
            <thead>
                <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Genero</th>
                <th>Ciudad</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($artistas as $artista)
                <tr>
                    <td>{{ $artista["id"] }}</td>
                    <td>{{ $artista["nombre"] }}</td>
                    <td>{{ $artista["genero"] }}</td>
                    <td>{{ $artista["ciudad_origen"] }}</td>
                    <td>
                        <a href="{{ route('artista.edit', $artista["id"]) }}"  class="btn btn-primary btn-circle btn-sm" title="Editar">
                            <i class="far fa-edit"></i>
                        </a>
                        <a href="{{ route('artista.destroy', $artista["id"]) }}" class="btn btn-danger btn-circle btn-sm" title="Eliminar" onclick="return remove();">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection

@section('scripts')
    <script src="{{ asset('js/general.js') }}"></script>
@endsection