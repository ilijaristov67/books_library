$(document).ready(function () {
    let footer = $("#footer_div");
    let p = $("<p></p>");
    p.css({
        'text-align': 'center',
        'margin': '0'
    });


    fetch('http://api.quotable.io/random')
        .then(response => response.json())
        .then(data => {
            // console.log(data.content);
            p.text(data.content);
            p.appendTo(footer);
        })
        .catch(error => {
            console.error('Error fetching quote:', error);
        });
});
