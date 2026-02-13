@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Tarjeta -->
                <div class="card shadow-sm">
                    <!-- Titulo -->
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Editar Plan</h4>
                    </div>

                    <!-- Formulario -->
                    <div class="card-body">
                        <form method="POST" action="{{ route('planes.update', $plan->id) }}">
                            @csrf
                            @method('PUT')

                            <!-- Nombre -->
                            <div class="row mb-3">
                                <label for="nombre" class="col-md-4 col-form-label text-md-end">Nombre *</label>

                                <div class="col-md-6">
                                    <input id="nombre" type="text"
                                        class="form-control @error('nombre') is-invalid @enderror" name="nombre"
                                        value="{{ old('nombre', $plan->nombre) }}" autocomplete="off" required>

                                    @error('nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Descripcion -->
                            <div class="row mb-3">
                                <label for="descripcion" class="col-md-4 col-form-label text-md-end">Descripción</label>

                                <div class="col-md-6">
                                    <textarea id="descripcion"
                                        class="form-control @error('descripcion') is-invalid @enderror" name="descripcion"
                                        rows="3">{{ old('descripcion', $plan->descripcion) }}</textarea>

                                    @error('descripcion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Fecha inicio -->
                            <div class="row mb-3">
                                <label for="fecha_inicio" class="col-md-4 col-form-label text-md-end">Fecha de Inicio
                                    *</label>

                                <div class="col-md-6">
                                    <input id="fecha_inicio" type="date"
                                        class="form-control @error('fecha_inicio') is-invalid @enderror" name="fecha_inicio"
                                        value="{{ old('fecha_inicio', $plan->fecha_inicio) }}" required>

                                    @error('fecha_inicio')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Fecha fin -->
                            <div class="row mb-3">
                                <label for="fecha_fin" class="col-md-4 col-form-label text-md-end">Fecha de Fin *</label>

                                <div class="col-md-6">
                                    <input id="fecha_fin" type="date"
                                        class="form-control @error('fecha_fin') is-invalid @enderror" name="fecha_fin"
                                        value="{{ old('fecha_fin', $plan->fecha_fin) }}" required>

                                    @error('fecha_fin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Objetivo -->
                            <div class="row mb-3">
                                <label for="objetivo" class="col-md-4 col-form-label text-md-end">Objetivo</label>

                                <div class="col-md-6">
                                    <input id="objetivo" type="text"
                                        class="form-control @error('objetivo') is-invalid @enderror" name="objetivo"
                                        value="{{ old('objetivo', $plan->objetivo) }}">

                                    @error('objetivo')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Activo -->
                            <div class="row mb-3">
                                <label for="activo" class="col-md-4 col-form-label text-md-end">Activo</label>

                                <div class="col-md-6 mt-2">
                                    <div class="form-check">
                                        <input id="activo" type="checkbox"
                                            class="form-check-input @error('activo') is-invalid @enderror" name="activo"
                                            value="1" {{ old('activo', $plan->activo) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="activo">
                                            Este plan está activo
                                        </label>
                                    </div>

                                    @error('activo')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <!-- Botones -->
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Actualizar Plan
                                    </button>
                                    <a href="{{ route('planes.show', $plan->id) }}" class="btn btn-secondary">
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