<?php
require_once __DIR__ . "/../classes/book.php";

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(['error' => true, 'message' => 'Invalid JSON data received']);
    exit;
}

$errors = [];

if (!isset($data['title']) || trim($data['title']) === '') {
    $errors[] = ['error' => true, 'message' => 'Title parameter is missing or empty'];
}
if (!isset($data['number_of_pages'])) {
    $errors[] = ['error' => true, 'message' => 'Number of pages parameter is missing'];
} elseif (!is_numeric($data['number_of_pages'])) {
    $errors[] = ['error' => true, 'message' => 'Please submit a number for pages'];
}

if (!isset($data['author_id'])) {
    $errors[] = ['error' => true, 'message' => 'Author parameter is missing'];
}

if (!isset($data['published']) || !isValidDate($data['published'], 'Y-m-d')) {
    $errors[] = ['error' => true, 'message' => 'Invalid date format or date. Required format: YYYY-MM-DD'];
}

if (!isset($data['photo']) || trim($data['photo']) === '') {
    $errors[] = ['error' => true, 'message' => 'Photo parameter is missing'];
} elseif (!isValidImageUrl($data['photo'])) {
    $errors[] = ['error' => true, 'message' => 'Invalid photo URL'];
}

if (!isset($data['category_id'])) {
    $errors[] = ['error' => true, 'message' => 'Category ID parameter is missing'];
}

if (!empty($errors)) {
    echo json_encode(['errors' => $errors]);
    exit;
}

$title = trim(ucfirst($data['title']));
$number_of_pages = $data['number_of_pages'];
$author_id = $data['author_id'];
$published = $data['published'];
$photo = $data['photo'];
$category_id = $data['category_id'];

$book = new Book($connection, $title, $number_of_pages, $author_id, $published, $photo, $category_id);

if ($book->checkBook()) {
    echo json_encode(['error' => true, 'message' => 'Book already exists']);
    return;
}

if ($book->saveBook()) {
    echo json_encode(['success' => true, 'message' => 'Book Successfully Saved']);
    return;
} else {
    echo json_encode(['error' => true, 'message' => 'Failed to save book']);
    return;
}

function isValidDate($date, $format)
{
    $dateObj = DateTime::createFromFormat($format, $date);
    return $dateObj !== false && $dateObj->format($format) === $date;
}

function isValidImageUrl($url)
{
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        return false;
    }

    return true;
}
