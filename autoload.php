<?php
require_once __DIR__ . "/dbConnect/db.php";
require_once __DIR__ . "/classes/user.php";
require_once __DIR__ . "/classes/category.php";
require_once __DIR__ . "/classes/author.php";

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
$connectionObj = new dbConnect('mysql', 'localhost', 'brainster_library', 'root', '');
$connectionObj->dbConnect();
$connection = $connectionObj->getConnection();
