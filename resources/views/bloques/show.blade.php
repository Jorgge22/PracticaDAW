@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Tarjeta -->
            <div class="card shadow-sm">
                <!-- Cabecera -->
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">{{ $bloque->nombre }}</h4>
                    <div>
                        <a href="{{ route('bloques.edit', $bloque->id) }}" class="btn btn-light btn-sm">Editar</a>
                        <form action="{{ route('bloques.destroy', $bloque->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                        </form>
                    </div>
                </div>

                <!-- Contenido -->
                <div class="card-body">
                    <!-- Tipo -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Tipo:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $bloque->tipo ?? '-' }}
                        </div>
                    </div>

                    <!-- Descripción -->
                    @if($bloque->descripcion)
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Descripción:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $bloque->descripcion }}
                        </div>
                    </div>
                    @endif

                    <!-- Duración Estimada -->
                    @if($bloque->duracion_estimada)
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Duración Estimada:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $bloque->duracion_estimada }} minutos
                        </div>
                    </div>
                    @endif

                    <!-- Potencia -->
                    @if($bloque->potencia_pct_min || $bloque->potencia_pct_max)
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Potencia %:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $bloque->potencia_pct_min ?? '-' }} - {{ $bloque->potencia_pct_max ?? '-' }}%
                        </div>
                    </div>
                    @endif

                    <!-- Pulso % Máximo -->
                    @if($bloque->pulso_pct_max)
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Pulso % Máximo:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $bloque->pulso_pct_max }}%
                        </div>
                    </div>
                    @endif

                    <!-- Pulso Reserva % -->
                    @if($bloque->pulso_reserva_pct)
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Pulso Reserva %:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $bloque->pulso_reserva_pct }}%
                        </div>
                    </div>
                    @endif

                    <!-- Comentario -->
                    @if($bloque->comentario)
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Comentario:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $bloque->comentario }}
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Pie -->
                <div class="card-footer">
                    <a href="{{ route('bloques') }}" class="btn btn-secondary">Volver</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
