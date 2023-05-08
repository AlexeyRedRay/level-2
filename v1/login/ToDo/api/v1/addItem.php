<?php
session_start();
require_once __DIR__ . '/connect_bd.php';

$json = file_get_contents('php://input');
$obj_input = json_decode($json, true);
$text =  $obj_input['text'];
$checked = true;

$sql = "INSERT INTO " . $_SESSION['user_table'] ."(text, checked) VALUES(:text, :checked)";
$stmt = $pdo->prepare($sql);
$stmt->execute(['text' => $text, 'checked' => $checked]);
$stmt = null;

$id = $pdo->lastInsertId();

echo json_encode(['id' => $id]);
