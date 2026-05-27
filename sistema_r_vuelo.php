<?php
session_start();
require 'conexion.php';
require 'funciones.php';
verificar_sesion();

$stmt = $pdo->prepare('SELECT * FROM usuarios WHERE id_usuario = ?');
$stmt->execute(array($_SESSION['id_usuario']));
$usuario = $stmt->fetch() ?: array();
$error   = htmlspecialchars(get_param('error'));

function val($key) {
    global $usuario;
    return htmlspecialchars(isset($usuario[$key]) ? $usuario[$key] : '');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Reservaciones - Obtener Registro Usuario</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<center>
    <h1>SISTEMA DE RESERVACIONES VUELO</h1>
    <h2>Pantalla Obtener Registro Usuario (P-4)</h2>
    <?php if ($error): ?><p><b><?= $error ?></b></p><?php endif; ?>

    <form action="proceso_actualizar_usuario.php" method="POST">
        Nombre: <input type="text" name="nombre" value="<?= val('nombre') ?>">
        Apellidos: <input type="text" name="apellido" value="<?= val('apellido') ?>">
        <br><br>
        Calle: <input type="text" name="calle" value="<?= val('calle') ?>">
        Colonia: <input type="text" name="colonia" value="<?= val('colonia') ?>">
        <br><br>
        Ciudad: <input type="text" name="ciudad" value="<?= val('ciudad') ?>">
        País: <input type="text" name="pais" value="<?= val('pais') ?>">
        Código Postal: <input type="text" name="cp" value="<?= val('cp') ?>">
        <br><br>
        Tel Casa: <input type="text" name="tel_casa" value="<?= val('tel_casa') ?>">
        Tel Of.: <input type="text" name="tel_oficina" value="<?= val('tel_oficina') ?>">
        Fax: <input type="text" name="fax" value="<?= val('fax') ?>">
        <br><br>
        Login: <input type="text" name="login" value="<?= val('login') ?>" readonly>
        E-Mail: <input type="email" name="email" value="<?= val('email') ?>">
        <br><br>
        Password: <input type="password" name="password">
        Repetir Password: <input type="password" name="repetir_password">
        <br><br>
        <a href="proceso_eliminar_usuario.php"><button type="button">Eliminar</button></a>
        <button type="submit">Actualizar</button>
        <a href="registro_tarjeta.php"><button type="button">Registrar Tarjeta</button></a>
        <a href="servicios.php"><button type="button">Servicios</button></a>
        <a href="index.php"><button type="button">Salir</button></a>
    </form>
</center>
</body>
</html>
