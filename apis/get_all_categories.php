<?php

require_once __DIR__ . "/../classes/category.php";

$category = new Category($connection, '');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $allCategories = $category->getCategories();

    header('Content-Type: application/json');
    echo json_encode($allCategories);
}
