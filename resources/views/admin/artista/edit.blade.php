@extends('templates.base')
@section('title', 'Editar Artista')
@section('header', 'Editar Artista')
@section('content')
    @include('templates.messages')

<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fas fa-edit me-2"></i>Editar Información del Artista
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.artista.update', $artista->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <label for="nombres" class="form-label">Nombres <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nombres') is-invalid @enderror" 
                                   name="nombres" id="nombres" 
                                   required value="{{ old('nombres', $artista->nombres) }}"
                                   placeholder="Ingrese los nombres del artista">
                            @error('nombres')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-4">
                            <label for="apellidos" class="form-label">Apellidos <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('apellidos') is-invalid @enderror" 
                                   name="apellidos" id="apellidos" 
                                   required value="{{ old('apellidos', $artista->apellidos) }}"
                                   placeholder="Ingrese los apellidos del artista">
                            @error('apellidos')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <label for="genero_musical" class="form-label">Género Musical <span class="text-danger">*</span></label>
                            <select class="form-select @error('genero_musical') is-invalid @enderror" 
                                    name="genero_musical" id="genero_musical" required>
                                <option value="">Seleccione un género</option>
                                <option value="Rock" {{ old('genero_musical', $artista->genero_musical) == 'Rock' ? 'selected' : '' }}>Rock</option>
                                <option value="Pop" {{ old('genero_musical', $artista->genero_musical) == 'Pop' ? 'selected' : '' }}>Pop</option>
                                <option value="Vallenato" {{ old('genero_musical', $artista->genero_musical) == 'Vallenato' ? 'selected' : '' }}>Vallenato</option>
                                <option value="Salsa" {{ old('genero_musical', $artista->genero_musical) == 'Salsa' ? 'selected' : '' }}>Salsa</option>
                                <option value="Reggaeton" {{ old('genero_musical', $artista->genero_musical) == 'Reggaeton' ? 'selected' : '' }}>Reggaeton</option>
                                <option value="Bachata" {{ old('genero_musical', $artista->genero_musical) == 'Bachata' ? 'selected' : '' }}>Bachata</option>
                                <option value="Merengue" {{ old('genero_musical', $artista->genero_musical) == 'Merengue' ? 'selected' : '' }}>Merengue</option>
                                <option value="Cumbia" {{ old('genero_musical', $artista->genero_musical) == 'Cumbia' ? 'selected' : '' }}>Cumbia</option>
                                <option value="Ranchera" {{ old('genero_musical', $artista->genero_musical) == 'Ranchera' ? 'selected' : '' }}>Ranchera</option>
                                <option value="Electronica" {{ old('genero_musical', $artista->genero_musical) == 'Electronica' ? 'selected' : '' }}>Electrónica</option>
                                <option value="Jazz" {{ old('genero_musical', $artista->genero_musical) == 'Jazz' ? 'selected' : '' }}>Jazz</option>
                                <option value="Clasica" {{ old('genero_musical', $artista->genero_musical) == 'Clasica' ? 'selected' : '' }}>Clásica</option>
                                <option value="Otro" {{ old('genero_musical', $artista->genero_musical) == 'Otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                            @error('genero_musical')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-4">
                            <label for="ciudad_natal" class="form-label">Ciudad Natal <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('ciudad_natal') is-invalid @enderror" 
                                   name="ciudad_natal" id="ciudad_natal" 
                                   required value="{{ old('ciudad_natal', $artista->ciudad_natal) }}"
                                   placeholder="Ingrese la ciudad natal del artista">
                            @error('ciudad_natal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Nota:</strong> Todos los campos marcados con <span class="text-danger">*</span> son obligatorios.
                    </div>

                    <hr class="my-4">

                    <div class="row">
                        <div class="col-lg-6 mb-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-save me-2"></i>Actualizar Artista
                            </button>
                        </div>
                        <div class="col-lg-6 mb-2">
                            <a href="{{ route('admin.artista.index') }}" class="btn btn-secondary w-100">
                                <i class="fas fa-arrow-left me-2"></i>Volver al Listado
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    
@endsection

@section('scripts')
<script>
    // Confirmación antes de actualizar
    document.querySelector('form').addEventListener('submit', function(e) {
        if (!confirm('¿Está seguro de actualizar este artista?')) {
            e.preventDefault();
        }
    });
</script>
@endsection