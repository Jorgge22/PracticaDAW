@extends('layouts.app')

@php
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
@endphp

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <!-- Tarjeta -->
                <div class="card shadow-sm">
                    <!-- Cabecera -->
                    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Mis Planes de Entrenamiento</h4>
                        <a href="{{ route('planes.create') }}" class="btn btn-light btn-sm">+ Nuevo Plan</a>
                    </div>

                    <!-- Tabla planes -->
                    @if($planes->count() > 0)
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Período</th>
                                            <th>Estado</th>
                                            <th>Duración</th>
                                            <th>Sesiones</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($planes as $plan)
                                            @php
                                                $inicio = Carbon::parse($plan->fecha_inicio);
                                                $fin = Carbon::parse($plan->fecha_fin);
                                                $sesiones = DB::table('sesion_entrenamiento')->where('id_plan', $plan->id)->count();
                                            @endphp
                                            <tr>
                                                <td>
                                                    <strong>{{ $plan->nombre }}</strong>
                                                </td>
                                                <td>
                                                    <small class="text-muted">
                                                        {{ $inicio->format('d/m/Y') }} - {{ $fin->format('d/m/Y') }}
                                                    </small>
                                                </td>
                                                <td>
                                                    @if($plan->activo)
                                                        <span class="badge bg-success">Activo</span>
                                                    @else
                                                        <span class="badge bg-secondary">Inactivo</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <small class="text-muted">{{ $inicio->diffInWeeks($fin) }} semanas</small>
                                                </td>
                                                <td>
                                                    <strong>{{ $sesiones }}</strong>
                                                </td>
                                                <td>
                                                    <a href="{{ route('planes.show', $plan->id) }}"
                                                        class="btn btn-sm btn-outline-primary">Ver</a>
                                                    <a href="{{ route('planes.edit', $plan->id) }}"
                                                        class="btn btn-sm btn-outline-warning">Editar</a>
                                                    <form action="{{ route('planes.destroy', $plan->id) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger"
                                                            onclick="return confirm('¿Estás seguro de que deseas eliminar este plan?')">Borrar</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <!-- Sin planes -->
                        <div class="card-body">
                            <div class="alert alert-info mb-0">
                                <p class="mb-2">No tienes planes de entrenamiento creados aún.</p>
                                <a href="{{ route('planes.create') }}" class="btn btn-info btn-sm">Crear un nuevo plan</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection