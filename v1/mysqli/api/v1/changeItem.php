<?php
include 'connect_bd.php';

$obj_input = json_decode(file_get_contents('php://input'), true);
$id = $obj_input['id'];
$checked = $obj_input['checked'];
if($obj_input['checked'] == 1) {
    $checked = 1;
}
$stmt= $db->prepare("UPDATE table1 SET text=?, checked=? WHERE id=?");
$stmt->bind_param("sii", $obj_input['text'],$checked, $id);
$stmt->execute();
$stmt->close();

echo json_encode(['ok' => true]);
