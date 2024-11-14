<?php
require_once __DIR__ . "/../classes/comment.php";

$book_id = isset($_GET['book_id']) ? $_GET['book_id'] : null;

$comment = new Comment($connection, '', $book_id, '');
$comments = $comment->getApprovedComments($book_id);

header('Content-Type: application/json');
echo json_encode($comments);
