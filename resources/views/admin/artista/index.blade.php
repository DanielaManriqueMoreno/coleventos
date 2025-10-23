@extends('templates.base')
@section('title', 'Artistas')
@section('header', 'Artistas')
@section('content')

@include('templates.messages')

<div class="row">
    <div class="col-lg-12 mb-4 d-grid gap-2 d-md-block">
        <a href="{{ route('admin.artista.create') }}" class="btn btn-primary">Crear</a>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 mb-4">
        <table id="table_data" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Género Musical</th>
                    <th>Ciudad Natal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($artistas as $artista)
                <tr>
                    <td>{{ $artista->id }}</td>
                    <td>{{ $artista->nombres }}</td>
                    <td>{{ $artista->apellidos }}</td>
                    <td>{{ $artista->genero_musical }}</td>
                    <td>{{ $artista->ciudad_natal }}</td>
                    <td>
                        <a href="{{ route('admin.artista.edit', $artista->id) }}"  class="btn btn-primary btn-circle btn-sm" title="Editar">
                            <i class="far fa-edit"></i>
                        </a>
                        <a href="{{ route('admin.artista.destroy', $artista->id) }}" class="btn btn-danger btn-circle btn-sm" title="Eliminar" onclick="return remove();">
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