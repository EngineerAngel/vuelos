<?php
session_start();
require 'conexion.php';
require 'funciones.php';
verificar_sesion();

$apellido          = trim(post('apellido'));
$nombre            = trim(post('nombre'));
$viajero_frecuente = trim(post('viajero_frecuente'));
$aerolinea         = trim(post('aerolinea'));
$vuelo             = trim(post('vuelo'));
$origen            = trim(post('origen'));
$destino           = trim(post('destino'));
$fecha             = trim(post('fecha'));
$clase             = trim(post('clase'));
$tipo_asiento      = trim(post('tipo_asiento'));
$tipo_comida       = trim(post('tipo_comida'));

if (empty($apellido) || empty($nombre) || empty($origen) || empty($destino) || empty($fecha)) {
    redirigir_con_error('nueva_reserva.php', 'Apellido, nombre, origen, destino y fecha son requeridos');
}

$stmt = $pdo->prepare(
    'INSERT INTO reservas
     (id_usuario, apellido, nombre, viajero_frecuente, aerolinea, num_vuelo,
      origen, destino, fecha, clase, tipo_asiento, tipo_comida)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
);
$stmt->execute(array(
    $_SESSION['id_usuario'], $apellido, $nombre, $viajero_frecuente,
    $aerolinea, $vuelo, $origen, $destino, $fecha, $clase, $tipo_asiento, $tipo_comida
));

$clave = $pdo->lastInsertId();
header('Location: record_reserva.php?clave=' . $clave);
exit;
