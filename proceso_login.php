<?php
session_start();
require 'conexion.php';
require 'funciones.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$login    = trim(post('login'));
$password = trim(post('password'));

if (empty($login) || empty($password)) {
    redirigir_con_error('index.php', 'Login y password son requeridos');
}

$stmt = $pdo->prepare('SELECT id_usuario, nombre, login, password FROM usuarios WHERE login = ? AND password = ?');
$stmt->execute(array($login, $password));
$usuario = $stmt->fetch();

if ($usuario) {
    $_SESSION['id_usuario'] = $usuario['id_usuario'];
    $_SESSION['nombre']     = $usuario['nombre'];
    $_SESSION['login']      = $usuario['login'];
    header('Location: servicios.php');
} else {
    redirigir_con_error('index.php', 'Login o password incorrecto');
}
exit;
