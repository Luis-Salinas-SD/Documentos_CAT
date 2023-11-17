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
    <title>Busqueda y Exportación</title>
</head>

<body>
    <?php
    $tipo = $_SESSION['tipo_usuario'];
    if ($tipo == 1) {
    ?>
        <!--! Nav Menu  -->
        <?php include_once('./nav-menu.php') ?>
        <div class="contenedor">

            <!-- Header -->
            <div class="card m-2 shadow bg-vino">
                <div class="card-body">
                    <h2>Búsqueda y Exportación a:</h2>
                </div>
            </div>

            <!-- Contenido -->

            <div class="card mt-5 mx-2 shadow">
                <div class="cad-body">

                    <div class="table-responsive m-3 p-3">
                        <table class="table table-bordered print-friendly hover" id="busquedaExport">
                            <thead>
                                <tr class="text-center">
                                    <th>No.</th>
                                    <th>Fecha</th>
                                    <th>Documento</th>
                                    <th>Emitido</th>
                                    <th>Descripción</th>
                                    <th>Turnado</th>
                                    <th>Estatus</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $i = 1;
                                require('./bd/conndb1.php');
                                $conexion = getConn();

                                $i = 1;
                                $_pagi_sql = "SELECT * FROM tbl_docs,tbl_asignados, tbl_usuarios, cat_areas, cat_conceptos, tbl_resolucion
                                            WHERE tbl_asignados.idfolio=tbl_docs.Idfolio
                                            and tbl_asignados.cvesp=tbl_usuarios.id_usuario
                                            and tbl_resolucion.docref=tbl_docs.Idfolio
                                            and tbl_asignados.idconcepto=cat_conceptos.Id
                                            and tbl_asignados.cvesp=tbl_resolucion.sprecibe
                                            and tbl_usuarios.idarea=cat_areas.Id
                                            and tbl_docs . fechaact >= '2019-01-01'
                                            order by tbl_docs . idfolio asc";

                                //and fecha >='2019-01-01'
                                $_pagi_result = $conexion->query($_pagi_sql);
                                $numfilas = $_pagi_result->rowCount();
                                if ($numfilas == 0) {
                                    echo '<script>alert(" NO CUENTA CON REGISTROS EN ESTA SECCION ")</script>';
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

                                                <td> <?php echo $idfolio = $row['idfolio']; ?></td>
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


                                                    <td class="text-center">
                                                        <div class="alert alert-amarillo" style="width: 105px;">
                                                            <span>En proceso...</span>
                                                        </div>
                                                    </td>
                                                <?php

                                                } else {

                                                ?>
                                                    <td class="text-center">
                                                        <!-- <strong>Finalizado</strong>-->
                                                        <form name="resolucion" method="post" action="./resolucion2.php">
                                                            <input type="hidden" name="idfolio" value="<?php echo $idfolio; ?>">
                                                            <input type="submit" name="resolucion" class="alert alert-verde" value="Finalizado">
                                                        </form>

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




        </div>

        <!-- Page-Level Scripts -->
        <script>
            /*
            $(document).ready(function() {
                $('.dataTables-example').DataTable({
                    pageLength: 25,
                    responsive: true,
                    dom: '<"html7buttons"B>lTfgitp',
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
            });
            */
        </script>
    <?php
    } elseif ($tipo == 2) {

        header("Location:tabla_super.php");
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