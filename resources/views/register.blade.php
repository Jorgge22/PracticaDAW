<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <div class="container">
        <h1>Registro de ciclista</h1>

        <form action="{{ route('register.submit') }}" method="post">
            @csrf
            <input type="text" name="nombre" placeholder="Nombre" required><br><br>
            <input type="text" name="apellidos" placeholder="Apellidos" required><br><br>
            <input type="date" name="fecha_nacimiento" required><br><br>
            <input type="email" name="email" placeholder="Email" required><br><br>
            <input type="password" name="password" placeholder="Contraseña" required><br><br>
            <input type="submit" value="Registrarse">
        </form>
        <button type="button"><a href="{{ route('login.form') }}">Volver al login</a></button>
    </div>
</body>
</html>