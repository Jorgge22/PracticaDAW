<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plataforma de Entrenamientos - Menú Dinámico</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu-dinamico.css') }}">
</head>
<body>

    <!-- Cabecera -->
    <div class="header">
        <div>
            <h1>Plataforma de Entrenamientos</h1>
            <p style="margin: 5px 0 0 0; font-size: 14px; color: #bdc3c7;">Sistema integrado de gestión de entrenamientos deportivos</p>
        </div>
        <form action="{{ route('login.cerrar') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">Cerrar Sesión</button>
        </form>
    </div>

    <!-- Contenido principal -->
    <div class="container">
        <!-- Menú dinámico -->
        <div id="menu-container"></div>
        <div id="user-info"></div>

        <!-- Contenido -->
        <div id="content-container">
            <div class="contenido-menu">
                <h2>Bienvenido</h2>
                
                <h3>Mis Planes</h3>
                @if ($planes->count() > 0) 
                    @foreach ($planes as $plan)
                        <p>{{ $plan->nombre }} - {{ $plan->objetivo }}</p>
                    @endforeach
                @else 
                    <p>No tienes planes</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/menu-dinamico.js') }}"></script>

</body>
</html>