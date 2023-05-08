<?php
    $obj_input = json_decode(file_get_contents('php://input'), true);
    $id = $obj_input['id'];

    $obj_db = json_decode(file_get_contents('db.json'), true);
    $obj_db[$id]['text'] = $obj_input['text'];
    $obj_db[$id]['checked'] = $obj_input['checked'];
    file_put_contents("db.json", json_encode($obj_db));

    header('Content-Type: application/json');
    echo json_encode(['ok' => true]);