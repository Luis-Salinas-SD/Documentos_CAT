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
    <title>Inicio</title>
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
                    <h2>Control de documentos</h2>
                </div>
            </div>

            <!-- Contenido -->
            <div class="card mt-5 mx-2">
                <div class="card-body">
                    <div class="table-responsive m-3 p-3">
                        <table class="table table-bordered print-friendly" id="prueba">
                            <thead>
                                <tr class="text-center">
                                    <th>No.</th>
                                    <th> Fecha</th>
                                    <th> Oficio </th>
                                    <th> Remitente</th>
                                    <th> Concepto</th>
                                    <th> Estatus</th>
                                    <th> Acciones</th>
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
                                    echo '<script>alert(" NO CUENTA CON REGISTROS EN ESTA SECCION ")</script>';
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
                                                        <div class="alert alert-rojo text-center">
                                                            Sin Asignar
                                                        </div>
                                                    </td>
                                                    <td class="text-start">
                                                        <form name="modificar" method="post" action="./modificar.php">
                                                            <input type="hidden" name="idfolio" value="<?php echo $idfolio; ?>">
                                                            <!-- <input type=submit class=" btn-success" name="modificar" value="Modificar"> -->
                                                            <button type="submit" name="modificar" class="btn btn-warning p-1 m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Modificar">
                                                                <img src="assets/icons/edit.svg">
                                                            </button>
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

                                                    $sql = "SELECT COUNT(*) as total , estatus FROM tbl_resolucion WHERE docref = $idfolio and estatus=1";
                                                    $resul = $conexion->query($sql);
                                                    $row = $resul->fetch(PDO::FETCH_ASSOC);
                                                    if ($row['total'] >= 1) {
                                                    ?>
                                                        <td>
                                                            <div class="alert alert-amarillo text-center" style="width: 118px;">
                                                                En proceso...
                                                            </div>
                                                        </td>
                                                        <td class="d-flex">
                                                            <form name="resolucion" method="post" action="./resolucion2.php">
                                                                <input type="hidden" name="idfolio" value="<?php echo $idfolio; ?>">
                                                                <!-- <input type="submit" name="resolucion" class=" btn-info" value="RESOLUCION"> -->
                                                                <button type="submit" name="resolucion" class="btn btn-success p-1 m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Resolución">
                                                                    <img src="assets/icons/info.svg">
                                                                </button>
                                                            </form>
                                                            <br>
                                                            <form name="modificar" method="post" action="./modificar.php">
                                                                <input type="hidden" name="idfolio" value="<?php echo $idfolio; ?>">
                                                                <!-- <input type=submit class=" btn-success" name="modificar" value="Modificar"> -->
                                                                <button type="submit" name="modificar" class="btn btn-warning p-1 m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Modificar">
                                                                    <img src="assets/icons/edit.svg">
                                                                </button>
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

                                                            if ($usuarios <> $usu) {
                                                            ?>


                                                            <?php
                                                            } else {

                                                            ?>
                                                                <a href="resolucion.php?idfolio=<?php echo $idfolio; ?>" class="spinner-border text-warning m-1">
                                                                    <input type=image src="./img/notificacion.png" name="notificacion" class="icon-noti">
                                                                </a>
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
                                                            <div class="alert alert-verde text-center">
                                                                Finalizado
                                                            </div>
                                                        </td>
                                                        <td class="text-start">
                                                            <form name="resolucion" method="post" action="./resolucion2.php">
                                                                <input type="hidden" name="idfolio" value="<?php echo $idfolio; ?>">
                                                                <!-- <input type="submit" name="resolucion" class=" btn-warning" value="VER DETALLE"> -->
                                                                <button type="submit" name="resolucion" class="btn btn-primary p-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver más">
                                                                    <img src="assets/icons/eye.svg">
                                                                </button>
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


        <!-- Page-Level Scripts -->

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

    <?php include_once('./templates/scripts.php') ?>

</body>

</html>