<?php
require_once __DIR__ . '/../classes/comment.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);


if (isset($data['id'])) {
    $id = $data['id'];
}

$comment = new Comment($connection, '', ' ', '');
$comments = $comment->approveComment($id);

echo json_encode($comments);
