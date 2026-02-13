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
                    <!-- Titulo -->
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">{{ $sesion->nombre }}</h4>
                        <small class="text-white-50">Plan: {{ $sesion->plan_nombre }}</small>
                    </div>

                    <!-- Contenido -->
                    <div class="card-body">
                        <!-- Resumen -->
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <p class="text-muted">Fecha</p>
                                <h5>{{ Carbon::parse($sesion->fecha)->format('d/m/Y') }}</h5>
                            </div>
                            <div class="col-md-4">
                                <p class="text-muted">Estado</p>
                                <h5>
                                    @if($sesion->completada)
                                        <span class="badge bg-success">Completada</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Pendiente</span>
                                    @endif
                                </h5>
                            </div>
                            <div class="col-md-4">
                                <p class="text-muted">Bloques</p>
                                <h5>{{ $bloques->count() }}</h5>
                            </div>
                        </div>

                        <!-- Descripcion -->
                        @if($sesion->descripcion)
                            <div class="alert alert-light border-start border-4 border-primary mb-4">
                                <strong>Descripción:</strong><br>
                                {{ $sesion->descripcion }}
                            </div>
                        @endif

                        <!-- Tabla bloques -->
                        @if($bloques->count() > 0)
                            <h5 class="mt-4 mb-3">Bloques de Entrenamiento</h5>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Orden</th>
                                            <th>Bloque</th>
                                            <th>Tipo</th>
                                            <th>Duración</th>
                                            <th>Repeticiones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($bloques as $bloque)
                                            <tr>
                                                <td>
                                                    <span class="badge bg-secondary">{{ $bloque->orden }}</span>
                                                </td>
                                                <td>{{ $bloque->nombre }}</td>
                                                <td>
                                                    @php
                                                        $tipoBadgeColors = [
                                                            'rodaje' => 'info',
                                                            'intervalos' => 'danger',
                                                            'fuerza' => 'warning',
                                                            'recuperacion' => 'success',
                                                            'test' => 'purple'
                                                        ];
                                                        $color = $tipoBadgeColors[$bloque->tipo] ?? 'secondary';
                                                    @endphp
                                                    <span class="badge bg-{{ $color }}">{{ ucfirst($bloque->tipo) }}</span>
                                                </td>
                                                <td>{{ $bloque->duracion_estimada ?? '-' }}</td>
                                                <td>{{ $bloque->repeticiones ?? 1 }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info">
                                No hay bloques de entrenamiento asociados a esta sesión.
                            </div>
                        @endif
                    </div>

                    <!-- Botones -->
                    <div class="card-footer bg-light">
                        <a href="{{ route('sesiones') }}" class="btn btn-secondary">← Volver</a>
                        <a href="{{ route('sesiones.edit', $sesion->id) }}" class="btn btn-primary">Editar</a>
                        <form action="{{ route('sesiones.destroy', $sesion->id) }}" method="POST" class="d-inline">
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