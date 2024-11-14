<?php
require_once __DIR__ . "/../classes/comment.php";

$comment = new Comment($connection, '', '', '');

$comments = $comment->getAllComments();

header('Content-Type: application/json');

echo json_encode($comments);
