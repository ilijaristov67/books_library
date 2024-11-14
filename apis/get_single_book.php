<?php
require_once __DIR__ . "/../classes/book.php";

$id = $_GET['id'];
$book = new Book($connection, '', '', '', '', '', '');
$books = $book->getSingleBook($id);

header('Content-Type: application/json');

echo json_encode($books);
