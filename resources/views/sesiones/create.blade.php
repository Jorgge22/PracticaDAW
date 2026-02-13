@extends('layouts.app')

<!-- Importar Carbon -->
@php
    use Carbon\Carbon;
@endphp

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Tarjeta principal -->
                <div class="card shadow-sm">
                    <!-- Cabecera -->
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Crear Nueva Sesión</h4>
                    </div>

                    <!-- Formulario -->
                    <div class="card-body">
                        <form method="POST" action="{{ route('sesiones.store') }}">
                            @csrf

                            <!-- Plan -->
                            <div class="row mb-3">
                                <label for="id_plan" class="col-md-4 col-form-label text-md-end">Plan *</label>

                                <div class="col-md-6">
                                    <select id="id_plan" class="form-select @error('id_plan') is-invalid @enderror"
                                        name="id_plan" required>
                                        <option value="">Selecciona un plan</option>
                                        @foreach($planes as $plan)
                                            <option value="{{ $plan->id }}" {{ old('id_plan') == $plan->id ? 'selected' : '' }}>
                                                {{ $plan->nombre }}
                                                ({{ Carbon::parse($plan->fecha_inicio)->format('d/m/Y') }} -
                                                {{ Carbon::parse($plan->fecha_fin)->format('d/m/Y') }})
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('id_plan')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Nombre -->
                            <div class="row mb-3">
                                <label for="nombre" class="col-md-4 col-form-label text-md-end">Nombre *</label>

                                <div class="col-md-6">
                                    <input id="nombre" type="text"
                                        class="form-control @error('nombre') is-invalid @enderror" name="nombre"
                                        value="{{ old('nombre') }}" placeholder="Ej: Sesión de Rodaje Suave"
                                        autocomplete="off" required>

                                    @error('nombre')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Descripción -->
                            <div class="row mb-3">
                                <label for="descripcion" class="col-md-4 col-form-label text-md-end">Descripción *</label>

                                <div class="col-md-6">
                                    <textarea id="descripcion"
                                        class="form-control @error('descripcion') is-invalid @enderror" name="descripcion"
                                        rows="3"
                                        placeholder="Notas especiales, instrucciones..." required>{{ old('descripcion') }}</textarea>

                                    @error('descripcion')
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
                                    <input id="fecha" type="date" class="form-control @error('fecha') is-invalid @enderror"
                                        name="fecha" value="{{ old('fecha') }}" required>

                                    @error('fecha')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Completada -->
                            <div class="row mb-3">
                                <label for="completada" class="col-md-4 col-form-label text-md-end">Completada</label>

                                <div class="col-md-6 mt-2">
                                    <div class="form-check">
                                        <input id="completada" type="checkbox"
                                            class="form-check-input @error('completada') is-invalid @enderror"
                                            name="completada" value="1" {{ old('completada') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="completada">
                                            Marcar como completada
                                        </label>
                                    </div>

                                    @error('completada')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Botones -->
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Crear Sesión
                                    </button>
                                    <a href="{{ route('sesiones') }}" class="btn btn-secondary">
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