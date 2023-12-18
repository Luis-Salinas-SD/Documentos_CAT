<!DOCTYPE html>
<?php

session_start();
if (@!$_SESSION['cvesp']) {
    header("Location:index.php");
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, width=device-width">
    <!-- CSS y Scripts -->
    <?php include_once('./templates/header.php') ?>
    <title>Búsqueda y Exportación A</title>
</head>

<body>
    <?php
    $tipo = $_SESSION['tipo_usuario'];
    if ($tipo == 2) {
    ?>
        <?php include_once('./nav-menu.php') ?>

        <div class="contenedor">

            <div class="card m-2 shadow bg-vino">
                <div class="card-body">
                    <h3>Búsqueda y exportación:</h3>
                </div>
            </div>

            <div class="card mt-5 mx-2 shadow">
                <div class="table-responsive m-3 p-3">
                    <table class="table table-bordered print-friendly hover" id="dosTable">
                        <thead>
                            <tr>
                                <th style="width: 65px;">Fecha</th>
                                <th>Documento</th>
                                <th>Emitido</th>
                                <th>Descripción</th>
                                <th style="width: 180px;">Turnado</th>
                                <th>Estatus</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $i = 1;
                            require('./bd/conndb1.php');
                            $conexion = getConn();

                            $idarea = $_SESSION['idarea'];
                            $i = 1;
                            $_pagi_sql = "SELECT * FROM tbl_docs,tbl_asignados, tbl_usuarios, cat_areas, cat_conceptos, tbl_resolucion
                                            WHERE tbl_asignados.idfolio=tbl_docs.Idfolio
                                            and tbl_asignados.cvesp=tbl_usuarios.id_usuario
                                            and tbl_resolucion.docref=tbl_docs.Idfolio
                                            and tbl_asignados.idconcepto=cat_conceptos.Id
                                            and tbl_asignados.cvesp=tbl_resolucion.sprecibe
                                            and tbl_usuarios.idarea=cat_areas.Id
                                            and tbl_usuarios.idarea=$idarea
                                            and tbl_docs . fechaact >= '2019-01-01'
                                            order by tbl_docs . idfolio asc";

                            //and fecha >='2019-01-01'
                            $_pagi_result = $conexion->query($_pagi_sql);
                            $numfilas = $_pagi_result->rowCount();
                            if ($numfilas == 0) {
                                echo '<script>msmNoRegisters()</script>';
                            ?>

                                <?php

                            } else {

                                while ($i <= 1) {
                                    while ($row = $_pagi_result->fetch(PDO::FETCH_ASSOC)) {
                                        $turnado_nombre = $row['nombre'];
                                        $turnado_area = $row['area'];
                                        $turnado = $turnado_nombre . '<br>' . $turnado_area;
                                ?>
                                        <tr>
                                            <td class="center">
                                                <?php echo $row['fecha_doc']; ?>
                                            </td>
                                            <td class="center">
                                                <?php echo $row['docreferencia']; ?>
                                            </td>
                                            <td class="center">
                                                <?php echo $row['remitente']; ?>
                                            </td>
                                            <td class="center">
                                                <?php echo $row['descripcion']; ?>
                                            </td>
                                            <td class="center">
                                                <?php echo $turnado; ?>
                                            </td>
                                            <?php
                                            if ($row['estatus'] == 1) {
                                            ?>


                                                <td class="center">
                                                    <div class="alert alert-amarillo" style="width: 108px;">
                                                        En proceso...
                                                    </div>
                                                </td>
                                            <?php

                                            } else {

                                            ?>
                                                <td class="center">
                                                    <div class="alert alert-verde">
                                                        Finalizado
                                                    </div>
                                                </td>

                                            <?php

                                            }

                                            ?>

                                        </tr>
                            <?php
                                        $i++;
                                    }
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>


        <!-- Page-Level Scripts -->
        <script>
            /* $(document).ready(function() {
                $('.dataTables-example').DataTable({
                    pageLength: 25,
                    responsive: true,
                    dom: '<"html6buttons"B>lTfgitp',
                    buttons: [{
                            extend: 'excel',
                            title: 'DATOS DE TABLA'
                        },
                        {
                            extend: 'print',
                            customize: function(win) {
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
        </script>
    <?php
    } elseif ($tipo == 1) {

        header("Location:tabla_admon.php");
    } elseif ($tipo == 3) {

        header("Location:tabla_usu.php");
    } elseif ($tipo == 4) {

        header("Location:tabla_oficialia.php");
    } else {
        header("Location:index.php");
    }
    ?>

    <?php include_once('./templates/scripts.php') ?>


</body>

</html>