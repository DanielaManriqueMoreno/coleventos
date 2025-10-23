@extends('templates.base')
@section('title', 'Configurar Boletería')
@section('header', 'Configurar Nueva Boletería')

@section('content')

@include('templates.messages')

<div class="row">
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Asignar Localidad a Evento</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.boleteria.store') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="evento_id">Seleccionar Evento</label>
                        <select name="evento_id" id="evento_id" class="form-control @error('evento_id') is-invalid @enderror" required>
                            <option value="">-- Elija un evento --</option>
                            @foreach($eventos as $evento)
                                <option value="{{ $evento->id }}" {{ old('evento_id') == $evento->id ? 'selected' : '' }}>
                                    {{ $evento->nombre }} ({{ $evento->municipio }})
                                </option>
                            @endforeach
                        </select>
                        @error('evento_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="localidad_id">Seleccionar Localidad</label>
                        <select name="localidad_id" id="localidad_id" class="form-control @error('localidad_id') is-invalid @enderror" required>
                            <option value="">-- Elija una localidad --</option>
                            @foreach($localidades as $localidad)
                                <option value="{{ $localidad->id }}" {{ old('localidad_id') == $localidad->id ? 'selected' : '' }}>
                                    {{ $localidad->nombre_localidad }}
                                </option>
                            @endforeach
                        </select>
                        @error('localidad_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="valor_boleta">Valor de la Boleta</label>
                                <input type="number" name="valor_boleta" id="valor_boleta" class="form-control @error('valor_boleta') is-invalid @enderror" value="{{ old('valor_boleta') }}" required min="0" step="1">
                                @error('valor_boleta')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cantidad_disponible">Cantidad Disponible</label>
                                <input type="number" name="cantidad_disponible" id="cantidad_disponible" class="form-control @error('cantidad_disponible') is-invalid @enderror" value="{{ old('cantidad_disponible') }}" required min="0">
                                @error('cantidad_disponible')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar Configuración</button>
                    <a href="{{ route('admin.boleteria.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection