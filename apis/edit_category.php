<?php
require_once __DIR__ . "/../classes/category.php";
header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
if (isset($data['id']) && isset($data['title'])) {
    $id = $data['id'];
    $title = $data['title'];
    $category = new Category($connection, '');

    $success = $category->editCategory($id, $title);

    if ($success) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => true, 'message' => 'Failed to edit category']);
    }
} else {
    echo json_encode(['error' => true, 'message' => 'Parameters are missing']);
}
