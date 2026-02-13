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
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Mis Sesiones de Entrenamiento</h4>
                        <a href="{{ route('sesiones.create') }}" class="btn btn-light btn-sm">+ Nueva Sesión</a>
                    </div>

                    <!-- Tabla sesiones -->
                    @if($sesiones->count() > 0)
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Sesión</th>
                                            <th>Plan</th>
                                            <th>Estado</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sesiones as $sesion)
                                            <tr>
                                                <td>
                                                    <strong>{{ Carbon::parse($sesion->fecha)->format('d/m/Y') }}</strong>
                                                </td>
                                                <td>
                                                    {{ $sesion->nombre }}
                                                </td>
                                                <td>
                                                    <small class="text-muted">{{ $sesion->plan_nombre }}</small>
                                                </td>
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
                                                    <a href="{{ route('sesiones.edit', $sesion->id) }}"
                                                        class="btn btn-sm btn-outline-warning">Editar</a>
                                                    <form action="{{ route('sesiones.destroy', $sesion->id) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                                            onclick="return confirm('¿Estás seguro de que deseas eliminar esta sesión?')">Borrar</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <!-- Sin sesiones -->
                        <div class="card-body">
                            <div class="alert alert-info mb-0">
                                <p class="mb-2">No tienes sesiones de entrenamiento creadas aún.</p>
                                <a href="{{ route('sesiones.create') }}" class="btn btn-info btn-sm">Crear una nueva sesión</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection