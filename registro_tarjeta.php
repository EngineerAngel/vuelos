<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Reservaciones - Crear Registro Tarjeta</title>
</head>
<body>
<center>
    <h1>SISTEMA DE RESERVACIONES DE VUELO</h1>
    <h2>Pantalla Crear Registro Tarjeta (P-5)</h2>

    <form action="proceso_registro_tarjeta.php" method="POST">
        <br>
        Nombre: <input type="text" name="nombre_titular" size="40">
        <br><br>

        Numero de Tarjeta (requerido para pagos): <input type="text" name="num_tarjeta" size="30">
        <br><br>

        Tipo <input type="text" name="tipo">
        Fecha Vencimiento <input type="text" name="fecha_vencimiento">
        <br><br>

        <button type="submit">Registrar</button>
        <a href="servicios.php"><button type="button">Servicios</button></a>
        <a href="index.php"><button type="button">Salir</button></a>
    </form>
</center>
</body>
</html>
