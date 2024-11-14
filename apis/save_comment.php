<?php
require_once __DIR__ . "/../classes/comment.php";

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(['error' => true, 'message' => 'Invalid JSON data received']);
    exit;
}

$errors = [];

if (!isset($data['user_id']) || trim($data['user_id']) === '') {
    $errors[] = ['message' => 'User ID is missing or empty'];
}

if (!isset($data['description']) || trim($data['description']) === '') {
    $errors[] = ['message' => 'Description is missing or empty'];
}

if (!isset($data['book_id']) || trim($data['book_id']) === '') {
    $errors[] = ['message' => 'Book ID is missing or empty'];
}

if (!empty($errors)) {
    echo json_encode(['errors' => $errors]);
    exit;
}

$description = trim(ucfirst($data['description']));
$user_id = $data['user_id'];
$book_id = $data['book_id'];

$comment = new Comment($connection, $user_id, $book_id, $description);

if ($comment->checkIfCommented($user_id, $book_id)) {
    echo json_encode(['errors' => true, 'message' => 'Already commented for this book']);
    return;
}

if ($comment->addComment()) {
    echo json_encode(['success' => true, 'message' => 'Comment successfully saved']);
} else {
    echo json_encode(['error' => true, 'message' => 'Failed to save comment']);
}
