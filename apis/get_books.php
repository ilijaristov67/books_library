<?php
require_once __DIR__ . "/../classes/book.php";

$book = new Book($connection, '', '', '', '', '', '');
$books = $book->getAllBooks();

header('Content-Type: application/json');

echo json_encode($books);
