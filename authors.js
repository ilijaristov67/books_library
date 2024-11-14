$(document).ready(function () {

    function loadAuthorsTable() {
        $('#tbBody2').empty();
        $.ajax({
            url: 'http://localhost/project_02/apis/get_authors.php',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                $('#tbBody2').empty();

                response.forEach(author => {
                    let first_name = author.first_name;
                    let last_name = author.last_name;
                    let biography = author.biography;

                    let tr = $('<tr></tr>');
                    let td1 = $('<td></td>').text(first_name);
                    let td2 = $('<td></td>').text(last_name);
                    let td3 = $('<td></td>').text(biography);
                    let td4 = $('<td></td>');
                    let td5 = $('<td></td>');

                    let btnEdit = $('<button>Edit<i class="fa-regular p-1 fa-pen-to-square"></i></button>');
                    btnEdit.css({
                        'background-color': '#facd50',
                        'border-radius': '7px',
                        'color': 'white',
                        'border': 'none'
                    });
                    btnEdit.attr({
                        'data-toggle': 'modal',
                        'data-target': '#exampleModalAuthors',
                    });
                    btnEdit.on('click', function () {
                        $('#edit_first_name').val(first_name);
                        $('#edit_last_name').val(last_name);
                        $('#author_biography').val(biography);
                        $('#edit_first_name').data('id', author.id)
                    });

                    let btnDelete = $('<button>Delete<i class="fa-solid px-1 py-1 fa-trash"></i></button>');
                    btnDelete.css({
                        'background-color': '#C54A3C',
                        'border-radius': '7px',
                        'color': 'white',
                        'border': 'none'
                    });
                    btnDelete.on('click', function () {
                        let id = author.id;
                        $.ajax({
                            url: 'http://localhost/project_02/apis/delete_author.php',
                            type: 'POST',
                            contentType: 'application/json',
                            data: JSON.stringify({
                                id: id
                            }),
                            dataType: 'json',
                            success: function (response) {
                                let div = $('.errors2');
                                $('.errors2').empty();
                                if (response.success) {
                                    let successDiv = $('<div class="alert alert-success fadeOut"></div>').text(response.message);
                                    $('.errors2').append(successDiv);
                                    $('#author_f_name').val('');
                                    $('#author_l_name').val('');
                                    $('#author_bio').val('');
                                    loadAuthorsTable();
                                } else if (response.error) {
                                    let errorDiv = $('<div class="alert alert-danger fadeOut"></div>').text(response.message);
                                    $('.errors2').append(errorDiv);
                                } else if (response.errors) {
                                    response.errors.forEach(function (error) {
                                        let errorDiv = $('<div class="alert alert-danger fadeOut"></div>').text(error.message);
                                        $('.errors2').append(errorDiv);
                                    });
                                }
                            }, error: function (err) {
                                console.log(err);
                                let div = $('.errors2');
                                let errorDiv = $('<div class="alert alert-danger fadeOut"></div>').text("Error deleting author");
                                div.append(errorDiv);
                            }
                        })
                    });
                    td4.append(btnEdit);
                    td5.append(btnDelete);
                    tr.append(td1, td2, td3, td4, td5);
                    $('#tbBody2').append(tr);
                });
            },
            error: function (error) {
                console.log('Error fetching authors:', error);
                let div = $('.errors2');
                let errorDiv = $('<div class="alert alert-danger fadeOut"></div>').text("Error fetching authors");
                div.append(errorDiv);
            }
        });
    }

    $('#authors_form').on('submit', function (e) {
        e.preventDefault();
        console.log('submitted');

        const first_name = $('#author_f_name').val();
        const last_name = $('#author_l_name').val();
        const biography = $('#author_bio').val();
        console.log(first_name, last_name, biography);
        $.ajax({
            url: 'http://localhost/project_02/apis/add_author.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                first_name: first_name,
                last_name: last_name,
                biography: biography
            }),
            dataType: 'json',
            success: function (response) {
                let div = $('.errors2');
                $('.errors2').empty();
                if (response.success) {
                    let successDiv = $('<div class="alert alert-success fadeOut"></div>').text(response.message);
                    $('.errors2').append(successDiv);
                    $('#author_f_name').val('');
                    $('#author_l_name').val('');
                    $('#author_bio').val('');
                    loadAuthorsTable();
                } else if (response.error) {
                    let errorDiv = $('<div class="alert alert-danger fadeOut"></div>').text(response.message);
                    $('.errors2').append(errorDiv);
                } else if (response.errors) {
                    response.errors.forEach(function (error) {
                        let errorDiv = $('<div class="alert alert-danger fadeOut"></div>').text(error.message);
                        $('.errors2').append(errorDiv);
                    });
                }
            },
            error: function (error) {
                console.log('AJAX Error:', error);
                let div = $('.errors2');
                let errorDiv = $('<div class="alert alert-danger fadeOut"></div>').text("Error adding author");
                div.append(errorDiv);
            }
        });
    });

    $('#edit_authors').on('submit', function (e) {
        e.preventDefault();
        let first_name = $('#edit_first_name').val();
        let last_name = $('#edit_last_name').val();
        let biography = $('#author_biography').val();
        let id = $('#edit_first_name').data('id');
        // console.log(first_name, last_name, biography, id)
        $.ajax({
            url: 'http://localhost/project_02/apis/edit_author.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                id: id,
                first_name: first_name,
                last_name: last_name,
                biography: biography
            }),
            dataType: 'json',
            success: function (response) {
                let div = $('.errors2');
                div.empty();
                if (response.success) {
                    let successDiv = $('<div class="alert alert-success fadeOut"></div>').text(response.message);
                    div.append(successDiv);
                } else if (response.error) {

                    let errorDiv = $('<div class="alert alert-danger fadeOut"></div>').text(response.message);
                    div.append(errorDiv);
                } else if (response.errors) {

                    response.errors.forEach(err => {
                        let errorDiv = $('<div class="alert alert-danger fadeOut"></div>').text(err.message);
                        div.append(errorDiv);
                    });
                }
                loadAuthorsTable();
            }, error: function (err) {
                console.log(err);
                let div = $('.errors2');
                let errorDiv = $('<div class="alert alert-danger fadeOut"></div>').text("Error editing author");
                div.append(errorDiv);
            }
        })
        $('#exampleModalAuthors').modal('hide');
    });

    loadAuthorsTable();
});
