@extends('templates.base') {{-- Extiende tu plantilla base --}}
@section('title', 'Gestionar Eventos') {{-- Título de la página --}}
@section('header', 'Listado de Eventos') {{-- Encabezado principal --}}

@section('content')

    {{-- Botón para ir al formulario de creación --}}
    <div class="row">
        <div class="col-lg-12 mb-4">
            <a href="{{ route('admin.evento.create') }}" class="btn btn-primary">
                <i class="fas fa-plus fa-sm fa-fw mr-2"></i> Crear Nuevo Evento
            </a>
        </div>
    </div>

    {{-- Incluye la plantilla para mostrar mensajes flash (éxito, error) --}}
    @include('templates.messages')

    {{-- Tabla para mostrar los eventos --}}
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Eventos Registrados</h6>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Inicio</th>
                            <th>Fin</th>
                            <th>Artistas</th>
                            <th>Ubicación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Itera sobre la colección de eventos pasada desde el controlador --}}
                        @forelse ($eventos as $evento)
                            <tr>
                                <td>{{ $evento->id }}</td>
                                <td>{{ $evento->nombre }}</td>
                                <td>{{ Str::limit($evento->descripcion, 40) }}</td> {{-- Limita la descripción --}}
                                <td>{{ $evento->fecha_hora_inicio->format('d/m/y H:i') }}</td> {{-- Formato corto de fecha/hora --}}
                                <td>{{ $evento->fecha_hora_fin->format('d/m/y H:i') }}</td>
                                <td>
                                    {{-- Muestra los nombres de artistas o un mensaje si no hay --}}
                                    @if ($evento->artistas->isNotEmpty())
                                        {{ $evento->artistas->pluck('nombres')->join(', ') }}
                                    @else
                                        <span class="text-muted small">Sin asignar</span>
                                    @endif
                                </td>
                                <td>{{ $evento->municipio }}, {{ $evento->departamento }}</td>
                                <td>
                                    {{-- Botón para Editar el Evento --}}
                                    <a href="{{ route('admin.evento.edit', $evento->id) }}" class="btn btn-primary btn-circle btn-sm" title="Editar Evento">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    {{-- Botón para ir a Asociar Artistas --}}
                                    <a href="{{ route('evento.artista.create', $evento->id) }}" class="btn btn-info btn-circle btn-sm" title="Asociar Artistas">
                                        <i class="fas fa-users"></i>
                                    </a>

                                    {{-- Formulario para Eliminar el Evento (Usa DELETE) --}}
                                    <form action="{{ route('admin.evento.destroy', $evento->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este evento?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-circle btn-sm" title="Eliminar Evento">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            {{-- Mensaje si no hay eventos registrados --}}
                            <tr>
                                <td colspan="8" class="text-center text-muted">No hay eventos registrados todavía.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    {{-- Scripts adicionales si usas DataTables u otra librería --}}
    {{-- Por ejemplo, para DataTables:
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable(); // Inicializa DataTables en la tabla con id "dataTable"
        });
    </script>
    --}}
@endsection