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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/titulo.css" />
    <link href="css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/dataTables/datatables.min.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>

</head>

<body>
    <?php
    $tipo = $_SESSION['tipo_usuario'];
    if ($tipo == 1) {
    ?>
        <div class="container">
            <header class="row">
                <div class="center" id="titulo">
                    <!-- <H1>HEADER</H1> -->
                </div>
            </header>
            <p>
            <section class="contenedor-main row">
                <div class="col-sm-2"> <!-- Inicio Menú -->
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Menú </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                            <a class="dropdown-item" href="./tabla_admon.php">PÁGINA PRINCIPAL</a>
                            <a class="dropdown-item" href="./form_nuevo.php"> REGISTRO NUEVO </a>
                            <a class="dropdown-item" href="./tabla_excel.php">BUSCAR Y EXPORTAR A:</a>

                        </div>
                    </div>

                </div> <!-- FIN Menú-->


                <main class="col-md-8">
                    <table class="table table-striped" id="cabecera">
                        <td><a><strong><?php echo $_SESSION['nombre']; ?></strong></a> </td>
                        <td><a class="external" href="./Manuales/admon.pdf">
                                <input class="ayuda" type="image" src="./img/help.png" alt="Ayuda" title="Ayuda">
                            </a>
                        </td>
                    </table>
                </main>


                <div class="col-sm-2">
                    <table class="table">
                        <td width="350" align="right"><a href="desconectar.php" class="btn btn-info"> Cerrar Sesion </a></td>
                    </table>
                    <!-- Lado derecho -->
                </div>
            </section>

            <div class="row">
                <div class="col-12">

                    <div class="center" style="text-align: center;">
                        <h2>

                            CONTROL DE DOCUMENTOS

                        </h2>
                    </div>
                    <div class="table-responsive-xl">
                        <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                                <tr>
                                    <th class="center">No.</th>
                                    <th class="center"> Fecha</th>
                                    <th class="center"> Oficio </th>
                                    <th class="center"> Remitente</th>
                                    <th class="center"> Concepto</th>
                                    <th class="center">Estatus/Acciones</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                require('./bd/conndb1.php');
                                $conexion = getConn();

                                $i = 1;

                                $sql = "SELECT * FROM tbl_docs
                                        WHERE fechaact >= '2019-01-01'
                                        order by Idfolio desc";

                                //and fecha >='2019-01-01'
                                $result = $conexion->query($sql);
                                $numfilas = $result->rowCount();
                                if ($numfilas == 0) {
                                    echo '<script>msmNoRegisters()</script>';
                                ?>

                                    <?php

                                } else {

                                    while ($i <= 1) {
                                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                            $x = $i;
                                            $asignar = $row['asignar'];
                                            $idfolio = $row['Idfolio'];
                                            $fecha_doc = $row['fecha_doc'];
                                            $docreferencia = $row['docreferencia'];
                                            utf8_decode($remitente = $row['remitente']);
                                            utf8_decode($descripcion = $row['descripcion']);


                                            if ($asignar == 0) {

                                                // include("./nuevo2.php");
                                    ?>
                                                <tr>
                                                    <td class="center">
                                                        <?php echo $idfolio; ?>
                                                    </td>

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
                                                        <div class="alert-info">
                                                            SIN ASIGNAR
                                                        </div>
                                                        <br>
                                                        <form name="modificar" method="post" action="./modificar.php">
                                                            <input type="hidden" name="idfolio" value="<?php echo $idfolio; ?>">
                                                            <input type=submit class=" btn-success" name="modificar" value="Modificar">

                                                        </form>
                                                    </td>



                                                <?php
                                            } else {

                                                // include("./asignados.php"); 

                                                ?>
                                                <tr>
                                                    <td class="center">
                                                        <?php echo $idfolio; ?>
                                                    </td>
                                                    <td class="center">
                                                        <?php echo $fecha_doc; ?>
                                                    </td>
                                                    <td class="center">
                                                        <?php echo $docreferencia; ?>
                                                    </td>
                                                    <td class="center">
                                                        <?php echo $remitente; ?>
                                                    </td>
                                                    <td class="center">
                                                        <?php echo $descripcion; ?>
                                                    </td>

                                                    <?php

                                                    $sql = "SELECT COUNT(*) as total , estatus FROM tbl_resolucion  
                                                    WHERE docref =$idfolio
                                                    and estatus=1";
                                                    $resul = $conexion->query($sql);
                                                    $row = $resul->fetch(PDO::FETCH_ASSOC);
                                                    if ($row['total'] >= 1) {
                                                    ?>
                                                        <td class="center">
                                                            <div class="alert-success">
                                                                EN PROCESO

                                                            </div>
                                                            <br>
                                                            <form name="resolucion" method="post" action="./resolucion2.php">
                                                                <input type="hidden" name="idfolio" value="<?php echo $idfolio; ?>">
                                                                <input type="submit" name="resolucion" class=" btn-info" value="RESOLUCION">

                                                            </form>
                                                            <br>
                                                            <form name="modificar" method="post" action="./modificar.php">
                                                                <input type="hidden" name="idfolio" value="<?php echo $idfolio; ?>">
                                                                <input type=submit class=" btn-success" name="modificar" value="Modificar">

                                                            </form>
                                                            <br>

                                                            <?php
                                                            $usu = $_SESSION['id_usuario'];

                                                            $query = "SELECT * FROM tbl_docs, tbl_asignados, tbl_resolucion
                                                                    WHERE tbl_docs.fechaact >= '2019-01-01'
                                                                    and tbl_asignados.cvesp=$usu
                                                                    and tbl_resolucion.estatus=1
                                                                    and tbl_asignados.cvesp=tbl_resolucion.sprecibe
                                                                    and tbl_asignados.idfolio=tbl_docs.Idfolio
                                                                    and tbl_docs.idfolio=tbl_resolucion.docref
                                                                    and tbl_asignados.idfolio=$idfolio
                                                                    order by tbl_docs.idfolio desc";

                                                            $resul = $conexion->query($query);

                                                            //  $numfilas = $query->rowCount();
                                                            $row = $resul->fetch(PDO::FETCH_ASSOC);

                                                            $usuarios = $row['cvesp'];

                                                            echo $query;


                                                            if ($usuarios <> $usu) {
                                                            ?>


                                                            <?php
                                                            } else {

                                                            ?>

                                                                <a href="resolucion.php?idfolio=<?php echo $idfolio; ?>" class="spinner-border text-warning">
                                                                    <input type=image src="./img/notificacion.png" name="notificacion"></a>
                                                            <?php

                                                            }
                                                            //}
                                                            ?>
                                                        </td>


                                                    <?php
                                                    } else
                                                            if ($row['total'] == 0) {
                                                    ?>

                                                        <td class="center">
                                                            <div class=" alert-danger">
                                                                <strong>FINALIZADO</strong>
                                                            </div>
                                                            <br>
                                                            <form name="resolucion" method="post" action="./resolucion2.php">
                                                                <input type="hidden" name="idfolio" value="<?php echo $idfolio; ?>">
                                                                <input type="submit" name="resolucion" class=" btn-warning" value="VER DETALLE">

                                                            </form>
                                                        </td>

                                                <?php

                                                    }
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
        </div>
        </div>


        </div>
        </div>
        <!-- Page-Level Scripts -->
        <script>
            $(document).ready(function() {
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
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("a.external").on('click', function() {
                    url = $(this).attr("href");
                    window.open(url, '_blank');
                    return false;
                });
            });
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
</body>

</html>