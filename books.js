$(document).ready(function () {
    let bookForm = $('#book_form');
    let book_title = $('#book_title');
    let year_published = $('#year_published');
    let number_of_pages = $('#pages');
    let authors_section = $('#author_name');
    let picture_url = $('#picture');
    let categories_select = $('#book_category');
    function loadData() {
        categories_select.empty();
        authors_section.empty();
        $.ajax({
            url: 'http://localhost/project_02/apis/get_all_categories.php',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                let categories = response;
                categories.forEach(category => {
                    let title = category.title;
                    let id = category.id;
                    let option = $('<option></option>').text(title).attr('value', id);
                    categories_select.append(option);
                });
            },
            error: function (error) {
                console.log('Error loading categories:', error);
            }
        });
        $.ajax({
            url: 'http://localhost/project_02/apis/get_authors.php',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                let authors = response;
                authors.forEach(author => {
                    let name = `${author.first_name} ${author.last_name}`;
                    let id = author.id;
                    let option = $('<option></option>').text(name).attr('value', id);
                    authors_section.append(option);
                });
            },
            error: function (error) {
                console.log('Error loading authors:', error);
            }
        });
        $.ajax({
            url: 'http://localhost/project_02/apis/get_books.php',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                let books = response;
                $('#tbBody3').empty();
                books.forEach(book => {
                    let title = book.title;
                    let author_name = book.author_name;
                    let book_category = book.category_title;
                    let number_of_pages = book.number_of_pages;
                    let published_year = book.published;
                    let tr = $('<tr></tr>');
                    $('<td></td>').text(title).appendTo(tr);
                    $('<td></td>').text(author_name).appendTo(tr);
                    $('<td></td>').text(number_of_pages).appendTo(tr);
                    $('<td></td>').text(published_year).appendTo(tr);
                    $('<td></td>').text(book_category).appendTo(tr);
                    let td8 = $('<td></td>');
                    let picture = $('<img>').attr('src', book.photo).css({
                        width: '50px',
                        height: '50px'
                    });
                    picture.appendTo(td8);
                    let td6 = $('<td></td>');
                    let td7 = $('<td></td>');
                    let btnEdit = $('<button>Edit<i class="fa-regular p-1 fa-pen-to-square"></i></button>');
                    btnEdit.css({
                        'background-color': '#facd50',
                        'border-radius': '7px',
                        'color': 'white',
                        'border': 'none'
                    });
                    btnEdit.attr({
                        'data-toggle': 'modal',
                        'data-target': '#exampleModalBooks'
                    });

                    btnEdit.on('click', function () {
                        $.ajax({
                            url: 'http://localhost/project_02/apis/get_all_categories.php',
                            type: 'GET',
                            dataType: 'json',
                            success: function (response) {
                                let categories = response;
                                $('#book_category_edit').empty();
                                categories.forEach(category => {
                                    let option = $('<option></option>').text(category.title).attr('value', category.id);
                                    $('#book_category_edit').append(option);
                                });
                            },
                            error: function (error) {
                                console.log('Error loading categories:', error);
                            }
                        });
                        $.ajax({
                            url: 'http://localhost/project_02/apis/get_authors.php',
                            type: 'GET',
                            dataType: 'json',
                            success: function (response) {
                                let authors = response;
                                $('#author_name_edit').empty();
                                authors.forEach(author => {
                                    let name = `${author.first_name} ${author.last_name}`;
                                    let option = $('<option></option>').text(name).attr('value', author.id);
                                    $('#author_name_edit').append(option);
                                });
                            },
                            error: function (error) {
                                console.log('Error loading authors:', error);
                            }
                        });

                        $('#book_title_edit').val(title);
                        $('#year_published_edit').val(published_year);
                        $('#pages_edit').val(number_of_pages);
                        $('#picture_edit').val(book.photo);
                        $('#book_title_edit').data('id', book.id);
                    });

                    let btnDelete = $('<button>Delete<i class="fa-solid px-1 py-1 fa-trash"></i></button>');
                    btnDelete.css({
                        'background-color': '#C54A3C',
                        'border-radius': '7px',
                        'color': 'white',
                        'border': 'none'
                    });


                    btnDelete.on('click', function () {
                        let id = book.id;
                        Swal.fire({
                            title: "Are you sure you want to delete the book?",
                            text: " You won't be able to revert this!",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes, delete it!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: 'http://localhost/project_02/apis/delete_book.php',
                                    type: 'POST',
                                    contentType: 'application/json',
                                    data: JSON.stringify({
                                        id: id
                                    }),
                                    dataType: 'json',
                                    success: function (response) {
                                        let div = $('.errors3');
                                        $('.errors3').empty();
                                        if (response.success) {
                                            let successDiv = $('<div class="alert alert-success fadeOut"></div>').text(response.message);
                                            $('.errors3').append(successDiv);

                                            loadData();
                                        } else if (response.error) {
                                            let errorDiv = $('<div class="alert alert-danger fadeOut"></div>').text(response.message);
                                            $('.errors3').append(errorDiv);
                                        } else if (response.errors) {
                                            response.errors.forEach(function (error) {
                                                let errorDiv = $('<div class="alert alert-danger fadeOut"></div>').text(error.message);
                                                $('.errors3').append(errorDiv);
                                            });
                                        }
                                    },
                                    error: function (err) {
                                        console.log(err);
                                        let div = $('.errors3');
                                        let errorDiv = $('<div class="alert alert-danger fadeOut"></div>').text("Error deleting book");
                                        div.append(errorDiv);
                                    }
                                });
                            }
                        });
                    });


                    td6.append(btnEdit);
                    td7.append(btnDelete);

                    tr.append(td8, td6, td7);
                    $('#tbBody3').append(tr);
                });
            },
            error: function (xhr, status, error) {
                console.error('Error loading books:', xhr.responseText);
            }
        });
    }
    bookForm.on('submit', function (e) {
        e.preventDefault();
        let category_id = categories_select.val();
        let author_id = authors_section.val();
        let book_title_val = book_title.val();
        let year_published_val = year_published.val();
        let number_of_pages_val = number_of_pages.val();
        let picture_url_val = picture_url.val();

        $.ajax({
            url: 'http://localhost/project_02/apis/save_book.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                title: book_title_val,
                number_of_pages: number_of_pages_val,
                author_id: author_id,
                published: year_published_val,
                photo: picture_url_val,
                category_id: category_id
            }),
            dataType: 'json',
            success: function (response) {
                let div = $('.errors3');
                div.empty();
                if (response.success) {
                    let successDiv = $('<div class="alert alert-success fadeOut"></div>').text(response.message);
                    $('.errors3').append(successDiv);

                    $('#book_title').val('');
                    $('#year_published').val('');
                    $('#pages').val('');
                    $('#author_name').val('');
                    $('#picture').val('');
                    $('#book_category').val('');
                    loadData();
                } else if (response.error) {
                    let errorDiv = $('<div class="alert alert-danger fadeOut"></div>').text(response.message);
                    $('.errors3').append(errorDiv);
                } else if (response.errors) {
                    response.errors.forEach(function (error) {
                        let errorDiv = $('<div class="alert alert-danger fadeOut"></div>').text(error.message);
                        $('.errors3').append(errorDiv);
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
    $('#book_form_edit').on('submit', function (e) {
        e.preventDefault();
        let title = $('#book_title_edit').val();
        let book_id = $('#book_title_edit').data('id');
        let book_category_id = $('#book_category_edit').val();
        let author_id = $('#author_name_edit').val();
        let year_published = $('#year_published_edit').val();
        let pages = $('#pages_edit').val();
        let photo = $('#picture_edit').val();

        $.ajax({
            url: 'http://localhost/project_02/apis/edit_book.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                id: book_id,
                title: title,
                category_id: book_category_id,
                number_of_pages: pages,
                author_id: author_id,
                published: year_published,
                photo: photo
            }),
            dataType: 'json',
            success: function (response) {
                let div = $('.errors3');
                div.empty();
                if (response.success) {
                    let successDiv = $('<div class="alert alert-success fadeOut"></div>').text(response.message);
                    div.append(successDiv);

                    loadData();
                } else if (response.error) {
                    let errorDiv = $('<div class="alert alert-danger fadeOut"></div>').text(response.message);
                    div.append(errorDiv);
                } else if (response.errors) {
                    response.errors.forEach(err => {
                        let errorDiv = $('<div class="alert alert-danger fadeOut"></div>').text(err.message);
                        div.append(errorDiv);
                    });
                }
            },
            error: function (err) {
                console.log(err);
                let div = $('.errors3');
                let errorDiv = $('<div class="alert alert-danger fadeOut"></div>').text("Error editing book");
                div.append(errorDiv);
            }
        });

        $('#exampleModalBooks').modal('hide');
    });
    loadData();
});
