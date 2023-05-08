<?php
include 'connect_bd.php';

$obj_input = json_decode(file_get_contents('php://input'), true);
$id = $obj_input['id'];

$stmt= $db->prepare("DELETE FROM table1 WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

echo json_encode(['ok' => true]);
