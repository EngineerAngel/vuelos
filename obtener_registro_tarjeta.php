<?php
session_start();
require 'conexion.php';
require 'funciones.php';
verificar_sesion();

$stmt = $pdo->prepare('SELECT * FROM tarjetas WHERE id_usuario = ? LIMIT 1');
$stmt->execute(array($_SESSION['id_usuario']));
$tarjeta = $stmt->fetch() ?: array();
$error   = htmlspecialchars(get_param('error'));

function val($key) {
    global $tarjeta;
    return htmlspecialchars(isset($tarjeta[$key]) ? $tarjeta[$key] : '');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Reservaciones - Obtener Registro Tarjeta</title>
</head>
<body>
<center>
<h1>SISTEMA DE RESERVACIONES DE VUELO</h1>
<h2>Pantalla Obtener Registro Tarjeta (P-6)</h2>
<?php if ($error): ?><p><b><?= $error ?></b></p><?php endif; ?>

<form action="proceso_actualizar_tarjeta.php" method="POST">
    Nombre: <input type="text" name="nombre_titular" value="<?= val('nombre_titular') ?>">
    <br><br>
    Número de Tarjeta (requerido para pagos): <input type="text" name="num_tarjeta" value="<?= val('num_tarjeta') ?>">
    <br><br>
    Tipo: <input type="text" name="tipo" value="<?= val('tipo') ?>">
    Fecha Vencimiento: <input type="text" name="fecha_vencimiento" value="<?= val('fecha_vencimiento') ?>">

    <br><br>
    <a href="proceso_eliminar_tarjeta.php"><button type="button">Eliminar</button></a>
    <button type="submit">Actualizar</button>
    <a href="servicios.php"><button type="button">Servicios</button></a>
    <a href="index.php"><button type="button">Salir</button></a>
</form>
</center>
</body>
</html>
