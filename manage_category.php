<?php
require_once __DIR__ . "/autoload.php";

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location:index.php?error=invalidMethod');
    return;
}
$_SESSION['messages'] = [];
$_SESSION['status'] = '';

if (!empty($_POST['category_name']) && isset($_POST['category_name'])) {
    $categoryName = trim(ucfirst($_POST['category_name']));
} else {
    // header('Location:log_in_form.php?error=firstnameRequired');
    // return;
    $_SESSION['status'] = 'error';
    array_push($_SESSION['messages'], 'Category Required');
}

$category = new Category($connection, $categoryName);

if ($category->checkCategory()) {
    $_SESSION['status'] = 'error';
    array_push($_SESSION['messages'], 'Category Already Exists');
}

if (isset($_SESSION['status']) && $_SESSION['status'] === 'error') {
    if (count($_SESSION['messages']) > 0) {
        header('Location:adminPanel.php');
        die;
    }
} else {
    $category->addCategory();
    $_SESSION['status'] = 'success';
    array_push($_SESSION['messages'], 'Category Saved Successfully');
    header('Location:adminPanel.php');
}
