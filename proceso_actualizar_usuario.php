<?php
session_start();
require 'conexion.php';
require 'funciones.php';
verificar_sesion();

$nombre   = trim(post('nombre'));
$apellido = trim(post('apellido'));
$email    = trim(post('email'));

if (empty($nombre) || empty($apellido) || empty($email)) {
    redirigir_con_error('sistema_r_vuelo.php', 'Nombre, apellido y email son requeridos');
}
if (!validar_email($email)) {
    redirigir_con_error('sistema_r_vuelo.php', 'El email no tiene un formato valido');
}

$password = trim(post('password'));
$repetir  = trim(post('repetir_password'));
$hash     = null;

if (!empty($password)) {
    if ($password !== $repetir) {
        redirigir_con_error('sistema_r_vuelo.php', 'Las contrasenas no coinciden');
    }
}

$campos = array(
    $nombre, $apellido,
    trim(post('calle')),
    trim(post('colonia')),
    trim(post('ciudad')),
    trim(post('pais')),
    trim(post('cp')),
    trim(post('tel_casa')),
    trim(post('tel_oficina')),
    trim(post('fax')),
    $email
);

if (!empty($password)) {
    $campos[] = $password;
    $campos[] = $_SESSION['id_usuario'];
    $stmt = $pdo->prepare(
        'UPDATE usuarios SET nombre=?, apellido=?, calle=?, colonia=?, ciudad=?, pais=?, cp=?,
         tel_casa=?, tel_oficina=?, fax=?, email=?, password=? WHERE id_usuario=?'
    );
} else {
    $campos[] = $_SESSION['id_usuario'];
    $stmt = $pdo->prepare(
        'UPDATE usuarios SET nombre=?, apellido=?, calle=?, colonia=?, ciudad=?, pais=?, cp=?,
         tel_casa=?, tel_oficina=?, fax=?, email=? WHERE id_usuario=?'
    );
}
$stmt->execute($campos);

$_SESSION['nombre'] = $nombre;
header('Location: actualizar_registro.php');
exit;
