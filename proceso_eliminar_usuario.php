<?php
session_start();
require 'conexion.php';
require 'funciones.php';
verificar_sesion();

$stmt = $pdo->prepare('DELETE FROM usuarios WHERE id_usuario = ?');
$stmt->execute([$_SESSION['id_usuario']]);

session_destroy();
header('Location: index.php');
exit;
