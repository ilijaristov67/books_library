<?php
require_once __DIR__ . "/autoload.php";
if (isset($_POST['logout'])) {
    session_destroy();
}
return header('Location:index.php');
