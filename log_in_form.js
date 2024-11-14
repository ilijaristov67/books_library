const switchers = [...document.querySelectorAll('.switcher')]

switchers.forEach(item => {
    item.addEventListener('click', function () {
        switchers.forEach(item => item.parentElement.classList.remove('is-active'))
        this.parentElement.classList.add('is-active')
    })
})

document.addEventListener('DOMContentLoaded', (event) => {
    setTimeout(() => {
        const divs = document.getElementsByClassName('fadeOut');
        for (let i = 0; i < divs.length; i++) {
            divs[i].classList.add('fade-out');
            setTimeout(() => {
                divs[i].style.display = 'none';
            }, 1000);
        }
    }, 2000);
});