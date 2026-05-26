<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Reservaciones - Actualizar Registro</title>
</head>
<body>
<center>
    <h1>SISTEMA DE RESERVACIONES DE VUELO</h1>
    <h2>Pantalla Actualizar Registro (P-4a)</h2>
    <p>Los datos del registro de usuario han sido actualizados.</p>

    <form action="servicios.php" method="POST">
        Login: <input type="text" name="login" readonly>
        <br><br>
        Nombre: <input type="text" name="nombre" readonly>
        Apellidos: <input type="text" name="apellido" readonly>
        <br><br>
        E-Mail: <input type="email" name="email" readonly>
        <br><br>
        Estatus: <input type="text" name="estatus" readonly value="Actualizado">
        <br><br>

        <button type="submit">Aceptar</button>
        <a href="sistema_r_vuelo.php"><button type="button">Modificar</button></a>
        <a href="registro_tarjeta.php"><button type="button">Registrar Tarjeta</button></a>
        <br><br>
        <a href="servicios.php"><button type="button">Servicios</button></a>
        <a href="index.php"><button type="button">Salir</button></a>
    </form>
</center>
</body>
</html>
