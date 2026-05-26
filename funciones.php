<?php
function verificar_sesion() {
    if (!isset($_SESSION['id_usuario'])) {
        header('Location: index.php');
        exit;
    }
}

function post($key, $default = '') {
    return isset($_POST[$key]) ? $_POST[$key] : $default;
}

function get_param($key, $default = '') {
    return isset($_GET[$key]) ? $_GET[$key] : $default;
}

function validar_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function validar_login_unico($login, $pdo) {
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM usuarios WHERE login = ?');
    $stmt->execute(array($login));
    return $stmt->fetchColumn() == 0;
}

function validar_password($pass) {
    return strlen(trim($pass)) >= 6;
}

function validar_tarjeta($num) {
    return preg_match('/^\d{16}$/', $num);
}

function validar_fecha_vencimiento($fecha) {
    if (!preg_match('/^(0[1-9]|1[0-2])\/\d{4}$/', $fecha)) return false;
    $partes = explode('/', $fecha);
    $vence  = mktime(0, 0, 0, (int)$partes[0] + 1, 1, (int)$partes[1]);
    return $vence > time();
}

function redirigir_con_error($url, $mensaje) {
    header('Location: ' . $url . '?error=' . urlencode($mensaje));
    exit;
}
