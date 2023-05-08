<?php
session_start();
require_once __DIR__ . '/connect_bd.php';

$sql = "SELECT * FROM " . $_SESSION['user_table'];
$array_db = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

foreach ($array_db as &$row_db) {
    if ($row_db['checked']) {
        $row_db['checked'] = true;
    } else {
        $row_db['checked'] = false;
    }
}

echo json_encode(['items' => $array_db]);