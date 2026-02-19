@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <!-- Tarjeta -->
            <div class="card shadow-sm">
                <!-- Cabecera -->
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Entrenamiento - {{ \Carbon\Carbon::parse($resultado->fecha)->format('d/m/Y') }}</h4>
                    <div>
                        <a href="{{ route('resultados.edit', $resultado->id) }}" class="btn btn-light btn-sm">Editar</a>
                        <form action="{{ route('resultados.destroy', $resultado->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                        </form>
                    </div>
                </div>

                <!-- Contenido -->
                <div class="card-body">
                    <div class="row">
                        <!-- Columna izquierda -->
                        <div class="col-md-6">
                            <!-- Información Básica -->
                            <h5 class="card-title mb-3">Información Básica</h5>
                            
                            <div class="row mb-3">
                                <div class="col-md-5">
                                    <strong>Fecha:</strong>
                                </div>
                                <div class="col-md-7">
                                    {{ \Carbon\Carbon::parse($resultado->fecha)->format('d/m/Y') }}
                                </div>
                            </div>

                            @if($resultado->duracion)
                            <div class="row mb-3">
                                <div class="col-md-5">
                                    <strong>Duración:</strong>
                                </div>
                                <div class="col-md-7">
                                    {{ $resultado->duracion }} minutos
                                </div>
                            </div>
                            @endif

                            @if($resultado->kilometros)
                            <div class="row mb-3">
                                <div class="col-md-5">
                                    <strong>Distancia:</strong>
                                </div>
                                <div class="col-md-7">
                                    {{ $resultado->kilometros }} km
                                </div>
                            </div>
                            @endif

                            @if($resultado->recorrido)
                            <div class="row mb-3">
                                <div class="col-md-5">
                                    <strong>Recorrido:</strong>
                                </div>
                                <div class="col-md-7">
                                    {{ $resultado->recorrido }}
                                </div>
                            </div>
                            @endif

                            @if($resultado->ascenso_metros)
                            <div class="row mb-3">
                                <div class="col-md-5">
                                    <strong>Ascenso:</strong>
                                </div>
                                <div class="col-md-7">
                                    {{ $resultado->ascenso_metros }} metros
                                </div>
                            </div>
                            @endif

                            <hr>

                            <!-- Datos de Pulso -->
                            <h5 class="card-title mb-3">Pulso</h5>

                            @if($resultado->pulso_medio)
                            <div class="row mb-3">
                                <div class="col-md-5">
                                    <strong>Medio:</strong>
                                </div>
                                <div class="col-md-7">
                                    {{ $resultado->pulso_medio }} bpm
                                </div>
                            </div>
                            @endif

                            @if($resultado->pulso_max)
                            <div class="row mb-3">
                                <div class="col-md-5">
                                    <strong>Máximo:</strong>
                                </div>
                                <div class="col-md-7">
                                    {{ $resultado->pulso_max }} bpm
                                </div>
                            </div>
                            @endif
                        </div>

                        <!-- Columna derecha -->
                        <div class="col-md-6">
                            <!-- Datos de Potencia -->
                            <h5 class="card-title mb-3">Potencia</h5>

                            @if($resultado->potencia_media)
                            <div class="row mb-3">
                                <div class="col-md-5">
                                    <strong>Media:</strong>
                                </div>
                                <div class="col-md-7">
                                    {{ $resultado->potencia_media }} w
                                </div>
                            </div>
                            @endif

                            @if($resultado->potencia_normalizada)
                            <div class="row mb-3">
                                <div class="col-md-5">
                                    <strong>Normalizada:</strong>
                                </div>
                                <div class="col-md-7">
                                    {{ $resultado->potencia_normalizada }} w
                                </div>
                            </div>
                            @endif

                            @if($resultado->velocidad_media)
                            <div class="row mb-3">
                                <div class="col-md-5">
                                    <strong>Velocidad Media:</strong>
                                </div>
                                <div class="col-md-7">
                                    {{ number_format($resultado->velocidad_media, 2) }} km/h
                                </div>
                            </div>
                            @endif

                            <hr>

                            <!-- Datos de Entrenamiento -->
                            <h5 class="card-title mb-3">Datos de Entrenamiento</h5>

                            @if($resultado->puntos_estres_tss)
                            <div class="row mb-3">
                                <div class="col-md-5">
                                    <strong>TSS:</strong>
                                </div>
                                <div class="col-md-7">
                                    {{ number_format($resultado->puntos_estres_tss, 2) }}
                                </div>
                            </div>
                            @endif

                            @if($resultado->factor_intensidad_if)
                            <div class="row mb-3">
                                <div class="col-md-5">
                                    <strong>IF:</strong>
                                </div>
                                <div class="col-md-7">
                                    {{ number_format($resultado->factor_intensidad_if, 2) }}
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Comentario -->
                    @if($resultado->comentario)
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <strong>Comentario:</strong>
                            <p class="text-muted mt-2">{{ $resultado->comentario }}</p>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Pie -->
                <div class="card-footer">
                    <a href="{{ route('resultados') }}" class="btn btn-secondary">Volver</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
