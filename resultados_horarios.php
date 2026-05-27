<?php
session_start();
require 'conexion.php';
require 'funciones.php';
verificar_sesion();

$origen    = trim(get_param('origen'));
$destino   = trim(get_param('destino'));
$aerolinea = trim(get_param('aerolinea'));
$horario   = trim(get_param('horario'));

$where  = array();
$params = array();

if ($origen) {
    $where[]  = 'origen LIKE ?';
    $params[] = '%' . $origen . '%';
}
if ($destino) {
    $where[]  = 'destino LIKE ?';
    $params[] = '%' . $destino . '%';
}
if ($aerolinea) {
    $where[]  = 'aerolinea LIKE ?';
    $params[] = '%' . $aerolinea . '%';
}
if ($horario) {
    $where[]  = 'horario_salida LIKE ?';
    $params[] = '%' . $horario . '%';
}

$sql = 'SELECT aerolinea, num_vuelo, dias_operacion, horario_salida, restricciones FROM vuelos';
if ($where) {
    $sql .= ' WHERE ' . implode(' AND ', $where);
}
$sql .= ' LIMIT 10';

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$vuelos = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Reservaciones - Resultados Horarios</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<center>
    <h1>SISTEMA DE RESERVACIONES DE VUELO</h1>
    <h2>Pantalla Resultado Horarios (P-9)</h2>

    Fecha de Consulta: <input type="date" value="<?= date('Y-m-d') ?>" readonly>
    <br><br>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Seleccionar</th>
                <th>Aerolínea</th>
                <th>Vuelo</th>
                <th>Días</th>
                <th>Horario</th>
                <th>Restricciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vuelos as $v): ?>
            <tr>
                <td><input type="checkbox"></td>
                <td><?= htmlspecialchars($v['aerolinea']) ?></td>
                <td><?= htmlspecialchars($v['num_vuelo']) ?></td>
                <td><?= htmlspecialchars($v['dias_operacion']) ?></td>
                <td><?= htmlspecialchars($v['horario_salida']) ?></td>
                <td><?= htmlspecialchars($v['restricciones']) ?></td>
            </tr>
            <?php endforeach; ?>
            <?php for ($i = count($vuelos); $i < 10; $i++): ?>
            <tr><td><input type="checkbox"></td><td></td><td></td><td></td><td></td><td></td></tr>
            <?php endfor; ?>
        </tbody>
    </table>

    <br>
    <button type="button">+</button>
    <button type="button">-</button>
    <a href="consulta_horarios.php"><button type="button">Nueva Consulta</button></a>
    <a href="servicios.php"><button type="button">Servicios</button></a>
    <a href="index.php"><button type="button">Salir</button></a>
</center>
</body>
</html>
