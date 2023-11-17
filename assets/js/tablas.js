
/* $(document).ready(function() {
$('.dataTables-example').DataTable({
pageLength: 15,
responsive: true,
dom: '<"html7buttons"B>lTfgitp',
buttons: [{
    extend: 'excel',
    title: 'DATOS DE TABLA'
},
{
    extend: 'print',
    customize: function (win) {
        $(win.document.body).addClass('white-bg');
        $(win.document.body).css('font-size', '10px');

        $(win.document.body).find('table')
            .addClass('compact')
            .css('font-size', 'inherit');
    }
}
]

});

}); */

let pdf_icon = `
<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-type-pdf" width="25" height="25" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
<path stroke="none" d="M0 0h24v24H0z" fill="none" />
<path d="M14 3v4a1 1 0 0 0 1 1h4" />
<path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />
<path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6" />
<path d="M17 18h2" />
<path d="M20 15h-3v6" />
<path d="M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z" />
</svg>
`

let excel_icon = `
<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-spreadsheet" width="25" height="25" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <path d="M14 3v4a1 1 0 0 0 1 1h4" />
  <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
  <path d="M8 11h8v7h-8z" />
  <path d="M8 15h8" />
  <path d="M11 11v7" />
</svg>
`


const optionsData = {
    order: [1, 'desc'],
    "language": {
        "lengthMenu": 'Mostrar <select>' +
            '<option value="2">2</option>' +
            '<option value="5">5</option>' +
            '<option value="10">10</option>' +
            '<option value="20">20</option>' +
            '<option value="30">30</option>' +
            '<option value="-1">Todas</option>' +
            '</select> registros por página.',
        "zeroRecords": "No existen registros con esos parámetros.",
        "info": "Página _PAGE_ de _PAGES_",
        "infoEmpty": "No existen cédulas.",
        "infoFiltered": "(filtrado para un máximo de _MAX_ registros)",
        "loadingRecords": "Cargando registros...",
        "processing": "Procesando registros...",
        "search": "Buscar en la tabla: ",
        "paginate": {
            "first": "Primero",
            "last": "Último",
            "next": ">",
            "previous": "<"
        }
    },
    responsive: true,
    dom: '<"html7buttons"B>lTfgitp',
    buttons: [
        {
            extend: 'excel',
            text: `${excel_icon}`,
            className: 'btn btn-success m-2 rounded-pill',
            title: 'reporte',

        },
        {
            extend: 'print',
            text: `${pdf_icon}`,
            className: 'btn btn-danger m-2 rounded-pill',
            title: 'reporte',
            customize: function (win) {
                $(win.document.body).addClass('white-bg');
                $(win.document.body).css('font-size', '10px');

                $(win.document.body).find('table')
                    .addClass('compact')
                    .css('font-size', 'inherit');
            }
        }
    ],

}

$(document).ready(function () {
    $('#prueba').DataTable(optionsData);
    $('#busquedaExport').DataTable(optionsData);
    $('#oficialia').DataTable(optionsData);
    $('#dosTable').DataTable(optionsData);

})

const optionsData2 = {
    "language": {
        "lengthMenu": 'Mostrar <select>' +
            '<option value="2">2</option>' +
            '<option value="5">5</option>' +
            '<option value="10">10</option>' +
            '<option value="20">20</option>' +
            '<option value="30">30</option>' +
            '<option value="-1">Todas</option>' +
            '</select> registros por página.',
        "zeroRecords": "No existen registros con esos parámetros.",
        "info": "Página _PAGE_ de _PAGES_",
        "infoEmpty": "No existen cédulas.",
        "infoFiltered": "(filtrado para un máximo de _MAX_ registros)",
        "loadingRecords": "Cargando registros...",
        "processing": "Procesando registros...",
        "search": "Buscar en la tabla: ",
        "paginate": {
            "first": "Primero",
            "last": "Último",
            "next": ">",
            "previous": "<"
        }
    },
    responsive: true,

}

$(document).ready(function () {
    $('#catDocs').DataTable(optionsData2);
})