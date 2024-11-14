<?php
require_once __DIR__ . "/../classes/comment.php";



$id = $_GET['id'];

$comment = new Comment($connection, '', '', '');

$result = $comment->deleteComment($id);


$response = [
    'success' => $result
];

header('Content-Type: application/json');
echo json_encode($response);
