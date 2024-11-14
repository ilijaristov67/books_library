<?php

require_once __DIR__ . "/../classes/author.php";
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);
$errors = [];

if (!isset($data['id'])) {
    $errors[] = ['error' => true, 'message' => 'Id paramater is missing'];
}

if (!empty($errors)) {
    echo json_encode(['errors' => $errors]);
    return;
}

$id = $data['id'];
$author = new Author($connection, '', '', '');
if ($author->deleteAuthor($id)) {
    echo  json_encode(['success' => true, 'message' => 'Successfully Deleted']);
} else {
    echo  json_encode(['error' => true, 'message' => 'Could Not Be Deleted']);
}
