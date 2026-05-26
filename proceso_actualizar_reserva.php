<?php
session_start();
require 'conexion.php';
require 'funciones.php';
verificar_sesion();

$clave = (int)post('clave_reserva');

if (!$clave) {
    redirigir_con_error('clave_reserva.php', 'Clave de reserva inválida');
}

$stmt = $pdo->prepare(
    'UPDATE reservas SET
     apellido=?, nombre=?, viajero_frecuente=?, aerolinea=?, num_vuelo=?,
     origen=?, destino=?, fecha=?, hora_salida=?, hora_llegada=?,
     asiento=?, tipo_asiento=?, clase=?, num_comida=?, tipo_comida=?,
     tarifa=?, status=?, limite=?
     WHERE clave_reserva=? AND id_usuario=?'
);
$stmt->execute(array(
    trim(post('apellido')),
    trim(post('nombre')),
    trim(post('viajero_frecuente')),
    trim(post('aerolinea')),
    trim(post('vuelo')),
    trim(post('origen')),
    trim(post('destino')),
    trim(post('fecha')) ?: null,
    trim(post('hora_salida')) ?: null,
    trim(post('hora_llegada')) ?: null,
    trim(post('asiento')),
    trim(post('tipo_asiento')),
    trim(post('clase')),
    (int)post('num_comida'),
    trim(post('tipo_comida')),
    trim(post('tarifa')) ?: null,
    trim(post('status')),
    (int)post('limite'),
    $clave,
    $_SESSION['id_usuario']
));

header('Location: record_reserva.php?clave=' . $clave);
exit;
