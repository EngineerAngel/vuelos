<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Reservaciones - Registro de Usuario</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<center>
    <h1>SISTEMA DE RESERVACIONES DE VUELO</h1>
    <h2>Pantalla Registro de Usuario (P-3)</h2>

    <form action="proceso_registro_usuario.php" method="POST">
        Nombre: <input type="text" name="nombre">
        Apellido: <input type="text" name="apellido">
        <br><br>
        Calle: <input type="text" name="calle">
        Colonia: <input type="text" name="colonia">
        <br><br>
        Ciudad: <input type="text" name="ciudad">
        País: <input type="text" name="pais">
        <br><br>
        C.P.: <input type="text" name="cp">
        E-Mail: <input type="email" name="email">
        <br><br>
        Login: <input type="text" name="login">
        Password: <input type="password" name="password">
        <br><br>
        <button type="submit">Registrar</button>
        <a href="sistema_r_vuelo.php"><button type="button">Actualizar</button></a>
        <br><br>
        <a href="servicios.php"><button type="button">Servicios</button></a>
        <a href="index.php"><button type="button">Salir</button></a>
    </form>
</center>
</body>
</html>
