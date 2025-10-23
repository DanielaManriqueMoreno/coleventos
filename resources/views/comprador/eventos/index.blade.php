@extends('templates.base')
@section('title', 'Eventos Disponibles')
@section('header', 'Eventos Disponibles para Comprar')

@section('content')
@include('templates.messages')

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Listado de Eventos</h6>

        {{-- Formulario de búsqueda --}}
        <form method="GET" action="{{ route('comprador.eventos.index') }}" class="form-inline">
            <input type="text" name="municipio" class="form-control form-control-sm mr-2"
                   placeholder="Buscar por municipio..." value="{{ request('municipio') }}">
            <button type="submit" class="btn btn-sm btn-primary">
                <i class="fas fa-search"></i> Buscar
            </button>
        </form>
    </div>

    <div class="card-body">
        @if ($eventos->isEmpty())
            <p class="text-center text-muted">No hay eventos disponibles en este momento.</p>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Inicio</th>
                            <th>Fin</th>
                            <th>Ubicación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($eventos as $evento)
                            <tr>
                                <td>{{ $evento->id }}</td>
                                <td>{{ $evento->nombre }}</td>
                                <td>{{ Str::limit($evento->descripcion, 40) }}</td>
                                <td>{{ \Carbon\Carbon::parse($evento->fecha_hora_inicio)->format('d/m/Y H:i') }}</td>
                                <td>{{ \Carbon\Carbon::parse($evento->fecha_hora_fin)->format('d/m/Y H:i') }}</td>
                                <td>{{ $evento->municipio }}, {{ $evento->departamento }}</td>
                                <td class="text-center">
                                    <a href="{{ route('comprador.eventos.show', $evento->id) }}" 
                                       class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> Ver Detalle
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
@endsection
