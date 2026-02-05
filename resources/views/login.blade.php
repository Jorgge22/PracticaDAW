<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <h1>Inicio de sesión</h1>
        <form action={{ route('login.submit') }} method="post">
            @csrf
            <input type="text" name="nombre" placeholder="Introduce tu usuario" required><br><br>
            <input type="password" name="contraseña" placeholder="Contraseña" required><br><br>
            <input type="submit" value="Iniciar sesión">
        </form>
    </div>
</body>

</html>