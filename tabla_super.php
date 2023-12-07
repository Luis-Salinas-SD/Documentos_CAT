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
    <title>Control de Documentos</title>
</head>

<body>
    <?php
    $tipo = $_SESSION['tipo_usuario'];
    if ($tipo == 2) {
    ?>
        <?php include_once('./nav-menu.php') ?>


        <div class="contenedor">

            <!-- Header -->
            <div class="card m-2 shadow bg-vino">
                <div class="card-body">
                    <h2>Control de Documentos</h2>
                </div>
            </div>

            <!-- Contenido -->
            <div class="card mt-5 mx-2 shadow">
                <div class="card-body">

                    <div class="table-responsive m-3 p-3">
                        <table class="table table-bordered print-friendly hover" id="busquedaExport">
                            <thead>
                                <tr>
                                    <th class="text-center"> No.</th>
                                    <th class="text-center"> Fecha del Documento</th>
                                    <th class="text-center"> Numero de Oficio </th>
                                    <th class="text-center"> Nombre del remitente</th>
                                    <th class="text-center"> Concepto</th>
                                    <th class="text-center"> Estatus</th>
                                    <th class="text-center"> Acciones</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                require('./bd/conndb1.php');
                                $conexion = getConn();
                                $usu = $_SESSION['id_usuario'];
                                $idarea = $_SESSION['idarea'];
                                $i = 1;

                                $_pagi_sql = "SELECT distinct(d.idfolio), d.fecha_doc, d.docreferencia, d.remitente, d.descripcion FROM tbl_docs d, tbl_asignados a where  id_area=$idarea and fechaact >= '2019-01-01' and a.idfolio = d.Idfolio order by d.Idfolio asc";
                                //and fecha >='2019-01-01'
                                $_pagi_result = $conexion->query($_pagi_sql);
                                $numfilas = $_pagi_result->rowCount();
                                if ($numfilas == 0) {
                                    echo '<script>alert(" NO CUENTA CON REGISTROS EN ESTA SECCION ")</script>';
                                } else {

                                    //$_pagi_nav_estilo = "cls_pagi";
                                    //$enlacesdepaginacion = 11;

                                    //include("paginator2.inc.php");

                                    while ($i <= 1) {
                                        //$x = $_pagi_hasta;

                                        while ($row = $_pagi_result->fetch(PDO::FETCH_ASSOC)) {

                                            $idfolio = $row['idfolio'];
                                            $fecha_doc = $row['fecha_doc'];
                                            $docreferencia = $row['docreferencia'];
                                            $remitente = $row['remitente'];
                                            $descripcion = $row['descripcion'];

                                            include("./asignados_super.php");

                                            // }
                                ?>

                                            </tr>
                                <?php
                                            $i++;
                                            //$x--;
                                        }
                                        //$sig = $_Num_regis_Consul + 1;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

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