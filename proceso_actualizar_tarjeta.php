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
    redirigir_con_error('obtener_registro_tarjeta.php', 'Nombre y número de tarjeta son requeridos');
}
if (!validar_tarjeta($num_tarjeta)) {
    redirigir_con_error('obtener_registro_tarjeta.php', 'El número de tarjeta debe tener 16 dígitos');
}
if (!empty($fecha_vencimiento) && !validar_fecha_vencimiento($fecha_vencimiento)) {
    redirigir_con_error('obtener_registro_tarjeta.php', 'Fecha de vencimiento inválida o expirada (formato MM/AAAA)');
}

$stmt = $pdo->prepare(
    'UPDATE tarjetas SET nombre_titular=?, num_tarjeta=?, tipo=?, fecha_vencimiento=?
     WHERE id_usuario=?'
);
$stmt->execute(array($nombre_titular, $num_tarjeta, $tipo, $fecha_vencimiento, $_SESSION['id_usuario']));

header('Location: sistema_r_vuelo.php');
exit;
