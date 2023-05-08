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

try {
    $id_user = $_SESSION['user_id'];
    $sql = "SELECT * FROM todos WHERE id_user= " . $id_user;
    $array_db = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    foreach ($array_db as &$row_db) {
        if ($row_db['checked']) {
            $row_db['checked'] = true;
        } else {
            $row_db['checked'] = false;
        }
    }

    echo json_encode(['items' => $array_db]);
} catch (PDOException $e) {
    header( 'HTTP/1.1 500 Internal Server Error' );
    echo json_encode(['error' => $e->getMessage()]);
}
