<?php
session_start();
require 'conexion.php';
require 'funciones.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: registro_usuario.php');
    exit;
}

$nombre   = trim(post('nombre'));
$apellido = trim(post('apellido'));
$email    = trim(post('email'));
$login    = trim(post('login'));
$password = trim(post('password'));

if (empty($nombre) || empty($apellido) || empty($email) || empty($login) || empty($password)) {
    redirigir_con_error('registro_usuario.php', 'Nombre, apellido, email, login y password son requeridos');
}
if (!validar_email($email)) {
    redirigir_con_error('registro_usuario.php', 'El email no tiene un formato valido');
}
if (!validar_password($password)) {
    redirigir_con_error('registro_usuario.php', 'El password debe tener al menos 6 caracteres');
}
if (!validar_login_unico($login, $pdo)) {
    redirigir_con_error('registro_usuario.php', 'El login ya esta en uso, elija otro');
}

$stmt = $pdo->prepare(
    'INSERT INTO usuarios (nombre, apellido, calle, colonia, ciudad, pais, cp, email, login, password)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)'
);
$stmt->execute(array(
    $nombre, $apellido,
    trim(post('calle')),
    trim(post('colonia')),
    trim(post('ciudad')),
    trim(post('pais')),
    trim(post('cp')),
    $email, $login, $password
));

$_SESSION['id_usuario'] = $pdo->lastInsertId();
$_SESSION['nombre']     = $nombre;
$_SESSION['login']      = $login;

header('Location: sistema_r_vuelo.php');
exit;
