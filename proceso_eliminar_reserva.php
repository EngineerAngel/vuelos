<?php
session_start();
require 'conexion.php';
require 'funciones.php';
verificar_sesion();

$clave = (int)post('clave_reserva');

if (!$clave) {
    redirigir_con_error('clave_reserva.php', 'Clave de reserva inválida');
}

$stmt = $pdo->prepare('DELETE FROM reservas WHERE clave_reserva = ? AND id_usuario = ?');
$stmt->execute(array($clave, $_SESSION['id_usuario']));

header('Location: clave_reserva.php');
exit;
