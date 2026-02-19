@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <!-- Tarjeta -->
            <div class="card shadow-sm">
                <!-- Cabecera -->
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Bloques de Entrenamiento</h4>
                    <a href="{{ route('bloques.create') }}" class="btn btn-light btn-sm">+ Nuevo Bloque</a>
                </div>

                <!-- Tabla bloques -->
                @if($bloques->count() > 0)
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Tipo</th>
                                    <th>Duración Est.</th>
                                    <th>Potencia %</th>
                                    <th>Pulso %</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bloques as $bloque)
                                <tr>
                                    <td>
                                        <strong>{{ $bloque->nombre }}</strong>
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ ucfirst($bloque->tipo) }}</small>
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ $bloque->duracion_estimada ? $bloque->duracion_estimada . ' min' : '-' }}</small>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            {{ $bloque->potencia_pct_min ?? '-' }}-{{ $bloque->potencia_pct_max ?? '-' }}%
                                        </small>
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ $bloque->pulso_pct_max ?? '-' }}%</small>
                                    </td>
                                    <td>
                                        <a href="{{ route('bloques.show', $bloque->id) }}" class="btn btn-sm btn-outline-primary">Ver</a>
                                        <a href="{{ route('bloques.edit', $bloque->id) }}" class="btn btn-sm btn-outline-warning">Editar</a>
                                        <form action="{{ route('bloques.destroy', $bloque->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este bloque?')">Borrar</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @else
                <!-- Sin bloques -->
                <div class="card-body">
                    <div class="alert alert-info mb-0">
                        <p class="mb-2">No hay bloques de entrenamiento registrados aún.</p>
                        <a href="{{ route('bloques.create') }}" class="btn btn-info btn-sm">Crear un nuevo bloque</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
