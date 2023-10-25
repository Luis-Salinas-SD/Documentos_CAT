
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

const optionsData = {
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
            text: 'Excel',
            className: 'btn btn-success m-2 rounded-pill',
            title: 'reporte',

        },
        {
            extend: 'print',
            text: 'PDF',
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
})
