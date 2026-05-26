<?php
session_start();
require 'conexion.php';
require 'funciones.php';
verificar_sesion();

$clave = (int)post('clave_reserva');
$dir   = trim(post('dir'));

if (!$clave || !in_array($dir, array('siguiente', 'anterior'))) {
    header('Location: clave_reserva.php');
    exit;
}

if ($dir === 'siguiente') {
    $stmt = $pdo->prepare(
        'SELECT clave_reserva FROM reservas
         WHERE id_usuario=? AND clave_reserva > ?
         ORDER BY clave_reserva ASC LIMIT 1'
    );
} else {
    $stmt = $pdo->prepare(
        'SELECT clave_reserva FROM reservas
         WHERE id_usuario=? AND clave_reserva < ?
         ORDER BY clave_reserva DESC LIMIT 1'
    );
}
$stmt->execute(array($_SESSION['id_usuario'], $clave));
$siguiente = $stmt->fetchColumn();

if ($siguiente) {
    header('Location: record_reserva.php?clave=' . $siguiente);
} else {
    header('Location: record_reserva.php?clave=' . $clave . '&error=' . urlencode('No hay más registros'));
}
exit;
