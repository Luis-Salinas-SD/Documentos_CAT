/* let btn = document.querySelector('#cerrar');
let menu = document.querySelector('#menu');
let content = document.querySelector('.contenedor');
let btnShow = document.querySelector('.mostrar');



btn.addEventListener("click", () => {
    menu.classList.add('ocultar-menu');
    content.classList.toggle('content-full')
})

btnShow.addEventListener('click', () => {
    menu.classList.add('mostrar-menu');
    content.classList.remove('content-full');
    content.classList.add('contenedor');
    setTimeout(function () {
        location.reload();
    }, 700);
}) */

let menu = document.querySelector('#menu')
let btnCerrar = document.querySelector('#cerrar')
let btnMostrar = document.querySelector('#mostrar')
let content = document.querySelector('.contenedor')

btnCerrar.addEventListener('click', () => {
    menu.classList.toggle('ocultar-menu')
    menu.classList.remove('mostrar-menu')

    content.classList.toggle('content-full')
    content.classList.remove('contenedor')
})

btnMostrar.addEventListener('click', () => {
    menu.classList.toggle('mostrar-menu');
    menu.classList.remove('ocultar-menu');

    content.classList.toggle('contenedor');
    content.classList.remove('content-full');
})