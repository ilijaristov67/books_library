$(document).ready(function () {
    let param = new URLSearchParams(window.location.search);
    let id = param.get('id');

    $.ajax({
        url: 'http://localhost/project_02/apis/get_single_book.php',
        type: 'GET',
        data: { id: id },
        dataType: 'json',
        success: function (response) {

            console.log(response.photo);
            $('#pic').attr('src', response.photo);
            $('#title').text(response.title);
            $('#author').text(response.author_name);
            $('#year_publish').text(response.published);
            $('#pages_no').text(response.number_of_pages);
            $('#category').text(response.category_title);
        },
        error: function (err) {
            console.log(err);
        }
    });

    let comments_form = $('#comments_form');
    comments_form.on('submit', function (e) {
        e.preventDefault();
        let user_id = sessionId;
        let book_id = id;
        let comment = $("#comment").val();
        console.log(user_id);
        $.ajax({
            url: 'http://localhost/project_02/apis/save_comment.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                user_id: user_id,
                description: comment,
                book_id: book_id
            }),
            dataType: 'json',
            success: function (response) {
                let div = $(".msg");
                div.empty();
                if (response.success) {
                    let successDiv = $('<div class="alert alert-success fadeOut"></div>').text('Comment saved successfully');
                    div.append(successDiv);
                    $("#comment").val("");
                } else {
                    let errorDiv = $('<div class="alert alert-danger fadeOut"></div>').text('Failed to save comment');
                    div.append(errorDiv);
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
            }
        });
    });
    let book_id = id;

    $.ajax({
        url: 'http://localhost/project_02/apis/get_approved_comments.php',
        type: 'GET',
        data: {
            book_id: book_id
        },
        dataType: 'json',
        success: function (response) {
            let tBody = $('.table_body_comments');

            response.forEach(comment => {
                let tr = $('<tr></tr>');
                let th = $('<th scope="row"></th>').text('Comment:');
                let td = $('<td></td>').text(comment.description);
                tr.append(th);
                tr.append(td);
                tBody.append(tr);
            });
        },
        error: function (err) {
            console.log(err);
        }
    });
    let user_id = sessionId;

    $.ajax({
        url: 'http://localhost/project_02/apis/get_own_comments.php',
        type: 'GET',
        data: {
            user_id: user_id,
            book_id: book_id
        },
        dataType: 'json',
        success: function (response) {
            let tBody = $('.table_body_comments');

            response.forEach(comment => {
                let tr = $('<tr></tr>');
                let th = $('<th scope="row"></th>').text('Comment:');
                let td = $('<td></td>').text(comment.description);
                let btnDelete = $('<button class="mx-5">Delete<i class="fa-solid px-1 py-1 fa-trash"></i></button>');
                btnDelete.css({
                    'background-color': '#C54A3C',
                    'border-radius': '7px',
                    'color': 'white',
                    'border': 'none'
                });

                btnDelete.on('click', function (e) {
                    let id = comment.id;
                    $.ajax({
                        url: 'http://localhost/project_02/apis/delete_comment.php',
                        type: 'GET',
                        data: { id: id },
                        dataType: 'json',
                        success: function (response) {
                            console.log(response)
                        }, error(err) {
                            console.log(err)
                        }
                    })
                })
                tr.append(th);
                td.append(btnDelete);
                tr.append(td);

                tBody.append(tr);
            });
        },
        error: function (err) {
            console.log(err);
        }
    });


    $.ajax({
        url: 'http://localhost/project_02/apis/get_all_comments.php',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            let tBody = $('.manage_comms_tb');
            console.log(response);
            response.forEach(comment => {
                let tr = $('<tr></tr>');
                let td = $('<td></td>').text(comment.description);

                let btnApprove = $('<button class="mx-5" >Approve<i class="fa-regular p-1 fa-pen-to-square"></i></button>');
                let btnDisapprove = $('<button class="mx-5" >Approve<i class="fa-regular p-1 fa-pen-to-square"></i></button>');

                btnApprove.css({
                    'background-color': '#facd50',
                    'border-radius': '7px',
                    'color': 'white',
                    'border': 'none'
                });

                btnDisapprove.css({
                    'background-color': '#C54A3C',
                    'border-radius': '7px',
                    'color': 'white',
                    'border': 'none'
                });
                let td2 = $('<td></td>')
                let td3 = $('<td></td>')
                let td4 = $('<td></td>').text(comment.is_approved);


                btnApprove.on('click', function (e) {
                    let id = comment.id;
                    console.log(comment.id);
                    $.ajax({
                        url: 'http://localhost/project_02/apis/approve_comment.php',
                        type: 'POST',
                        contentType: 'application/json',
                        data: JSON.stringify({
                            id: id
                        }),
                        dataType: 'json',
                        success: function (response) {
                            console.log(response);
                            if (response.success) {

                                td4.text(response.new_status);
                            }
                        },
                        error: function (err) {
                            console.log(err);
                        }
                    });
                });
                btnDisapprove.on('click', function (e) {
                    let id = comment.id;
                    console.log(comment.id);
                    $.ajax({
                        url: 'http://localhost/project_02/apis/disapprove_comment.php',
                        type: 'POST',
                        contentType: 'application/json',
                        data: JSON.stringify({
                            id: id
                        }),
                        dataType: 'json',
                        success: function (response) {
                            console.log(response);
                            if (response.success) {

                                td4.text(response.new_status);
                            }
                        },
                        error: function (err) {
                            console.log(err);
                        }
                    });
                });

                td2.append(btnApprove)
                td3.append(btnDisapprove);

                tr.append(td);
                tr.append(td4);
                tr.append(td2);
                tr.append(td3);
                tBody.append(tr);
            });
        },
        error: function (xhr, status, error) {
            console.log('Error fetching comments:', xhr.responseText);
        }
    });
});



