<?php
require_once __DIR__ . "/../classes/author.php";

$author = new Author($connection, '', '', '');
$allAuthors = $author->getAllAuthors();
echo json_encode($allAuthors);
