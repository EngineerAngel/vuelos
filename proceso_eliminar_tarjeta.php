<?php
session_start();
require 'conexion.php';
require 'funciones.php';
verificar_sesion();

$stmt = $pdo->prepare('DELETE FROM tarjetas WHERE id_usuario = ? LIMIT 1');
$stmt->execute([$_SESSION['id_usuario']]);

header('Location: registro_tarjeta.php');
exit;
