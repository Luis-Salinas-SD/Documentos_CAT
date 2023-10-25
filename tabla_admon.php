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
            <div class="card m-2 shadow">
                <div class="card-body">
                    <h2>Control de Documentos</h2>
                </div>
            </div>

            <!-- Contenido -->
            <div class="card mt-5 mx-2">
                <div class="card-body">
                    <div class="table-responsive m-3 p-3">
                        <table class="table table-bordered print-friendly" id="prueba">
                            <thead>
                                <tr>
                                    <th class="center">No.</th>
                                    <th class="center"> Fecha</th>
                                    <th class="center"> Oficio </th>
                                    <th class="center"> Remitente</th>
                                    <th class="center"> Concepto</th>
                                    <th class="center">Estatus</th>
                                    <th class="center">Acciones</th>

                                </tr>
                            </thead>
                            <tbody>

                                <?php

                                require('./bd/conndb1.php');
                                $conexion = getConn();
                                $i = 1;

                                $sql = "SELECT * FROM tbl_docs WHERE fechaact >= '2019-01-01' order by Idfolio desc";

                                $result = $conexion->query($sql);
                                $numfilas = $result->rowCount();
                                if ($numfilas == 0) {
                                    echo '<script>alert(" NO CUENTA CON REGISTROS EN ESTA SECCION ")</script>';
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
                                                    <td class="d-flex">
                                                        <div class="text-danger" style="width: 90px;">
                                                            <b>Sin Asignar</b>
                                                        </div>

                                                    </td>
                                                    <td class="text-center">
                                                        <form name="modificar" method="post" action="./modificar.php">
                                                            <input type="hidden" name="idfolio" value="<?php echo $idfolio; ?>">
                                                            <!-- <input type=submit class=" btn-success" name="modificar" value="Modificar"> -->
                                                            <button type="submit" name="modificar" class="btn btn-warning p-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Modificar">
                                                                <img src="assets/icons/edit.svg">
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>

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

                                                    $sql = "SELECT COUNT(*) as total , estatus FROM tbl_resolucion WHERE docref =$idfolio and estatus=1";
                                                    $resul = $conexion->query($sql);
                                                    $row = $resul->fetch(PDO::FETCH_ASSOC);
                                                    if ($row['total'] >= 1) {
                                                    ?>
                                                        <td>
                                                            <div class="text-secondary">
                                                                <b>En proceso...</b>
                                                            </div>
                                                        </td>
                                                        <td class="d-flex justify-content-center align-items-center">
                                                            <form name="resolucion" method="post" action="./resolucion2.php">
                                                                <input type="hidden" name="idfolio" value="<?php echo $idfolio; ?>">
                                                                <!-- <input type="submit" name="resolucion" class="btn btn-success my-2" value="Resolución"> -->
                                                                <button type="submit" name="resolucion" class="btn btn-success p-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Resolución">
                                                                    <img src="assets/icons/info.svg">
                                                                </button>
                                                            </form>
                                                            <form name="modificar" method="post" action="./modificar.php">
                                                                <input type="hidden" name="idfolio" value="<?php echo $idfolio; ?>">
                                                                <!-- <input type=submit class="btn btn-warning" name="modificar" value="Modificar"> -->
                                                                <button type="submit" name="modificar" class="btn btn-warning p-1 m-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Modificar">
                                                                    <img src="assets/icons/edit.svg">
                                                                </button>
                                                            </form>
                                                            <a href="resolucion.php?idfolio=<?php echo $idfolio; ?>" class="spinner-border text-warning mx-2">
                                                                <input type=image src="./img/notificacion.png" name="notificacion"></a>

                                                        </td>

                                                    <?php
                                                    } else
                                                                if ($row['total'] == 0) {
                                                    ?>
                                                        <td class="d-flex align-items-center">
                                                            <div class="text-success">
                                                                <b>Finalizado</b>
                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <form name="resolucion" method="post" action="./resolucion2.php">
                                                                <input type="hidden" name="idfolio" value="<?php echo $idfolio; ?>">
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