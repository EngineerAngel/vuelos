<?php
session_start();
require 'conexion.php';
require 'funciones.php';
verificar_sesion();

$clave             = (int)post('clave_reserva');
$nombre            = trim(post('nombre'));
$num_tarjeta       = trim(post('num_tarjeta'));
$tipo              = trim(post('tipo'));
$fecha_vencimiento = trim(post('fecha_vencimiento'));
$tarifa            = trim(post('tarifa'));

if (!$clave || empty($nombre) || empty($num_tarjeta)) {
    redirigir_con_error('reembolsar.php', 'Todos los campos son requeridos');
}

$stmt = $pdo->prepare(
    'SELECT estado_pago FROM reservas WHERE clave_reserva=? AND id_usuario=?'
);
$stmt->execute(array($clave, $_SESSION['id_usuario']));
$reserva = $stmt->fetch();

if (!$reserva || $reserva['estado_pago'] !== 'pagado') {
    redirigir_con_error('reembolsar.php', 'La reserva no está en estado pagado');
}

$stmt = $pdo->prepare(
    'SELECT id_tarjeta FROM tarjetas WHERE id_usuario=? AND num_tarjeta=? LIMIT 1'
);
$stmt->execute(array($_SESSION['id_usuario'], $num_tarjeta));
$id_tarjeta = $stmt->fetchColumn() ?: null;

$stmt = $pdo->prepare(
    'INSERT INTO pagos (clave_reserva, id_tarjeta, nombre_titular, num_tarjeta, tipo, fecha_vencimiento, tarifa, tipo_operacion)
     VALUES (?, ?, ?, ?, ?, ?, ?, "reembolso")'
);
$stmt->execute(array($clave, $id_tarjeta, $nombre, $num_tarjeta, $tipo, $fecha_vencimiento, $tarifa ?: null));

$stmt = $pdo->prepare(
    'UPDATE reservas SET estado_pago="reembolsado" WHERE clave_reserva=? AND id_usuario=?'
);
$stmt->execute(array($clave, $_SESSION['id_usuario']));

header('Location: record_reserva.php?clave=' . $clave);
exit;
