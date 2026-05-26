<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Reservaciones - Consulta Estado</title>
</head>
<body>
<center>
    <h1>SISTEMA DE RESERVACIONES DE VUELO</h1>
    <h2>Pantalla Consulta Estado (P-12)</h2>

    <form action="resultados_estado.php" method="GET">
        Origen (Ciudad o Código): <input type="text" name="origen">
        Destino (Ciudad o Código): <input type="text" name="destino">
        <br><br>

        <h3>PREFERENCIAS</h3>
        Aerolínea: <input type="text" name="aerolinea">
        Vuelo: <input type="text" name="vuelo">
        <br><br>
        Fecha Vuelo: <input type="date" name="fecha">
        <br><br>

        <button type="submit">Consultar</button>
        <a href="servicios.php"><button type="button">Servicios</button></a>
        <a href="index.php"><button type="button">Salir</button></a>
    </form>
</center>
</body>
</html>
