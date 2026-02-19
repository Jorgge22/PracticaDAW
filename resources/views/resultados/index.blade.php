@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <!-- Tarjeta -->
            <div class="card shadow-sm">
                <!-- Cabecera -->
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Mis Entrenamientos</h4>
                    <a href="{{ route('resultados.create') }}" class="btn btn-light btn-sm">+ Nuevo Entrenamiento</a>
                </div>

                <!-- Tabla resultados -->
                @if($resultados->count() > 0)
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Fecha</th>
                                    <th>Duración</th>
                                    <th>Distancia</th>
                                    <th>Velocidad Media</th>
                                    <th>Pulso Medio</th>
                                    <th>Potencia Media</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($resultados as $resultado)
                                <tr>
                                    <td>
                                        <strong>{{ \Carbon\Carbon::parse($resultado->fecha)->format('d/m/Y') }}</strong>
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ $resultado->duracion ? $resultado->duracion . ' min' : '-' }}</small>
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ $resultado->kilometros ? $resultado->kilometros . ' km' : '-' }}</small>
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ $resultado->velocidad_media ? number_format($resultado->velocidad_media, 2) . ' km/h' : '-' }}</small>
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ $resultado->pulso_medio ?? '-' }} bpm</small>
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ $resultado->potencia_media ? $resultado->potencia_media . ' w' : '-' }}</small>
                                    </td>
                                    <td>
                                        <a href="{{ route('resultados.show', $resultado->id) }}" class="btn btn-sm btn-outline-primary">Ver</a>
                                        <a href="{{ route('resultados.edit', $resultado->id) }}" class="btn btn-sm btn-outline-warning">Editar</a>
                                        <form action="{{ route('resultados.destroy', $resultado->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este entrenamiento?')">Borrar</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @else
                <!-- Sin entrenamientos -->
                <div class="card-body">
                    <div class="alert alert-info mb-0">
                        <p class="mb-2">No tienes entrenamientos registrados aún.</p>
                        <a href="{{ route('resultados.create') }}" class="btn btn-info btn-sm">Registrar un nuevo entrenamiento</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
