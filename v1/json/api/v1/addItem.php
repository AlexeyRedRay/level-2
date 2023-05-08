<?php
    $json = file_get_contents('php://input');
    $obj_input = json_decode($json, true);

	$file =  "counter_id.txt";
    $id = file_get_contents($file);
    $id++;
    file_put_contents($file, $id);

    $obj_input = ['id' => $id] + $obj_input;
    $obj_input['checked'] = true;
    $obj = json_decode(file_get_contents('db.json'), true);
    $obj[$id]= $obj_input;
	
    $db =  json_encode($obj);
    file_put_contents("db.json", $db);
    
    header('Content-Type: application/json');
    echo json_encode(['id' => $id]);