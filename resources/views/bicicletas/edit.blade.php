@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Tarjeta -->
                <div class="card shadow-sm">
                    <!-- Titulo -->
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Editar Bicicleta</h4>
                    </div>

                    <!-- Formulario -->
                    <div class="card-body">
                        <form method="POST" action="{{ route('bicicletas.update', $bicicleta->id) }}">
                            @csrf
                            @method('PUT')

                            <!-- Nombre -->
                            <div class="row mb-3">
                                <label for="nombre" class="col-md-4 col-form-label text-md-end">Nombre *</label>

                                <div class="col-md-6">
                                    <input id="nombre" type="text"
                                        class="form-control @error('nombre') is-invalid @enderror" name="nombre"
                                        value="{{ old('nombre', $bicicleta->nombre) }}" autocomplete="off" required>

                                    @error('nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Tipo -->
                            <div class="row mb-3">
                                <label for="tipo" class="col-md-4 col-form-label text-md-end">Tipo *</label>

                                <div class="col-md-6">
                                    <select id="tipo" name="tipo" class="form-control @error('tipo') is-invalid @enderror" required>
                                        <option value="" disabled {{ old('tipo', $bicicleta->tipo) ? '' : 'selected' }}>Selecciona un tipo</option>
                                        <option value="carretera" {{ old('tipo', $bicicleta->tipo) == 'carretera' ? 'selected' : '' }}>Carretera</option>
                                        <option value="mtb" {{ old('tipo', $bicicleta->tipo) == 'mtb' ? 'selected' : '' }}>MTB</option>
                                        <option value="gravel" {{ old('tipo', $bicicleta->tipo) == 'gravel' ? 'selected' : '' }}>Gravel</option>
                                        <option value="rodillo" {{ old('tipo', $bicicleta->tipo) == 'rodillo' ? 'selected' : '' }}>Rodillo</option>
                                    </select>

                                    @error('tipo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Comentario -->
                            <div class="row mb-3">
                                <label for="comentario" class="col-md-4 col-form-label text-md-end">Comentario</label>

                                <div class="col-md-6">
                                    <textarea id="comentario"
                                        class="form-control @error('comentario') is-invalid @enderror" name="comentario"
                                        rows="3">{{ old('comentario', $bicicleta->comentario) }}</textarea>

                                    @error('comentario')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Botones -->
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Actualizar Bicicleta
                                    </button>
                                    <a href="{{ route('bicicletas.show', $bicicleta->id) }}" class="btn btn-secondary">
                                        Cancelar
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection