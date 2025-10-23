@extends('templates.base')
@section('title', 'Gestionar Boletería')
@section('header', 'Configuraciones de Boletería')

@section('content')

<div class="row">
    <div class="col-lg-12 mb-4 d-grid gap-2 d-md-block">
        <a href="{{ route('admin.boleteria.create') }}" class="btn btn-primary">
            <i class="fas fa-plus fa-sm fa-fw mr-2"></i> Crear Nueva Configuración
        </a>
    </div>
</div>

@include('templates.messages')

<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Listado de Configuraciones</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table_data" class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Evento</th>
                                <th>Localidad</th>
                                <th>Valor Boleta</th>
                                <th>Disponibles</th>
                                <th>Inicial</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($boleterias as $boleteria)
                            <tr>
                                <td>{{ $boleteria->id }}</td>
                                <td>{{ $boleteria->evento->nombre ?? 'Evento no encontrado' }}</td>
                                <td>{{ $boleteria->localidad->nombre_localidad ?? 'Localidad no encontrada' }}</td>
                                <td>${{ number_format($boleteria->valor_boleta, 0) }}</td>
                                <td>{{ $boleteria->cantidad_disponible }}</td>
                                <td>{{ $boleteria->cantidad_inicial }}</td>
                                <td>
                                    <a href="{{ route('admin.boleteria.edit', $boleteria->id) }}" class="btn btn-primary btn-circle btn-sm" title="Editar">
                                        <i class="far fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">No hay configuraciones de boletería creadas.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
