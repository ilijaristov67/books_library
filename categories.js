$(document).ready(function () {
    // Function to load the table data
    function loadCategoryTable() {
        $('#tbBody').empty();
        $.ajax({
            url: 'http://localhost/project_02/apis/get_all_categories.php',
            type: 'GET',
            dataType: 'json',
            success: function (categories) {
                categories.forEach(element => {
                    if (element['is_deleted'] === 0) {
                        let tr = $('<tr></tr>');
                        let td2 = $('<td></td>').text(element['title']);
                        let td4 = $('<td></td>');
                        let td5 = $('<td></td>');
                        let btnEdit = $('<button>Edit<i class="fa-regular p-1 fa-pen-to-square"></i></button>');
                        let btnDelete = $('<button>Delete<i class="fa-solid px-1 py-1 fa-trash"></i></button>');
                        btnEdit.css({
                            'background-color': '#facd50',
                            'border-radius': '7px',
                            'color': 'white',
                            'border': 'none'
                        });
                        btnEdit.attr({
                            'data-toggle': 'modal',
                            'data-target': '#exampleModal',
                        });

                        btnDelete.css({
                            'background-color': '#C54A3C',
                            'border-radius': '7px',
                            'color': 'white',
                            'border': 'none'
                        });

                        btnEdit.on('click', function (e) {
                            $('#edit_category_title').val(element['title']);
                            $('#edit_category_title').data('id', element['id']);
                        });

                        btnDelete.on('click', function (e) {
                            let id = element['id'];
                            $.ajax({
                                url: 'http://localhost/project_02/apis/delete_category.php',
                                type: 'POST',
                                contentType: 'application/json',
                                data: JSON.stringify({ id: id }),
                                dataType: 'json',
                                success: function (response) {
                                    let div = $(".errors");
                                    div.empty();
                                    if (response.success) {
                                        let successDiv = $('<div class="alert alert-success fadeOut"></div>').text('Category successfully deleted');
                                        div.append(successDiv);
                                        loadCategoryTable();
                                    } else {
                                        let errorDiv = $('<div class="alert alert-danger fadeOut"></div>').text('Category is deleted already');
                                        div.append(errorDiv);
                                    }
                                },
                                error: function (xhr, status, error) {
                                    console.error('Error:', error);
                                }
                            });
                        });

                        td4.append(btnEdit);
                        td5.append(btnDelete);
                        tr.append(td2, td4, td5);
                        $('#tbBody').append(tr);
                    }
                });
            },
            error: function (error) {
                console.log('Error fetching categories:', error);
            }
        });
    }

    $('#edit_form').on('submit', function (e) {
        e.preventDefault();
        let title = $('#edit_category_title').val();
        let id = $('#edit_category_title').data('id');
        console.log(id)
        $.ajax({
            url: 'http://localhost/project_02/apis/edit_category.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                id: id,
                title: title
            }),
            dataType: 'json',
            success: function (response) {
                let div = $(".errors");
                div.empty();
                if (response.success) {
                    let successDiv = $('<div class="alert alert-success fadeOut"></div>').text('Category successfully edited');
                    div.append(successDiv);
                    $('#edit_category_title').val("");
                    loadCategoryTable();
                } else {
                    let errorDiv = $('<div class="alert alert-danger fadeOut"></div>').text('Name already exists');
                    div.append(errorDiv);
                }
            },
            error: function (err) {
                console.log("Error:" + err);
            }

        });
        $('#exampleModal').modal('hide');
    });
    loadCategoryTable();

});
