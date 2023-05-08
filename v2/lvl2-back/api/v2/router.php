<?php

if (file_exists(__DIR__ . '/cors.php')) {
    require_once __DIR__ . '/cors.php';
} else {
    exit();
}

define('access', TRUE);

switch($_GET['action']) {
    case "login" :
        require_once("login.php");
        break;
    case "register" :
        require_once("register.php");
        break;
    case "getItems" :
        require_once("getItems.php");
        break;
    case "deleteItem" :
        require_once("deleteItem.php");
        break;
    case "addItem" :
        require_once("addItem.php");
        break;
    case "changeItem" :
        require_once("changeItem.php");
        break;
    default :
        require_once("logout.php");
        break;
}

