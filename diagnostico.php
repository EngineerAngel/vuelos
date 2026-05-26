<?php
// Script de diagnostico: subir a la misma carpeta y abrir en el navegador.
// Borrar despues de usar.
header('Content-Type: text/plain; charset=utf-8');

echo "=== ENTORNO ===\n";
echo "PHP version    : " . phpversion() . "\n";
echo "Drivers PDO    : " . implode(', ', PDO::getAvailableDrivers()) . "\n";
echo "pdo_sqlite     : " . (extension_loaded('pdo_sqlite') ? 'SI' : 'NO') . "\n\n";

$dbFile     = __DIR__ . '/vuelos_bd.sqlite';
$schemaFile = __DIR__ . '/vuelos_bd.sql';

echo "=== ARCHIVOS ===\n";
echo "Carpeta        : " . __DIR__ . "\n";
echo "Carpeta escrib.: " . (is_writable(__DIR__) ? 'SI' : 'NO') . "\n";
echo "vuelos_bd.sqlite existe   : " . (file_exists($dbFile) ? 'SI ('.filesize($dbFile).' bytes)' : 'NO') . "\n";
echo "vuelos_bd.sqlite escrib.  : " . (file_exists($dbFile) && is_writable($dbFile) ? 'SI' : 'NO') . "\n";
echo "vuelos_bd.sql existe      : " . (file_exists($schemaFile) ? 'SI' : 'NO') . "\n\n";

echo "=== CONEXION Y CONSULTAS ===\n";
try {
    $pdo = new PDO('sqlite:' . $dbFile);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    echo "Conexion PDO   : OK\n";

    $n = $pdo->query('SELECT COUNT(*) FROM usuarios')->fetchColumn();
    echo "Filas usuarios : $n\n";

    $stmt = $pdo->prepare('SELECT id_usuario, login, password FROM usuarios WHERE login = ?');
    $stmt->execute(['admin']);
    $row = $stmt->fetch();
    echo "Usuario admin  : " . ($row ? 'ENCONTRADO (id='.$row['id_usuario'].')' : 'NO ENCONTRADO') . "\n";
    if ($row) {
        echo "Hash length    : " . strlen($row['password']) . "\n";
        echo "Hash prefix    : " . substr($row['password'], 0, 4) . "\n";
        echo "verify admin123: " . (password_verify('admin123', $row['password']) ? 'OK' : 'FAIL') . "\n";
    }
} catch (Throwable $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}

echo "\n=== SESIONES ===\n";
$path = session_save_path() ?: sys_get_temp_dir();
echo "save_path      : $path\n";
echo "escribible     : " . (is_writable($path) ? 'SI' : 'NO') . "\n";
@session_start();
$_SESSION['_test'] = 'ok';
echo "session_id     : " . session_id() . "\n";

echo "\n=== POST DEBUG ===\n";
echo "Metodo         : " . $_SERVER['REQUEST_METHOD'] . "\n";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "POST recibido  :\n";
    print_r($_POST);
}
echo "\nPara probar el flujo POST, abre index.php, intenta login con admin/admin123,\n";
echo "y si no funciona vuelve aqui y dime que dice la seccion 'CONEXION Y CONSULTAS'.\n";
