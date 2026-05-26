<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Reservaciones - Crear Reserva</title>
</head>
<body>
<center>
    <h1>SISTEMA DE RESERVACIONES DE VUELO</h1>
    <h2>Pantalla Crear Reserva (P-15)</h2>

    <form action="proceso_nueva_reserva.php" method="POST">
        Apellido: <input type="text" name="apellido">
        Nombre: <input type="text" name="nombre">
        <br><br>

        Numero de Viajero Frecuente: <input type="text" name="viajero_frecuente">
        <br><br>

        Aerolínea: <input type="text" name="aerolinea">
        Vuelo: <input type="text" name="vuelo">
        <br><br>

        Sale de: <input type="text" name="origen">
        Llega a: <input type="text" name="destino">
        <br><br>

        <input type="checkbox" name="solicitar_asiento"> Solicitar Asiento
        Fecha: <input type="date" name="fecha">
        Clase: <input type="text" name="clase">
        <br><br>

        Asiento:
        <input type="radio" name="tipo_asiento" value="ventana"> Ventana
        <input type="radio" name="tipo_asiento" value="pasillo"> Pasillo
        &nbsp;&nbsp;
        Comida:
        <input type="radio" name="tipo_comida" value="veg"> Veg.
        <input type="radio" name="tipo_comida" value="carne"> Carne
        <br><br>

        <button type="button">Agregar</button>
        <button type="reset">Borrar</button>
        <button type="button">+</button>
        <button type="button">-</button>
        <br><br>

        <button type="submit">Reservar</button>
        <a href="servicios.php"><button type="button">Servicios</button></a>
        <a href="index.php"><button type="button">Salir</button></a>
    </form>
</center>
</body>
</html>
