<?php
session_start();
require_once __DIR__ . '/connect_bd.php';

$obj_input = json_decode(file_get_contents('php://input'), true);
$id = $obj_input['id'];

$sql = "DELETE FROM " . $_SESSION['user_table'] . " WHERE id= ?";
$stmt= $pdo->prepare($sql);
$stmt->execute([$id]);
$stmt = null;

echo json_encode(['ok' => true]);