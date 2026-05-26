<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Reservaciones - Consulta Horarios</title>
</head>
<body>
<center>
    <h1>SISTEMA DE RESERVACIONES DE VUELO</h1>
    <h2>Pantalla Consulta Horarios (P-8)</h2>

    <form action="resultados_horarios.php" method="GET">
        Origen (Ciudad o Código): <input type="text" name="origen">
        Destino (Ciudad o Código): <input type="text" name="destino">
        <br><br>

        <h3>PREFERENCIAS</h3>
        Fecha de Salida: <input type="date" name="fecha_salida">
        Fecha de Regreso: <input type="date" name="fecha_regreso">
        <br><br>

        Aerolínea: <input type="text" name="aerolinea">
        Horario: <input type="text" name="horario">
        <br><br>

        <input type="checkbox" name="menor_tarifa"> Menor Tarifa
        <input type="checkbox" name="directo"> Solo Directo
        <input type="checkbox" name="redondo"> Redondo
        <br><br>

        <button type="submit">Consultar</button>
        <a href="servicios.php"><button type="button">Servicios</button></a>
        <a href="index.php"><button type="button">Salir</button></a>
    </form>
</center>
</body>
</html>
