<?php
session_start();
require 'conexion.php';
require 'funciones.php';
verificar_sesion();

$nombre_titular    = trim(post('nombre_titular'));
$num_tarjeta       = trim(post('num_tarjeta'));
$tipo              = trim(post('tipo'));
$fecha_vencimiento = trim(post('fecha_vencimiento'));

if (empty($nombre_titular) || empty($num_tarjeta)) {
    redirigir_con_error('registro_tarjeta.php', 'Nombre y numero de tarjeta son requeridos');
}
if (!validar_tarjeta($num_tarjeta)) {
    redirigir_con_error('registro_tarjeta.php', 'El numero de tarjeta debe tener exactamente 16 digitos');
}
if (!empty($fecha_vencimiento) && !validar_fecha_vencimiento($fecha_vencimiento)) {
    redirigir_con_error('registro_tarjeta.php', 'Fecha de vencimiento invalida o expirada (formato MM/AAAA)');
}

$stmt = $pdo->prepare(
    'INSERT INTO tarjetas (id_usuario, nombre_titular, num_tarjeta, tipo, fecha_vencimiento)
     VALUES (?, ?, ?, ?, ?)'
);
$stmt->execute(array($_SESSION['id_usuario'], $nombre_titular, $num_tarjeta, $tipo, $fecha_vencimiento));

header('Location: obtener_registro_tarjeta.php');
exit;
