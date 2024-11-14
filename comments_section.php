<?php
require_once __DIR__ . "/partials/header.php";
?>

<body>
    <?php
    require_once __DIR__ . "/partials/navbar.php";
    if ($_SESSION['role_id'] != 1) {
        header('Location:index.php?error=notAllowed');
        die;
    }

    ?>
    <div class="body_comments">
        <table class="table table_body_comments table-striped">
            <th>Comment</th>
            <th>Is Approved</th>
            <th>Approve</th>
            <th>Disapprove</th>

            <tbody class="manage_comms_tb">

            </tbody>
        </table>
    </div>
    <footer id="footer">
        <div id="footer_div">

        </div>
    </footer>
    <script>
        var sessionId = "<?php echo isset($_SESSION['id']) ? $_SESSION['id'] : ''; ?>";
    </script>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="categories.js"></script>
    <script src="authors.js"></script>
    <script src="books.js"></script>
    <script src="footer.js"></script>
    <script src="single_book.js"></script>
</body>

</html>