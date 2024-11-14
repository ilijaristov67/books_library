$(document).ready(function () {
    $.ajax({
        url: 'http://localhost/project_02/apis/get_books.php',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            const cardData = response;
            const cardContainer = $('#cardContainer');

            cardData.forEach(card => {
                const cardCol = $('<div class="col-md-4 mb-4"></div>');
                const book = `
                    <div class="card custom-card-height book_card">
                        <img src="${card.photo}" class="card-img-top" alt="Sample Image">
                        <div class="card-body">
                            <h5 class="card-title">Name of the book: ${card.title}</h5>
                            <p class="card-text">Category: ${card.category_title}</p>
                            <p class="card-text">Author: ${card.author_name}</p>
                            <button class="go_to_book btn" style="background-color:rgba(167, 226, 69, 255); color:white;" data-book-id="${card.id}">Go To Book</button>
                        </div>
                    </div>`;
                cardCol.append(book);
                cardContainer.append(cardCol);
            });
            cardContainer.on('click', '.go_to_book', function (e) {
                const bookId = $(this).data('book-id');
                window.location = `http://localhost/project_02/single.book.php?id=${bookId}`;
            });
        },
        error: function (err) {
            console.log(err);
        }
    });
    $.ajax({
        url: 'http://localhost/project_02/apis/get_all_categories.php',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            let checkBoxContainer = $('#checkbox_container');
            let categories = response;

            categories.forEach(category => {
                let div = $('<div></div>')

                let checkbox = $('<input>').attr({
                    type: 'checkbox',
                    value: category.id,
                    id: category.id
                });
                checkbox.css('margin', '10px');
                let label = $('<label>').text(category.title).attr('for', category.id);
                label.css('color', 'white')
                checkbox.on('change', function (e) {
                    if (e.target.checked) {
                        let id = e.target.value;
                        console.log(id);
                    }
                })
                div.append(label);
                div.append(checkbox);
                checkBoxContainer.append(div);
            });
        },
        error: function (err) {
            console.log(err);
        }
    });

});