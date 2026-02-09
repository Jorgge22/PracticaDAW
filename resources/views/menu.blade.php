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
                <p>Selecciona un menú o submenú para ver sus datos.</p>
                <p>Los menús se cargan dinámicamente desde la base de datos basándose en tus planes, sesiones, bloques y bicicletas registradas.</p>
                
                <h3>Estructura disponible:</h3>
                <ul>
                    <li><strong>Mis Planes:</strong> Accede a todos tus planes de entrenamiento personalizados</li>
                    <li><strong>Mis Sesiones:</strong> Ve las sesiones de entrenamiento dentro de tus planes</li>
                    <li><strong>Bloques:</strong> Visualiza todos los bloques de entrenamiento disponibles</li>
                    <li><strong>Mis Bicicletas:</strong> Gestiona tus bicicletas y componentes</li>
                    <li><strong>Resultados:</strong> Consulta y registra resultados de entrenamientos</li>
                    <li><strong>Perfil:</strong> Edita tu información personal</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/menu-dinamico.js') }}"></script>

</body>
</html>