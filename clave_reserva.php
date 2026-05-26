<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Reservaciones - Clave de Reserva</title>
</head>
<body>
<center>
    <h1>SISTEMA DE RESERVACIONES DE VUELO</h1>
    <h3>Pantalla Clave Reserva (P-14)</h3>
    <p>Incerte la Clave de la Reserva si ya existe</p>

    <form action="proceso_obtener_reserva.php" method="POST">
        Clave: <input type="text" name="clave">
        <br><br>
        <button type="submit">Obtener</button>
        <a href="nueva_reserva.php"><button type="button">Crear</button></a>
        <br><br>
        <a href="servicios.php"><button type="button">Servicios</button></a>
    </form>
</center>
</body>
</html>