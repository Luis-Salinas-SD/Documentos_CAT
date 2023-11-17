let listElements = document.querySelectorAll('.list__button--click');

listElements.forEach(listElement => {
    listElement.addEventListener('click', () => {

        listElement.classList.toggle('arrow');

        let height = 0;
        let menu = listElement.nextElementSibling;
        if (menu.clientHeight == "0") {
            height = menu.scrollHeight;
        }

        menu.style.height = `${height}px`;

    })
});


$(document).ready(function () {
    $("a.external").on('click', function () {
        url = $(this).attr("href");
        window.open(url, '_blank');
        return false;
    });
});


function mensaje() {
    console.log('Hola Mundo');
}