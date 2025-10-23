@extends('templates.base')
@section('title', 'Asociar Artista a Evento')
@section('header', 'Asociar Artista')

@section('content')

{{-- Muestra mensajes de éxito o error --}}
@include('templates.messages')

<div class="row">
    <div class="col-lg-12">
        {{-- Tarjeta del Formulario Principal --}}
        <div class="card shadow mb-4">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">
                    Asociar Artista al Evento: <span class="text-info">{{ $evento->nombre }}</span>
                </h6>
                <small class="text-muted">
                    ({{ $evento->fecha_hora_inicio->format('d/m/Y H:i') }} - {{ $evento->fecha_hora_fin->format('d/m/Y H:i') }})
                </small>
            </div>
            <div class="card-body">
                {{-- Muestra el error específico de validación de horario si existe --}}
                @error('horario')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                
                {{-- El formulario envía a la ruta 'evento.artista.store' --}}
                <form action="{{ route('evento.artista.store', $evento->id) }}" method="POST">
                    @csrf

                    {{-- RF4: Dropdown para seleccionar el Artista --}}
                    <div class="form-group">
                        <label for="artista_id">Seleccionar Artista (RF4)</label>
                        <select name="artista_id" id="artista_id" class="form-control @error('artista_id') is-invalid @enderror" required>
                            <option value="">-- Elija un artista --</option>
                            {{-- Itera sobre la lista de artistas pasada desde el controlador --}}
                            @foreach($artistas as $artista)
                                <option value="{{ $artista->id }}" {{ old('artista_id') == $artista->id ? 'selected' : '' }}>
                                    {{ $artista->nombres }} {{ $artista->apellidos }} ({{ $artista->genero_musical }})
                                </option>
                            @endforeach
                        </select>
                        {{-- Muestra error de validación para 'artista_id' --}}
                        @error('artista_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                       <i class="fas fa-link fa-sm fa-fw mr-2"></i> Asociar Artista
                    </button>
                    {{-- Botón para volver al índice de eventos --}}
                    <a href="{{ route('admin.evento.index') }}" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
        
        {{-- Tarjeta Opcional: Mostrar artistas ya asociados --}}
        <div class="card shadow mb-4">
             <div class="card-header">
                 <h6 class="m-0 font-weight-bold text-secondary">Artistas ya Asociados a este Evento</h6>
             </div>
             <div class="card-body">
                 {{-- Verifica si la relación 'artistas' del evento tiene elementos --}}
                 @if($evento->artistas->count() > 0)
                     <ul class="list-group">
                         {{-- Itera sobre los artistas ya asociados --}}
                         @foreach($evento->artistas as $artista_asociado)
                             <li class="list-group-item d-flex justify-content-between align-items-center">
                                 {{ $artista_asociado->nombres }} {{ $artista_asociado->apellidos }}
                                 {{-- Formulario pequeño para Desasociar (usa DELETE) --}}
                                 <form action="{{ route('evento.artista.destroy', ['evento' => $evento->id, 'artista' => $artista_asociado->id]) }}" method="POST" onsubmit="return confirm('¿Quitar a este artista del evento?')">
                                     @csrf
                                     @method('DELETE')
                                     <button type="submit" class="btn btn-danger btn-sm" title="Quitar Artista">
                                         <i class="fas fa-times"></i> Quitar
                                     </button>
                                 </form>
                             </li>
                         @endforeach
                     </ul>
                 @else
                     {{-- Mensaje si no hay artistas asociados --}}
                     <p class="text-center text-muted">Aún no hay artistas asociados a este evento.</p>
                 @endif
             </div>
        </div>
        
    </div>
</div>
@endsection