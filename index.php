<?php
$error = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Reservaciones - Inicio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<center>
    <h1>SISTEMA DE RESERVACIONES DE VUELO</h1>
    <h3>Pantalla Principal (P-1)</h3>
    <?php if ($error): ?><p><b><?= $error ?></b></p><?php endif; ?>
    
    <p>Servicios Ofrecidos:</p>
    <ul style="display: inline-block; text-align: left;">
        <li>Consulta de Vuelos, Tarifas y Horarios</li>
        <li>Reserva de Vuelos</li>
        <li>Compra de Boletos</li>
    </ul>

    <p>Para registrarse por primera vez oprima:</p>
    <form action="registro_usuario.php">
        <button type="submit">Registrarse por Primera Vez</button>
    </form>

    <br>
    <p>Para accesar todos los servicios de vuelo (consulta, reserva, compra) o modificar su registro, oprima:</p>
    
    <form action="proceso_login.php" method="POST">
        Login: <input type="text" name="login">
        <br><br>
        Password: <input type="password" name="password">
        <br><br>
        <button type="submit">OK</button>
        <button type="button">Salir</button>
    </form>
</center>
</body>
</html>