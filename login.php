<?php
require_once __DIR__ . "/autoload.php";
$_SESSION['messages'] = [];
$_SESSION['status'] = '';
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location:log_in_form.php?error=invalidMethod');
}
if (!empty($_POST['email-login']) && isset($_POST['email-login'])) {
    $email = trim($_POST['email-login']);
} else {
    // header('Location:log_in_form.php?error=emailRequired');
    $_SESSION['status'] = 'error';
    array_push($_SESSION['messages'], 'Email Required');
}
if (!empty($_POST['password-login']) && isset($_POST['password-login'])) {
    $password = trim($_POST['password-login']);
} else {
    // header('Location:log_in_form.php?error=passwordRequired');
    $_SESSION['status'] = 'error';
    array_push($_SESSION['messages'], 'Password Required');
}
$user = new User($connection, '', '', $email, $password);

$currentUser = $user->getUser();

$_SESSION['name'] = $currentUser['first_name'];
$_SESSION['id']  = $currentUser['id'];
if ($user->authenticateUser()) {
    $_SESSION['email'] = $email;
    $_SESSION['role_id'] = $currentUser['role_id'];
    header('Location:index.php?success=successfullyLogIn');
} else {
    // header('Location:log_in_form.php?error=wrongCredentials');
    $_SESSION['status'] = 'error';
    array_push($_SESSION['messages'], 'Wrong Credentials');
}
if (isset($_SESSION['status']) && $_SESSION['status'] === 'error') {
    if (count($_SESSION['messages']) > 0) {
        header('Location:log_in_form.php');
        die;
    }
}
