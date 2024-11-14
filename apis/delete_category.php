<?php
require_once __DIR__ . "/../autoload.php";
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id'])) {
    $id = $data['id'];
    $category = new Category($connection, '');
    $success = $category->deleteCategory($id);
    if ($success) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => true, 'message' => 'Failed to delete category']);
    }
} else {
    echo json_encode(['error' => true, 'message' => 'ID parameter missing']);
}
