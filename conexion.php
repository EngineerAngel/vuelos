<?php
// Base de datos SQLite local: vive como archivo dentro de esta misma carpeta.
// No requiere servidor MySQL ni configuración previa.
// Si vuelos_bd.sqlite no existe, se crea automáticamente a partir de vuelos_bd.sql.

$dbFile     = __DIR__ . '/vuelos_bd.sqlite';
$schemaFile = __DIR__ . '/vuelos_bd.sql';
$bootstrap  = !file_exists($dbFile);

$opciones = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO('sqlite:' . $dbFile, null, null, $opciones);
    $pdo->exec('PRAGMA foreign_keys = ON');

    if ($bootstrap && file_exists($schemaFile)) {
        $pdo->exec(file_get_contents($schemaFile));
    }
} catch (PDOException $e) {
    die('Error de conexión a la base de datos: ' . $e->getMessage());
}
