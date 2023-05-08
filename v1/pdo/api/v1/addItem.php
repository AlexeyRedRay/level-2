<?php
include 'connect_bd.php';

$json = file_get_contents('php://input');
$obj_input = json_decode($json, true);
$text =  $obj_input['text'];
$checked = true;

$stmt = $pdo->prepare("INSERT INTO table1(text, checked) VALUES(:text, :checked)");
$stmt->execute(['text' => $text, 'checked' => $checked]);
$stmt = null;

$id = $pdo->lastInsertId();
file_put_contents("add.json", json_encode(['id' => $id]));
echo json_encode(['id' => $id]);
