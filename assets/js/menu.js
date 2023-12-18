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