<?php
require_once __DIR__ . "/autoload.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="log_in_form.css">

</head>

<body>
    <?php

    // require_once __DIR__ . "/partials/navbar.php";
    ?>
    <section class="forms-section">

        <h1 class="section-title head">Brainster Library</h1>

        <div class="forms">

            <div class="form-wrapper is-active">
                <div class="messages"><?php
                                        if (isset($_SESSION['messages']) && isset($_SESSION['status'])) {
                                            foreach ($_SESSION['messages'] as $message) {
                                                if ($_SESSION['status'] === 'success') {
                                                    echo "<div class='alert alert-success px-5 fadeOut'>$message</div>";
                                                } else {
                                                    echo "<div class='alert alert-danger px-5  fadeOut'>$message</div>";
                                                }
                                            }
                                            unset($_SESSION['messages']);
                                            unset($_SESSION['status']);
                                        }
                                        ?></div>
                <button type="button" class="switcher switcher-login">
                    Login
                    <span class="underline"></span>
                </button>

                <form action="login.php" method="POST" class="form form-login">

                    <fieldset>

                        <legend>Please, enter your email and password for login.</legend>
                        <div class="input-block">
                            <label for="email-login">E-mail</label>
                            <input id="email-login" name="email-login" type="email" required>
                        </div>
                        <div class="input-block">
                            <label for="password-login">Password</label>
                            <input id="password-login" name="password-login" type="password" required>
                            <small class="form-text text-muted">Password needs to be at least 8 characters long, contain uppercase, special character and a number!</small>
                        </div>
                    </fieldset>
                    <button type="submit" class="btn-login">Login</button>
                </form>
            </div>
            <div class="form-wrapper">
                <button type="button" class="switcher switcher-signup">
                    Sign Up
                    <span class="underline"></span>
                </button>
                <form action="register.php" method="POST" class="form form-signup">
                    <fieldset>
                        <legend>Please, enter your email, password and password confirmation for sign up.</legend>
                        <div class="input-block">
                            <label for="firstname">Firstname:</label>
                            <input id="firstname" name="firstname" type="text" required>
                        </div>
                        <div class="input-block">
                            <label for="lastname">Lastname:</label>
                            <input id="lastname" name="lastname" type="text" required>
                        </div>
                        <div class="input-block">
                            <label for="email">E-mail</label>
                            <input id="email" name="email" type="text" required>
                        </div>
                        <div class="input-block">
                            <label for="password">Password</label>
                            <input id="password" name="password" type="password" required>
                            <small class="form-text text-muted">Password needs to be at least 8 characters long, contain uppercase, special character and a number</small>
                        </div>
                    </fieldset>
                    <button type="submit" class="btn-signup">Sign Up</button>
                </form>
            </div>
        </div>
    </section>


    <script src="log_in_form.js"></script>
</body>

</html>