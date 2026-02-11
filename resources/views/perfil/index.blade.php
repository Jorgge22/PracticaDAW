@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Mi Perfil') }}</div>

                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Nombre:</th>
                            <td>{{ $usuario->nombre }}</td>
                        </tr>
                        <tr>
                            <th>Apellidos:</th>
                            <td>{{ $usuario->apellidos }}</td>
                        </tr>
                        <tr>
                            <th>Fecha de Nacimiento:</th>
                            <td>{{ $usuario->fecha_nacimiento }}</td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td>{{ $usuario->email }}</td>
                        </tr>
                        <tr>
                            <th>Peso Base:</th>
                            <td>{{ $usuario->peso_base ?? 'Sin registrar' }} kg</td>
                        </tr>
                        <tr>
                            <th>Altura Base:</th>
                            <td>{{ $usuario->altura_base ?? 'Sin registrar' }} cm</td>
                        </tr>
                    </table>

                    <a href="{{ url('/home') }}" class="btn btn-primary">{{ __('Volver al Inicio') }}</a>
                    <a href="{{ url('/edit') }}" class="btn btn-primary">{{ __('Editar perfil') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
