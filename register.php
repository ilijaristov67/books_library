<?php
require_once __DIR__ . "/autoload.php";

$_SESSION['messages'] = [];
$_SESSION['status'] = '';

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location:log_in_form.php?error=invalidMethod');
    return;
}

if (!empty($_POST['firstname']) && isset($_POST['firstname'])) {
    $firstname = $_POST['firstname'];
} else {
    // header('Location:log_in_form.php?error=firstnameRequired');
    // return;
    $_SESSION['status'] = 'error';
    array_push($_SESSION['messages'], 'First Name Required');
}

if (!empty($_POST['lastname']) && isset($_POST['lastname'])) {
    $lastname = $_POST['lastname'];
} else {
    // header('Location:log_in_form.php?error=lastnameRequired');
    // return;
    $_SESSION['status'] = 'error';
    array_push($_SESSION['messages'], 'Last Name Required');
}
if (!empty($_POST['email']) && isset($_POST['email'])) {
    $email = $_POST['email'];
} else {
    // header('Location:log_in_form.php?error=emailRequired');
    // return;
    $_SESSION['status'] = 'error';
    array_push($_SESSION['messages'], 'Email Required');
}
if (!empty($_POST['password']) && isset($_POST['password'])) {
    $password = $_POST['password'];
} else {
    // header('Location:log_in_form.php?error=passwordRequired');
    // return;
    $_SESSION['status'] = 'error';
    array_push($_SESSION['messages'], 'Password Required');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // header('Location:log_in_form.php?error=invalidEmail');
    // return;
    $_SESSION['status'] = 'error';
    array_push($_SESSION['messages'], 'Invalid Email');
}
if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[^a-zA-Z0-9]/', $password)) {
    // header('Location:log_in_form.php?error=invalidPasswordEntersmallletterbigletterandaspecialchar');
    // return;
    $_SESSION['status'] = 'error';
    array_push($_SESSION['messages'], 'Invalid Password');
}
$user  = new User($connection, $firstname, $lastname, $email, $password);
$userExists = $user->checkUser();
if ($userExists) {
    // header('Location:log_in_form.php?error=userExists');
    // return;
    $_SESSION['status'] = 'error';
    array_push($_SESSION['messages'], 'User Exists');
}

if (isset($_SESSION['status']) && $_SESSION['status'] === 'error') {
    if (count($_SESSION['messages']) > 0) {
        header('Location:log_in_form.php');
        die;
    }
}

$user->saveUser();
header('Location:log_in_form.php?success=userRegistered');
$_SESSION['status'] = 'success';
array_push($_SESSION['messages'], 'Successfully Registered');
