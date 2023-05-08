<?php
if(!defined('access')) {
    die('Direct access not permitted');
}

if (file_exists(__DIR__ . '/cors.php')) {
    require_once __DIR__ . '/cors.php';
} else {
    exit();
}

session_set_cookie_params(['samesite' => 'None', 'secure' => true]);
session_start();

if (file_exists(__DIR__ . '/connect_bd.php')) {
    require_once __DIR__ . '/connect_bd.php';
} else {
    header( 'HTTP/1.1 500 Internal Server Error' );
    echo json_encode(['error' => 'Internal Server Error']);
    exit();
}

$json = file_get_contents('php://input');
$obj_input = json_decode($json, true);
$login = $obj_input['login'] ? trim($obj_input['login']) : '';
$password = (string) $obj_input['pass'] ? trim($obj_input['pass']) : '';

if ($login == '') {
    header( 'HTTP/1.1 401 Unauthorized' );
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

try {
    $sql_pass = $pdo->prepare("SELECT pass FROM users WHERE login = ?");
    $sql_pass->execute([$login]);
    $hash_pass = $sql_pass->fetchColumn();

    if (password_verify($password, $hash_pass)) {
        $sql_id = $pdo->prepare("SELECT id FROM users WHERE login = ?");
        $sql_id->execute([$login]);
        $id = $sql_id->fetchColumn();

        $_SESSION['user_id'] = $id;

        echo json_encode(['ok' => true]);
    } else {
        header( 'HTTP/1.1 401 Unauthorized' );
        echo json_encode(['error' => 'Unauthorized']);
        exit();
    }

} catch (PDOException) {
    header( 'HTTP/1.1 401 Unauthorized' );
    echo json_encode(['error' => 'Unauthorized']);
}