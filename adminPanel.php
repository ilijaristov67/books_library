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
    <div class="errors">
        <?php
        if (isset($_SESSION['messages']) && isset($_SESSION['status'])) {
            foreach ($_SESSION['messages'] as $message) {
                if ($_SESSION['status'] === 'success') {
                    echo "<div class='alert alert-success fadeOut'>$message</div>";
                } else {
                    echo "<div class='alert alert-danger fadeOut'>$message</div>";
                }
            }
            unset($_SESSION['messages']);
            unset($_SESSION['status']);
        }
        ?>
    </div>

    <!-- categories -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Category:</h5>
                    <button id="modal_close_btn" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit_form" method="POST">
                        <label for="edit_category_tile">Category Title:</label>
                        <input class="my-1" id="edit_category_title" name="edit_category_title" type="text">
                        <button type="submit" class="btn btn-primary mt-3">Save Title</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="adminPanelDiv container">

        <div class="row">
            <div class="col-md-5 my-3 formsForDataB">
                <form method="POST" action="manage_category.php">
                    <h2>Category Form:</h2>
                    <div class="mb-3">
                        <label for="category" class="form-label">Enter Category Title</label>
                        <input type="text" class="form-control" id="category" name="category_name" placeholder="Enter category" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Category</button>
                </form>
            </div>
            <div class="col-md-6 my-3 formsForDataB">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Title:</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody id="tbBody">
                        <!-- Table rows go here -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal for authors -->
        <div class="modal fade" id="exampleModalAuthors" tabindex="-1" aria-labelledby="exampleModalLabelAuthors" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabelAuthors">Edit Authors:</h5>
                        <button id="modal_close_btn" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
                        </button>
                    </div>
                    <div class="modal-body m-3">
                        <form id="edit_authors" method="POST">
                            <div class="row">
                                <label class="l_author" for="edit_first_name">Firstname:</label>
                                <input class="my-1" id="edit_first_name" name="edit_first_name" type="text">
                            </div>
                            <div class="row">
                                <label class="l_author" for="edit_last_name">Lastname:</label>
                                <input class="my-1" id="edit_last_name" name="edit_last_name" type="text">
                            </div>
                            <div class="row">
                                <label class="l_author" for="author_biography">Author Biography:</label>
                                <textarea class="form-control my-1" placeholder="Edit biography" name="author_biography" id="author_biography" style="height: 100px" required></textarea>
                            </div>
                            <button type="submit" class="b_author btn btn-primary mt-3">Save Title</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="errors2"></div>
        <div class="row">

            <div class="col-md-5 my-3 formsForDataB">

                <form id="authors_form" method="POST">
                    <h2>Author Form:</h2>
                    <div class="mb-3">
                        <label for="author_f_name" class="form-label">Enter Author First name:</label>
                        <input type="text" class="form-control" id="author_f_name" name="author_f_name" placeholder="Enter firstname" required>
                    </div>
                    <div class="mb-3">
                        <label for="author_l_name" class="form-label">Enter Author Last name:</label>
                        <input type="text" class="form-control" id="author_l_name" name="author_l_name" placeholder="Enter lastname" required>
                    </div>
                    <div class="mb-3">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" name="author_bio" id="author_bio" style="height: 100px" required></textarea>
                            <label for="author_bio">Author Biography:</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Author</button>
                </form>
            </div>
            <div class="col-md-6 my-3 formsForDataB">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">First name:</th>
                                <th scope="col">Last name:</th>
                                <th scope="col">Biography:</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody id="tbBody2">
                            <!-- books -->
                            <div class="modal fade" id="exampleModalBooks" tabindex="-1" aria-labelledby="exampleModalBooks" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabelBooks">Edit Book:</h5>
                                            <button id="modal_close_btn" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>
                                            </button>
                                        </div>
                                        <div class="modal-body m-3">
                                            <form id="book_form_edit" method="POST">
                                                <h2>Create Book:</h2>
                                                <div class="row equal-height-cols">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="book_title_edit" class="form-label">Book Title:</label>
                                                            <input type="text" class="form-control" id="book_title_edit" name="book_title_edit" placeholder="Enter book title" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="year_published_edit" class="form-label">Year Published:</label>
                                                            <input type="date" class="form-control" id="year_published_edit" name="year_published_edit" placeholder="Enter year published" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="pages_edit" class="form-label">Number Of Pages:</label>
                                                            <input type="number" class="form-control" id="pages_edit" name="pages_edit" placeholder="Enter number of pages" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="author_name_edit">Choose an author:</label>
                                                            <select id="author_name_edit" name="author_name_edit" class="form-control" required>
                                                                <option disabled selected>Select an author</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="picture_edit" class="form-label">Picture:</label>
                                                            <input type="text" class="form-control" id="picture_edit" name="picture_edit" placeholder="Enter picture URL" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="book_category_edit" class="form-label">Choose Category:</label>
                                                            <select id="book_category_edit" name="book_category_edit" class="form-control" required>
                                                                <option disabled selected>Select a category</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Save Book</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="errors3"></div> -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="container adminPanelDiv">
        <div class="errors3"></div>
        <div class="row">

            <div class="col-md-11 my-3 formsForDataB">
                <form id="book_form" method="POST">
                    <h2>Create Book:</h2>
                    <div class="row equal-height-cols">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="book_title" class="form-label">Book Title:</label>
                                <input type="text" class="form-control" id="book_title" name="book_title" placeholder="Enter book title" required>
                            </div>
                            <div class="mb-3">
                                <label for="year_published" class="form-label">Year Published:</label>
                                <input type="date" class="form-control" id="year_published" name="year_published" placeholder="Enter year published" required>
                            </div>
                            <div class="mb-3">
                                <label for="pages" class="form-label">Number Of Pages:</label>
                                <input type="number" class="form-control" id="pages" name="pages" placeholder="Enter number of pages" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="author_name">Choose an author:</label>
                                <select id="author_name" name="author_name" class="form-control" required>
                                    <option disabled selected>Select an author</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="picture" class="form-label">Picture:</label>
                                <input type="text" class="form-control" id="picture" name="picture" placeholder="Enter picture URL" required>
                            </div>
                            <div class="mb-3">
                                <label for="book_category" class="form-label">Choose Category:</label>
                                <select id="book_category" name="book_category" class="form-control" required>
                                    <option disabled selected>Select a category</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Book</button>
                </form>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Book Title:</th>
                        <th scope="col">Author Name:</th>
                        <th scope="col">Number of Pages:</th>
                        <th scope="col">Published:</th>
                        <th scope="col">Category:</th>
                        <th scope="col">Picture:</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody id="tbBody3">

                </tbody>
            </table>
        </div>
    </div>
    <footer id="footer">
        <div id="footer_div">

        </div>
    </footer>


    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="categories.js"></script>
    <script src="authors.js"></script>
    <script src="books.js"></script>
    <script src="footer.js"></script>
</body>

</html>