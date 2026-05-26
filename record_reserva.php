<?php
session_start();
require 'conexion.php';
require 'funciones.php';
verificar_sesion();

$clave   = (int)get_param('clave');
$error   = htmlspecialchars(get_param('error'));
$reserva = array();

if ($clave) {
    $stmt = $pdo->prepare('SELECT * FROM reservas WHERE clave_reserva=? AND id_usuario=?');
    $stmt->execute(array($clave, $_SESSION['id_usuario']));
    $reserva = $stmt->fetch() ?: array();
}

function val($key) {
    global $reserva;
    return htmlspecialchars(isset($reserva[$key]) ? $reserva[$key] : '');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Reservaciones - Record Reserva</title>
</head>
<body>
<center>
    <h1>SISTEMA DE RESERVACIONES DE VUELO</h1>
    <h2>Pantalla Record Reserva (P-16)</h2>
    <?php if ($error): ?><p><b><?= $error ?></b></p><?php endif; ?>

    <form action="proceso_actualizar_reserva.php" method="POST">
        <input type="hidden" name="clave_reserva" value="<?= $clave ?>">

        Apellido: <input type="text" name="apellido" value="<?= val('apellido') ?>">
        Nombre: <input type="text" name="nombre" value="<?= val('nombre') ?>">
        <br><br>

        Clave: <input type="text" name="clave_reserva_display" value="<?= val('clave_reserva') ?>" readonly>
        Numero de Viajero Frecuente: <input type="text" name="viajero_frecuente" value="<?= val('viajero_frecuente') ?>">
        <br><br>

        Aerolínea: <input type="text" name="aerolinea" value="<?= val('aerolinea') ?>">
        Vuelo: <input type="text" name="vuelo" value="<?= val('num_vuelo') ?>">
        Límite: <input type="text" name="limite" value="<?= val('limite') ?>">
        <br><br>

        Sale de: <input type="text" name="origen" value="<?= val('origen') ?>">
        Llega a: <input type="text" name="destino" value="<?= val('destino') ?>">
        Status: <input type="text" name="status" value="<?= val('status') ?>">
        <br><br>

        Fecha: <input type="date" name="fecha" value="<?= val('fecha') ?>">
        Hora Salida: <input type="time" name="hora_salida" value="<?= val('hora_salida') ?>">
        Hora Llegada: <input type="time" name="hora_llegada" value="<?= val('hora_llegada') ?>">
        <br><br>

        Asiento: <input type="text" name="asiento" value="<?= val('asiento') ?>">
        No. Comida: <input type="text" name="num_comida" value="<?= val('num_comida') ?>">
        Comida: <input type="text" name="tipo_comida" value="<?= val('tipo_comida') ?>">
        <br><br>

        Clase: <input type="text" name="clase" value="<?= val('clase') ?>">
        Tarifa: <input type="text" name="tarifa" value="<?= val('tarifa') ?>">
        Estado de Pago: <input type="text" name="estado_pago" value="<?= val('estado_pago') ?>" readonly>
        <br><br>

        <button type="submit" formaction="proceso_eliminar_reserva.php">Eliminar</button>
        <button type="submit">Actualizar</button>
        <button type="submit" formaction="proceso_navegar_reserva.php" name="dir" value="siguiente">+</button>
        <button type="submit" formaction="proceso_navegar_reserva.php" name="dir" value="anterior">-</button>
        <br><br>

        <a href="clave_reserva.php"><button type="button">Nueva Reserva</button></a>
        <a href="pago.php?clave=<?= $clave ?>"><button type="button">Pagar</button></a>
        <a href="reembolsar.php?clave=<?= $clave ?>"><button type="button">Reembolsar</button></a>
        <a href="servicios.php"><button type="button">Servicios</button></a>
        <a href="index.php"><button type="button">Salir</button></a>
    </form>
</center>
</body>
</html>
