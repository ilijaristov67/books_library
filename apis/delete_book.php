<?php
require_once __DIR__ . "/../classes/book.php";
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id'])) {
    $id = $data['id'];
} else {
    echo json_encode(['error' => true, 'message' => 'ID parameter missing']);
    return;
}

$book = new Book($connection, '', '', '', '', '', '');

if ($book->deleteBook($id)) {
    echo json_encode(['success' => true, 'message' => 'Book Deleted']);
    return;
} else {
    echo json_encode(['error' => true, 'message' => 'Failed to delete book']);
    return;
}
