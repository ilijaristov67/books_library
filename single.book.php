<?php
require_once __DIR__ . "/partials/header.php";
require_once __DIR__ . "/partials/navbar.php";
?>

<body>
    <?php

    if (isset($_SESSION['role_id']) && $_SESSION['role_id'] === 1) :
    ?>
        <div class="admin_div">
            <a href="adminPanel.php"><button id="admin_panel_btn" type="submit">Admin Panel</button></a>
            <a href="comments_section.php"><button id="comments_section" type="submit"> Comments Section</button></a>
        </div>
    <?php endif; ?>

    <h1 class="book_heading">Book Info:</h1>
    <div class="msg"></div>
    <div class="card_holder">
        <div class="row">
            <div class="col-md-6">
                <img id="pic" class="img-fluid" alt="Book Cover">
            </div>
            <div id="info" class="col-md-6">
                <?php

                if (isset($_SESSION['email'])) :
                ?>
                    <div class="comment_section">
                        <form id="comments_form" method="POST">
                            <label for="comment">Leave a comment:</label>
                            <textarea name="comment" id="comment"></textarea>
                            <button class="btn btn_comment" type="submit">Leave comment</button>
                        </form>
                    </div>
                <?php endif; ?>

                <table class="table table-striped">
                    <tbody class="table_body_comments">
                        <tr>
                            <th scope="row">Title:</th>
                            <td id="title"></td>
                        </tr>
                        <tr>
                            <th scope="row">Author:</th>
                            <td id="author"></td>
                        </tr>
                        <tr>
                            <th scope="row">Year of Publishing:</th>
                            <td id="year_publish"></td>
                        </tr>
                        <tr>
                            <th scope="row">Number of Pages:</th>
                            <td id="pages_no"></td>
                        </tr>
                        <tr>
                            <th scope="row">Category:</th>
                            <td id="category"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <footer id="footer">
        <div id="footer_div">
        </div>
    </footer>
    <script>
        var sessionId = "<?php echo isset($_SESSION['id']) ? $_SESSION['id'] : ''; ?>";
    </script>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="index.js"></script>
    <script src="index_books.js"></script>
    <script src="footer.js"></script>
    <script src="single_book.js"></script>

</body>