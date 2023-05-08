<?php
header("Access-Control-Allow-Origin: https://lvl2-front.loc");
header("Access-Control-Allow-Headers: content-type");
header("Access-Control-Allow-Credentials: true");

echo json_encode(['ok' => true]);