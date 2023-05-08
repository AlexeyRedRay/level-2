<?php
include 'connect_bd.php';

$json = file_get_contents('php://input');
$obj_input = json_decode($json, true);
$text =  $obj_input['text'];
$checked = true;

$stmt = $db->prepare("INSERT INTO table1 (text, checked) VALUES (?,?)");
$stmt->bind_param("si", $text, $checked);
$stmt->execute();
$stmt->close();

$id = $db->insert_id;

echo json_encode(['id' => $id]);
