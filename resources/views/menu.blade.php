<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu-dinamico.css') }}">
    <title>Plataforma de Entrenamientos - Menú Dinámico</title>
</head>

<!-- SOLO UNO de estos -->
<body>
    <!-- Cabecera -->
    <div class="header">...</div>
    
    <!-- Contenedor principal -->
    <div class="container">
        <!-- Menú dinámico (SOLO ESTE) -->
        <nav id="menu-dinamico" style="border: 2px solid blue; padding: 10px;">
            <!-- JavaScript pondrá botones aquí -->
        </nav>
        
        <!-- Contenido dinámico -->
        <div id="contenido-dinamico" style="border: 2px solid green; padding: 10px;">
            Contenido aparecerá aquí
        </div>
    </div>
    
    <!-- Scripts AL FINAL -->
    <script src="{{ asset('js/menuDinamico.js') }}"></script>
</body>

</html>