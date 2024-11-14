<?php
require_once __DIR__ . "/../autoload.php";



header('Content-Type: application/json');


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Invalid Request Method']);
    exit;
}


$data = json_decode(file_get_contents('php://input'), true);

$errors = [];

if (empty($data['first_name'])) {
    $errors[] = ['error' => true, 'message' => 'Missing first name parameter'];
}

if (empty($data['last_name'])) {
    $errors[] = ['error' => true, 'message' => 'Missing last name parameter'];
}

if (empty($data['biography'])) {
    $errors[] = ['error' => true, 'message' => 'Missing biography parameter'];
} elseif (strlen($data['biography']) < 20) {
    $errors[] = ['error' => true, 'message' => 'Biography needs to be at least 20 characters long'];
}


if (!empty($errors)) {

    echo json_encode(['errors' => $errors]);
    exit;
}


$author = new Author($connection, trim(ucfirst($data['first_name'])), trim(ucfirst($data['last_name'])), trim(ucfirst($data['biography'])));

if ($author->checkIfAuthorExists()) {
    echo json_encode(['error' => true, 'message' => 'Author Already Exists']);
    return;
}


$savedAuthor = $author->saveAuthor();
if ($savedAuthor) {
    echo json_encode(['success' => true, 'message' => 'Author Saved']);
} else {
    echo json_encode(['error' => true, 'message' => 'Failed to save author']);
}

return;
