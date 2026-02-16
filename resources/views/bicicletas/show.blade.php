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
                    <h4 class="mb-0">{{ $bicicleta->nombre }}</h4>
                    <small class="text-white-50">bicicleta</small>
                </div>

                <!-- Contenido -->
                <div class="card-body">
                    <!-- Resumen bicicleta -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <p class="text-muted">Tipo</p>
                            <h5>{{ $bicicleta->tipo }}</h5>
                        </div>
                        <div class="col-md-4">
                            <p class="text-muted">Comentario</p>
                            <h5>{{ $bicicleta->comentario ?? '—' }}</h5>
                        </div>
                        <div class="col-md-4">
                            <p class="text-muted">ID</p>
                            <h5>{{ $bicicleta->id }}</h5>
                        </div>
                    </div>

                    <!-- Detalles adicionales -->
                    <div class="mb-3">
                        <strong>Detalles:</strong>
                        <p class="mb-0">Nombre: {{ $bicicleta->nombre }}</p>
                        <p class="mb-0">Tipo: {{ $bicicleta->tipo }}</p>
                        <p class="mb-0">Comentario: {{ $bicicleta->comentario ?? 'Sin comentario' }}</p>
                    </div>
                </div>

                <!-- Botones -->
                <div class="card-footer bg-light">
                    <a href="{{ route('bicicletas') }}" class="btn btn-secondary">← Volver</a>
                    <a href="{{ route('bicicletas.edit', $bicicleta->id) }}" class="btn btn-primary">Editar</a>
                    <form action="{{ route('bicicletas.destroy', $bicicleta->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection