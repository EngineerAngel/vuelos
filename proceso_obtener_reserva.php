<?php
session_start();
require 'conexion.php';
require 'funciones.php';
verificar_sesion();

$clave = trim(post('clave_reserva'));

if (empty($clave) || !is_numeric($clave)) {
    redirigir_con_error('clave_reserva.php', 'Ingrese una clave de reserva válida');
}

$stmt = $pdo->prepare(
    'SELECT clave_reserva FROM reservas WHERE clave_reserva = ? AND id_usuario = ?'
);
$stmt->execute(array((int)$clave, $_SESSION['id_usuario']));

if (!$stmt->fetch()) {
    redirigir_con_error('clave_reserva.php', 'La clave no existe o no le pertenece');
}

header('Location: record_reserva.php?clave=' . (int)$clave);
exit;
