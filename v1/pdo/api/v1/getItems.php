<?php
include 'connect_bd.php';

$array_db = $pdo->query("SELECT * FROM table1")->fetchAll(PDO::FETCH_ASSOC);

foreach ($array_db as &$row_db) {
    if ($row_db['checked']) {
        $row_db['checked'] = true;
    } else {
        $row_db['checked'] = false;
    }
}

echo json_encode(['items' => $array_db]);