<nav>
    <div id="logo">
        <a class="navbar-brand" href="index.php">
            <img id="logoImg" src="images/Logo.png" alt="logo">
        </a>
    </div>

    <div class="navDiv">
        <?php if (isset($_SESSION['email'])) : ?>
            <form action="log_out_form.php" method="POST" class="log_in_form">
                <?php if (isset($_SESSION['name'])) : ?>
                    <div class="name h5" id="name" style="color:white; display:inline-block;">
                        <?= "Hi " . $_SESSION['name'] . "!" ?><i class="fa-regular fa-hand"></i>
                    </div>
                <?php endif; ?> <button id="logOut" class="navBtn" name="logout" type="submit">Log Out</button>
            </form>
        <?php else : ?>
            <form method="POST" class="log_in_form" action="log_in_form.php">
                <button id="logIn" class="navBtn" type="submit">Log In</button>
            </form>
        <?php endif; ?>
    </div>

</nav>