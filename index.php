<?php require_once __DIR__ . "/partials/header.php"; ?>

<body>


    <?php require_once __DIR__ . "/partials/navbar.php"; ?>

    <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] === 1) : ?>
        <div class="admin_div">
            <a href="adminPanel.php"><button id="admin_panel_btn" type="submit">Admin Panel</button></a>
            <a href="comments_section.php"><button id="comments_section" type="submit"> Comments Section</button></a>
        </div>
    <?php endif; ?>

    <div class="container_div">
        <div id="checkbox_container"></div>
    </div>



    <div class="container my-5">
        <div class="row card_container" id="cardContainer"></div>
    </div>

    <footer id="footer">
        <div id="footer_div">

        </div>
    </footer>

    <!-- JavaScript libraries -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="index.js"></script>
    <script src="index_books.js"></script>
    <script src="footer.js"></script>
</body>