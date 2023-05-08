<?php
session_start();
require_once __DIR__ . '/connect_bd.php';

$json = file_get_contents('php://input');
$obj_input = json_decode($json, true);
$login = $obj_input['login'];
$password = (string) $obj_input['pass'];

$pass = $pdo->prepare("SELECT pass FROM users WHERE login = ?");
//if
$pass->execute([$login]);
$hash_pass = $pass->fetchColumn();


if (password_verify($password, $hash_pass)) {
    $_SESSION['user_table'] = 'user_' . $login;
    echo json_encode(['ok' => true]);
}



