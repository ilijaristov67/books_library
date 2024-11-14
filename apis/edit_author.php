<?php
require_once __DIR__ . "/../classes/author.php";
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

$errors = [];

if (!isset($data['id'])) {
    $errors[] = ['error' => true, 'message' => 'Missing id parameter'];
}

if (!isset($data['first_name'])) {
    $errors[] = ['error' => true, 'message' => 'Missing first name parameter'];
}

if (!isset($data['last_name'])) {
    $errors[] = ['error' => true, 'message' => 'Missing last name parameter'];
}

if (!isset($data['biography'])) {
    $errors[] = ['error' => true, 'message' => 'Missing  biography parameter'];
}

if (strlen($data['biography']) < 20) {
    $errors[] = ['error' => true, 'message' => 'Biography too short, 20 chars minimum'];
}

if (!empty($errors)) {
    echo json_encode(['errors' => $errors]);
    return;
}


$author = new Author($connection, '', '', '');
$id = $data['id'];
$first_name = trim(ucfirst($data['first_name']));
$last_name = trim(ucfirst($data['last_name']));
$biography = trim(ucfirst($data['biography']));

if ($author->editAuthor($id, $first_name, $last_name, $biography)) {
    echo json_encode(['success' => true, 'message' => 'Author Successfully Edited']);
} else {
    echo json_encode(['error' => true, 'message' => 'Author Was Not Edited']);
}
