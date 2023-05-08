<?php
include 'connect_bd.php';

$obj_input = json_decode(file_get_contents('php://input'), true);
$id = $obj_input['id'];

$stmt= $pdo->prepare("DELETE FROM table1 WHERE id= ?");
$stmt->execute([$id]);
$stmt = null;

echo json_encode(['ok' => true]);