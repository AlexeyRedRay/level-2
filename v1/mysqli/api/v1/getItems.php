<?php
include 'connect_bd.php';

$all_db = $db->query("SELECT * FROM table1");
$array_db = $all_db->fetch_all(MYSQLI_ASSOC);

foreach ($array_db as &$row_db) {
    if ($row_db['checked']) {
        $row_db['checked'] = true;
    } else {
        $row_db['checked'] = false;
    }
}

echo json_encode(['items' => $array_db]);