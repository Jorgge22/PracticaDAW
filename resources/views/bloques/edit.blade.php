@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Tarjeta -->
                <div class="card shadow-sm">
                    <!-- Titulo -->
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Editar Bloque de Entrenamiento</h4>
                    </div>

                    <!-- Formulario -->
                    <div class="card-body">
                        <form method="POST" action="{{ route('bloques.update', $bloque->id) }}">
                            @csrf
                            @method('PUT')

                            <!-- Nombre -->
                            <div class="row mb-3">
                                <label for="nombre" class="col-md-4 col-form-label text-md-end">Nombre *</label>

                                <div class="col-md-6">
                                    <input id="nombre" type="text"
                                        class="form-control @error('nombre') is-invalid @enderror" name="nombre"
                                        value="{{ old('nombre', $bloque->nombre) }}" autocomplete="off" required>

                                    @error('nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Descripción -->
                            <div class="row mb-3">
                                <label for="descripcion" class="col-md-4 col-form-label text-md-end">Descripción</label>

                                <div class="col-md-6">
                                    <textarea id="descripcion"
                                        class="form-control @error('descripcion') is-invalid @enderror" name="descripcion"
                                        rows="3">{{ old('descripcion', $bloque->descripcion) }}</textarea>

                                    @error('descripcion')
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
                                        <option value="" disabled {{ old('tipo', $bloque->tipo) ? '' : 'selected' }}>Selecciona un tipo</option>
                                        <option value="rodaje" {{ old('tipo', $bloque->tipo) == 'rodaje' ? 'selected' : '' }}>Rodaje</option>
                                        <option value="intervalos" {{ old('tipo', $bloque->tipo) == 'intervalos' ? 'selected' : '' }}>Intervalos</option>
                                        <option value="fuerza" {{ old('tipo', $bloque->tipo) == 'fuerza' ? 'selected' : '' }}>Fuerza</option>
                                        <option value="recuperacion" {{ old('tipo', $bloque->tipo) == 'recuperacion' ? 'selected' : '' }}>Recuperación</option>
                                        <option value="test" {{ old('tipo', $bloque->tipo) == 'test' ? 'selected' : '' }}>Test</option>
                                    </select>

                                    @error('tipo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Duración Estimada -->
                            <div class="row mb-3">
                                <label for="duracion_estimada" class="col-md-4 col-form-label text-md-end">Duración Estimada (minutos)</label>

                                <div class="col-md-6">
                                    <input id="duracion_estimada" type="number"
                                        class="form-control @error('duracion_estimada') is-invalid @enderror" name="duracion_estimada"
                                        value="{{ old('duracion_estimada', $bloque->duracion_estimada) }}" min="0">

                                    @error('duracion_estimada')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Potencia % Mín -->
                            <div class="row mb-3">
                                <label for="potencia_pct_min" class="col-md-4 col-form-label text-md-end">Potencia % Mínimo</label>

                                <div class="col-md-6">
                                    <input id="potencia_pct_min" type="number"
                                        class="form-control @error('potencia_pct_min') is-invalid @enderror" name="potencia_pct_min"
                                        value="{{ old('potencia_pct_min', $bloque->potencia_pct_min) }}" min="0" max="100">

                                    @error('potencia_pct_min')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Potencia % Máx -->
                            <div class="row mb-3">
                                <label for="potencia_pct_max" class="col-md-4 col-form-label text-md-end">Potencia % Máximo</label>

                                <div class="col-md-6">
                                    <input id="potencia_pct_max" type="number"
                                        class="form-control @error('potencia_pct_max') is-invalid @enderror" name="potencia_pct_max"
                                        value="{{ old('potencia_pct_max', $bloque->potencia_pct_max) }}" min="0" max="100">

                                    @error('potencia_pct_max')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Pulso % Máximo -->
                            <div class="row mb-3">
                                <label for="pulso_pct_max" class="col-md-4 col-form-label text-md-end">Pulso % Máximo</label>

                                <div class="col-md-6">
                                    <input id="pulso_pct_max" type="number"
                                        class="form-control @error('pulso_pct_max') is-invalid @enderror" name="pulso_pct_max"
                                        value="{{ old('pulso_pct_max', $bloque->pulso_pct_max) }}" min="0" max="100">

                                    @error('pulso_pct_max')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Pulso Reserva % -->
                            <div class="row mb-3">
                                <label for="pulso_reserva_pct" class="col-md-4 col-form-label text-md-end">Pulso Reserva %</label>

                                <div class="col-md-6">
                                    <input id="pulso_reserva_pct" type="number"
                                        class="form-control @error('pulso_reserva_pct') is-invalid @enderror" name="pulso_reserva_pct"
                                        value="{{ old('pulso_reserva_pct', $bloque->pulso_reserva_pct) }}" min="0" max="100">

                                    @error('pulso_reserva_pct')
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
                                        rows="3">{{ old('comentario', $bloque->comentario) }}</textarea>

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
                                        Actualizar Bloque
                                    </button>
                                    <a href="{{ route('bloques.show', $bloque->id) }}" class="btn btn-secondary">
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
