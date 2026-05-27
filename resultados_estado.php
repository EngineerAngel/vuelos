<?php
session_start();
require 'conexion.php';
require 'funciones.php';
verificar_sesion();

$origen    = trim(get_param('origen'));
$destino   = trim(get_param('destino'));
$aerolinea = trim(get_param('aerolinea'));
$vuelo     = trim(get_param('vuelo'));
$fecha     = trim(get_param('fecha'));

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
if ($vuelo) {
    $where[]  = 'num_vuelo LIKE ?';
    $params[] = '%' . $vuelo . '%';
}

$sql = 'SELECT aerolinea, num_vuelo, horario_salida, horario_llegada, disponibilidad, status FROM vuelos';
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
    <title>Sistema de Reservaciones - Resultados Estado</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<center>
    <h1>SISTEMA DE RESERVACIONES DE VUELO</h1>
    <h2>Pantalla Resultados Estado (P-13)</h2>

    Fecha de Consulta: <input type="date" value="<?= date('Y-m-d') ?>" readonly>
    <br><br>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Seleccionar</th>
                <th>Aerolínea</th>
                <th>Vuelo</th>
                <th>Horario Salida</th>
                <th>Horario Llegada</th>
                <th>Disponibilidad</th>
                <th>Comentario</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($vuelos as $v): ?>
            <tr>
                <td><input type="checkbox"></td>
                <td><?= htmlspecialchars($v['aerolinea']) ?></td>
                <td><?= htmlspecialchars($v['num_vuelo']) ?></td>
                <td><?= htmlspecialchars($v['horario_salida']) ?></td>
                <td><?= htmlspecialchars($v['horario_llegada']) ?></td>
                <td><?= htmlspecialchars($v['disponibilidad']) ?></td>
                <td><?= htmlspecialchars($v['status']) ?></td>
            </tr>
            <?php endforeach; ?>
            <?php for ($i = count($vuelos); $i < 10; $i++): ?>
            <tr><td><input type="checkbox"></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
            <?php endfor; ?>
        </tbody>
    </table>

    <br>
    <a href="consulta_estado.php"><button type="button">Nueva Consulta</button></a>
    <a href="servicios.php"><button type="button">Servicios</button></a>
    <a href="index.php"><button type="button">Salir</button></a>
</center>
</body>
</html>
