<?php
require_once __DIR__ . "/../classes/comment.php";

header('Content-Type: application/json');

$user_id = $_GET['user_id'] ?? null;
$book_id = $_GET['book_id'] ?? null;

if (!$user_id || !$book_id) {
    echo json_encode(['error' => 'Missing user_id or book_id']);
    exit;
}

$comment = new Comment($connection, '', ' ', '');
$comments = $comment->getUserComments($user_id, $book_id);

echo json_encode($comments);
