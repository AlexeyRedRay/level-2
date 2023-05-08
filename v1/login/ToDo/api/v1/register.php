<?php
require_once __DIR__ . '/connect_bd.php';

$json = file_get_contents('php://input');
$obj_input = json_decode($json, true);

$login = $obj_input['login'] ? trim($obj_input['login']) : '';
$pass = $obj_input['pass'] ? trim($obj_input['pass']) : '';

if ($login && $pass) {
    $res = $pdo->prepare("SELECT COUNT(*) FROM users WHERE login = ?");
    $res->execute([$login]);
    if ($res->fetchColumn()) {
        echo json_encode(['bad' => false]);
        exit();
    }
    $pass = password_hash($pass, PASSWORD_DEFAULT);
    $res = $pdo->prepare("INSERT INTO users (login, pass) VALUES (?,?)");
    if($res->execute([$login, $pass])) {
        $id = $pdo->lastInsertId();
        $get_login = $pdo->prepare("SELECT login FROM users WHERE id = ?");
        $get_login->execute([$id]);
        $name_table = $get_login->fetchColumn();
        $create_table = "CREATE TABLE " . "user_" . $name_table ." (id INT AUTO_INCREMENT PRIMARY KEY,
         text TEXT,
         checked TINYINT(1))";
        $pdo->exec($create_table);

        echo json_encode(['ok' => true]);
    } else {
        echo json_encode(['bad' => false]);
    }
    $res = null;
} else {
    echo json_encode(['bad' => false]);
}
