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

$obj_input = json_decode(file_get_contents('php://input'), true);
$id = $obj_input['id'];

try {
    $sql = "DELETE FROM todos WHERE id= ?";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([$id]);
    $stmt = null;
    echo json_encode(['ok' => true]);
} catch (PDOException $e) {
    header( 'HTTP/1.1 500 Internal Server Error' );
    echo json_encode(['error' => $e->getMessage()]);
}