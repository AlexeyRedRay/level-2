<?php
if(!defined('access')) {
    die('Direct access not permitted');
}

if (file_exists(__DIR__ . '/cors.php')) {
    require_once __DIR__ . '/cors.php';
} else {
    exit();
}

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
$pass = $obj_input['pass'] ? trim($obj_input['pass']) : '';

if ($login && $pass) {
    try {
        $res = $pdo->prepare("SELECT COUNT(*) FROM users WHERE login = ?");
        $res->execute([$login]);
        if ($res->fetchColumn()) {
            echo json_encode(['error' => 'user with this name already exists']);
            exit();
        }
        $pass = password_hash($pass, PASSWORD_DEFAULT);

        $res = $pdo->prepare("INSERT INTO users (login, pass) VALUES (?,?)");
        $res->execute([$login, $pass]);

        echo json_encode(['ok' => true]);

    }  catch (PDOException $e) {
        header( 'HTTP/1.1 500 Internal Server Error' );
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    header( 'HTTP/1.1 500 Internal Server Error');
    echo json_encode(['error' => 'Internal Server Error']);
}
