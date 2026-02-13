@extends('layouts.app')

@php
    use Carbon\Carbon;
@endphp

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <!-- Tarjeta -->
                <div class="card shadow-sm">
                    <!-- Cabecera -->
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">{{ $plan->nombre }}</h4>
                        @if($plan->activo)
                            <small class="text-white-50">Plan activo</small>
                        @else
                            <small class="text-white-50">Plan inactivo</small>
                        @endif
                    </div>

                    <!-- Contenido -->
                    <div class="card-body">
                        <!-- Resumen -->
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <p class="text-muted">Inicio</p>
                                <h5>{{ Carbon::parse($plan->fecha_inicio)->format('d/m/Y') }}</h5>
                            </div>
                            <div class="col-md-3">
                                <p class="text-muted">Fin</p>
                                <h5>{{ Carbon::parse($plan->fecha_fin)->format('d/m/Y') }}</h5>
                            </div>
                            <div class="col-md-3">
                                <p class="text-muted">Duración</p>
                                <h5>{{ Carbon::parse($plan->fecha_inicio)->diffInWeeks(Carbon::parse($plan->fecha_fin)) }}
                                    semanas</h5>
                            </div>
                            <div class="col-md-3">
                                <p class="text-muted">Sesiones</p>
                                <h5>{{ $sesiones->count() }}</h5>
                            </div>
                        </div>

                        <!-- Objetivo -->
                        @if($plan->objetivo)
                            <div class="alert alert-light border-start border-4 border-success mb-4">
                                <strong>Objetivo:</strong><br>
                                {{ $plan->objetivo }}
                            </div>
                        @endif

                        <!-- Descripcion -->
                        @if($plan->descripcion)
                            <div class="alert alert-light border-start border-4 border-info mb-4">
                                <strong>Descripción:</strong><br>
                                {{ $plan->descripcion }}
                            </div>
                        @endif

                        <!-- Tabla sesiones -->
                        @if(count($sesiones) > 0)
                            <h5 class="mt-4 mb-3">Sesiones de Entrenamiento</h5>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Sesión</th>
                                            <th>Estado</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sesiones as $sesion)
                                            <tr>
                                                <td>{{ Carbon::parse($sesion->fecha)->format('d/m/Y') }}</td>
                                                <td>{{ $sesion->nombre }}</td>
                                                <td>
                                                    @if($sesion->completada)
                                                        <span class="badge bg-success">Completada</span>
                                                    @else
                                                        <span class="badge bg-warning text-dark">Pendiente</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('sesiones.show', $sesion->id) }}"
                                                        class="btn btn-sm btn-outline-primary">Ver</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info">
                                Este plan no tiene sesiones de entrenamiento asignadas aún.
                            </div>
                        @endif
                    </div>

                    <!-- Botones -->
                    <div class="card-footer bg-light">
                        <a href="{{ route('planes') }}" class="btn btn-secondary">← Volver</a>
                        <a href="{{ route('planes.edit', $plan->id) }}" class="btn btn-primary">Editar</a>
                        <a href="{{ route('sesiones.create') }}" class="btn btn-success">+ Nueva Sesión</a>
                        <form action="{{ route('planes.destroy', $plan->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection