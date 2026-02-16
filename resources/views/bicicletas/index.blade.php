@extends('layouts.app')

@php
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
                    <h4 class="mb-0">Mis Bicicletas</h4>
                    <a href="{{ route('bicicletas.create') }}" class="btn btn-light btn-sm">+ Nueva Bicicleta</a>
                </div>

                <!-- Tabla bicicletas -->
                @if($bicicletas->count() > 0)
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Tipo</th>
                                    <th>Comentario</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bicicletas as $bicicleta)
                                <tr>
                                    <td>
                                        <strong>{{ $bicicleta->nombre }}</strong>
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ ucfirst($bicicleta->tipo) }}</small>
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ $bicicleta->comentario ?? '-' }}</small>
                                    </td>
                                    <td>
                                        <a href="{{ route('bicicletas.show', $bicicleta->id) }}" class="btn btn-sm btn-outline-primary">Ver</a>
                                        <a href="{{ route('bicicletas.edit', $bicicleta->id) }}" class="btn btn-sm btn-outline-warning">Editar</a>
                                        <form action="{{ route('bicicletas.destroy', $bicicleta->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta bicicleta?')">Borrar</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @else
                <!-- Sin bicicletas -->
                <div class="card-body">
                    <div class="alert alert-info mb-0">
                        <p class="mb-2">No tienes bicicletas registradas aún.</p>
                        <a href="{{ route('bicicletas.create') }}" class="btn btn-info btn-sm">Crear una nueva bicicleta</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection