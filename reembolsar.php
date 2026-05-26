<?php
session_start();
require 'conexion.php';
require 'funciones.php';
verificar_sesion();

$clave = (int)get_param('clave');
$error = htmlspecialchars(get_param('error'));

$tarjeta = array();
$tarifa  = '';

if ($clave) {
    $stmt = $pdo->prepare('SELECT tarifa FROM reservas WHERE clave_reserva=? AND id_usuario=?');
    $stmt->execute(array($clave, $_SESSION['id_usuario']));
    $res = $stmt->fetch();
    if ($res) {
        $tarifa = $res['tarifa'];
    }

    $stmt = $pdo->prepare('SELECT nombre_titular, num_tarjeta, tipo, fecha_vencimiento FROM tarjetas WHERE id_usuario=? LIMIT 1');
    $stmt->execute(array($_SESSION['id_usuario']));
    $tarjeta = $stmt->fetch() ?: array();
}

function vt($key) {
    global $tarjeta;
    return htmlspecialchars(isset($tarjeta[$key]) ? $tarjeta[$key] : '');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Reservaciones - Reembolsar Tarjeta</title>
</head>
<body>
<center>
    <h1>SISTEMA DE RESERVACIONES DE VUELO</h1>
    <h2>Pantalla Reembolsar Tarjeta (P-18)</h2>
    <?php if ($error): ?><p><b><?= $error ?></b></p><?php endif; ?>

    <form action="proceso_reembolso.php" method="POST">
        <input type="hidden" name="clave_reserva" value="<?= $clave ?>">
        <br>
        Nombre: <input type="text" name="nombre" size="40" value="<?= vt('nombre_titular') ?>">
        <br><br>

        Numero de Tarjeta (requerido para pagos): <input type="text" name="num_tarjeta" size="30" value="<?= vt('num_tarjeta') ?>">
        <br><br>

        Tipo <input type="text" name="tipo" value="<?= vt('tipo') ?>">
        Fecha Vencimiento <input type="text" name="fecha_vencimiento" value="<?= vt('fecha_vencimiento') ?>">
        <br><br>

        Tarifa: <input type="text" name="tarifa" size="40" value="<?= htmlspecialchars($tarifa) ?>">
        <br><br>

        <button type="submit">Reembolsar</button>
        <a href="servicios.php"><button type="button">Servicios</button></a>
        <a href="index.php"><button type="button">Salir</button></a>
    </form>
</center>
</body>
</html>
