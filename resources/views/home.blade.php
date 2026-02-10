@extends('layouts.app')
<script src="{{ asset('js/menuDinamico.js') }}"></script>
@section('content')
<!-- Cabecera -->
<div class="header">...</div>

<!-- Contenedor principal -->
<div class="container">
    <!-- Menú dinámico -->
    <nav id="menu-dinamico" style="border: 2px solid blue; padding: 10px;">

    </nav>

    <!-- Contenido dinámico -->
    <div id="contenido-dinamico" style="border: 2px solid green; padding: 10px;">

    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection