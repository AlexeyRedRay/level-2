<?php
include 'connect_bd.php';

$obj_input = json_decode(file_get_contents('php://input'), true);
$id = $obj_input['id'];
$checked = $obj_input['checked'];
if($obj_input['checked'] == 1) {
    $checked = 1;
} else {
    $checked = 0;
}
$stmt= $pdo->prepare("UPDATE table1 SET text= :text, checked= :checked WHERE id= :id");
$stmt->execute( [ 'text' => $obj_input['text'], 'checked' => $checked, 'id' => $id]);
$stmt = null;

echo json_encode(['ok' => true]);