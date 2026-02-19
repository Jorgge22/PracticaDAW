@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm">
                    <!-- Titulo -->
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Editar Entrenamiento</h4>
                    </div>

                    <!-- Formulario -->
                    <div class="card-body">
                        <form method="POST" action="{{ route('resultados.update', $resultado->id) }}">
                            @csrf
                            @method('PUT')

                            <!-- Bicicleta -->
                            <div class="row mb-3">
                                <label for="id_bicicleta" class="col-md-4 col-form-label text-md-end">Bicicleta *</label>

                                <div class="col-md-6">
                                    <select id="id_bicicleta" name="id_bicicleta" class="form-control @error('id_bicicleta') is-invalid @enderror" required>
                                        <option value="" disabled {{ old('id_bicicleta', $resultado->id_bicicleta) ? '' : 'selected' }}>Selecciona una bicicleta</option>
                                        @foreach($bicicletas as $bicicleta)
                                            <option value="{{ $bicicleta->id }}" {{ old('id_bicicleta', $resultado->id_bicicleta) == $bicicleta->id ? 'selected' : '' }}>
                                                {{ $bicicleta->nombre }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('id_bicicleta')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Sesión -->
                            <div class="row mb-3">
                                <label for="id_sesion" class="col-md-4 col-form-label text-md-end">Sesión *</label>

                                <div class="col-md-6">
                                    <select id="id_sesion" name="id_sesion" class="form-control @error('id_sesion') is-invalid @enderror" required>
                                        <option value="" disabled {{ old('id_sesion', $resultado->id_sesion) ? '' : 'selected' }}>Selecciona una sesión</option>
                                        @foreach($sesiones as $sesion)
                                            <option value="{{ $sesion->id }}" {{ old('id_sesion', $resultado->id_sesion) == $sesion->id ? 'selected' : '' }}>
                                                {{ $sesion->nombre }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('id_sesion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Fecha -->
                            <div class="row mb-3">
                                <label for="fecha" class="col-md-4 col-form-label text-md-end">Fecha *</label>

                                <div class="col-md-6">
                                    <input id="fecha" type="date"
                                        class="form-control @error('fecha') is-invalid @enderror" name="fecha"
                                        value="{{ old('fecha', $resultado->fecha) }}" required>

                                    @error('fecha')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Duración -->
                            <div class="row mb-3">
                                <label for="duracion" class="col-md-4 col-form-label text-md-end">Duración (minutos)</label>

                                <div class="col-md-6">
                                    <input id="duracion" type="number"
                                        class="form-control @error('duracion') is-invalid @enderror" name="duracion"
                                        value="{{ old('duracion', $resultado->duracion) }}" min="0">

                                    @error('duracion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Kilómetros -->
                            <div class="row mb-3">
                                <label for="kilometros" class="col-md-4 col-form-label text-md-end">Kilómetros</label>

                                <div class="col-md-6">
                                    <input id="kilometros" type="number" step="0.01"
                                        class="form-control @error('kilometros') is-invalid @enderror" name="kilometros"
                                        value="{{ old('kilometros', $resultado->kilometros) }}" min="0">

                                    @error('kilometros')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Recorrido -->
                            <div class="row mb-3">
                                <label for="recorrido" class="col-md-4 col-form-label text-md-end">Recorrido</label>

                                <div class="col-md-6">
                                    <input id="recorrido" type="text"
                                        class="form-control @error('recorrido') is-invalid @enderror" name="recorrido"
                                        value="{{ old('recorrido', $resultado->recorrido) }}">

                                    @error('recorrido')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Pulso Medio -->
                            <div class="row mb-3">
                                <label for="pulso_medio" class="col-md-4 col-form-label text-md-end">Pulso Medio (bpm)</label>

                                <div class="col-md-6">
                                    <input id="pulso_medio" type="number"
                                        class="form-control @error('pulso_medio') is-invalid @enderror" name="pulso_medio"
                                        value="{{ old('pulso_medio', $resultado->pulso_medio) }}" min="0">

                                    @error('pulso_medio')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Pulso Máximo -->
                            <div class="row mb-3">
                                <label for="pulso_max" class="col-md-4 col-form-label text-md-end">Pulso Máximo (bpm)</label>

                                <div class="col-md-6">
                                    <input id="pulso_max" type="number"
                                        class="form-control @error('pulso_max') is-invalid @enderror" name="pulso_max"
                                        value="{{ old('pulso_max', $resultado->pulso_max) }}" min="0">

                                    @error('pulso_max')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Potencia Media -->
                            <div class="row mb-3">
                                <label for="potencia_media" class="col-md-4 col-form-label text-md-end">Potencia Media (w)</label>

                                <div class="col-md-6">
                                    <input id="potencia_media" type="number"
                                        class="form-control @error('potencia_media') is-invalid @enderror" name="potencia_media"
                                        value="{{ old('potencia_media', $resultado->potencia_media) }}" min="0">

                                    @error('potencia_media')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Potencia Normalizada -->
                            <div class="row mb-3">
                                <label for="potencia_normalizada" class="col-md-4 col-form-label text-md-end">Potencia Normalizada (w)</label>

                                <div class="col-md-6">
                                    <input id="potencia_normalizada" type="number"
                                        class="form-control @error('potencia_normalizada') is-invalid @enderror" name="potencia_normalizada"
                                        value="{{ old('potencia_normalizada', $resultado->potencia_normalizada) }}" min="0">

                                    @error('potencia_normalizada')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Velocidad Media -->
                            <div class="row mb-3">
                                <label for="velocidad_media" class="col-md-4 col-form-label text-md-end">Velocidad Media (km/h)</label>

                                <div class="col-md-6">
                                    <input id="velocidad_media" type="number" step="0.01"
                                        class="form-control @error('velocidad_media') is-invalid @enderror" name="velocidad_media"
                                        value="{{ old('velocidad_media', $resultado->velocidad_media) }}" min="0">

                                    @error('velocidad_media')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Puntos Estrés TSS -->
                            <div class="row mb-3">
                                <label for="puntos_estres_tss" class="col-md-4 col-form-label text-md-end">Puntos Estrés (TSS)</label>

                                <div class="col-md-6">
                                    <input id="puntos_estres_tss" type="number" step="0.01"
                                        class="form-control @error('puntos_estres_tss') is-invalid @enderror" name="puntos_estres_tss"
                                        value="{{ old('puntos_estres_tss', $resultado->puntos_estres_tss) }}" min="0">

                                    @error('puntos_estres_tss')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Factor Intensidad IF -->
                            <div class="row mb-3">
                                <label for="factor_intensidad_if" class="col-md-4 col-form-label text-md-end">Factor Intensidad (IF)</label>

                                <div class="col-md-6">
                                    <input id="factor_intensidad_if" type="number" step="0.01"
                                        class="form-control @error('factor_intensidad_if') is-invalid @enderror" name="factor_intensidad_if"
                                        value="{{ old('factor_intensidad_if', $resultado->factor_intensidad_if) }}" min="0">

                                    @error('factor_intensidad_if')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Ascenso -->
                            <div class="row mb-3">
                                <label for="ascenso_metros" class="col-md-4 col-form-label text-md-end">Ascenso (metros)</label>

                                <div class="col-md-6">
                                    <input id="ascenso_metros" type="number"
                                        class="form-control @error('ascenso_metros') is-invalid @enderror" name="ascenso_metros"
                                        value="{{ old('ascenso_metros', $resultado->ascenso_metros) }}" min="0">

                                    @error('ascenso_metros')
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
                                        rows="3">{{ old('comentario', $resultado->comentario) }}</textarea>

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
                                        Actualizar Entrenamiento
                                    </button>
                                    <a href="{{ route('resultados.show', $resultado->id) }}" class="btn btn-secondary">
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
