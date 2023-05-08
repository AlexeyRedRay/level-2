<?php
    $obj_input = json_decode(file_get_contents('db.json'), true);

    $array = array_values($obj_input);

    header('Content-Type: application/json');
    echo json_encode(['items' => $array]);