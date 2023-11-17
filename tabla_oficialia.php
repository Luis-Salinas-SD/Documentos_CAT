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
    if ($tipo == 4) {
    ?>

        <?php include_once('./nav-menu.php') ?>

        <div class="contenedor">

            <!-- Header -->
            <div class="card m-2 shadow">
                <div class="card-body">
                    <h2 class="text-secondary">Control de Documentos</h2>
                </div>
            </div>

            <!-- Contenido -->
            <div class="card mt-5 mx-2 shadow">
                <div class="card-body">
                    <div class="table-responsive m-3 p-3">
                        <table class="table table-bordered print-friendly hover" id="oficialia">
                            <thead style="text-align: center;">
                                <tr>
                                    <th class="center"> No.</th>
                                    <th class="center"> Fecha del Documento</th>
                                    <th class="center"> Numero de Oficio </th>
                                    <th class="center"> Nombre del remitente</th>
                                    <th class="center"> Concepto</th>
                                    <th class="center"> Archivo</th>


                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                require('./bd/conndb1.php');
                                $conexion = getConn();
                                $usu = $_SESSION['cvesp'];
                                $i = 0;

                                $_pagi_sql = "SELECT * FROM tbl_docs WHERE fechaact >= '2019-01-01' order by fecha_doc desc";

                                //and fecha >='2019-01-01'
                                $_pagi_result = $conexion->query($_pagi_sql);
                                $numfilas = $_pagi_result->rowCount();
                                if ($numfilas == 0) {
                                    echo '<script>alert(" NO CUENTA CON REGISTROS EN ESTA SECCION ")</script>';
                                } else {

                                    $_pagi_nav_estilo = "cls_pagi";
                                    $enlacesdepaginacion = 11;

                                    //include("paginator2.inc.php");

                                    while ($i <= 1) {

                                        while ($row = $_pagi_result->fetch(PDO::FETCH_ASSOC)) {
                                            $i++;
                                            $asignar = $row['asignar'];
                                            $idfolio = $row['Idfolio'];
                                            $fecha_doc = $row['fecha_doc'];
                                            $docreferencia = $row['docreferencia'];
                                            utf8_decode($remitente = $row['remitente']);
                                            utf8_decode($descripcion = $row['descripcion']);
                                ?>
                                            <tr>

                                                <td class="center">
                                                    <?php echo $i; ?>
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

                                                    <form name="resolucion" method="post" action="./ver_archivo.php">
                                                        <input type="hidden" name="idfolio" value="<?php echo $idfolio; ?>">
                                                        <!-- <input type="submit" name="resolucion" class="btn btn-info" value="Archivo"> -->
                                                        <button type="submit" name="resolucion" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" title="Archivo">
                                                            <img src="./assets/icons/doc.svg">
                                                        </button>
                                                    </form>

                                                </td>

                                            </tr>

                                <?php
                                        }
                                    }
                                }
                                ?>
                            </tbody>
                        </table>

                        <?php
                        /*
                        $conexion = null;
                        if ($numfilas == 0) {
                        } else {
                            echo "<div id = \"cls_pagi\"><p align=\"center\">" . $_pagi_navegacion . "</p>";
                        }*/
                        ?>

                    </div>
                </div>
            </div>



        </div>
    <?php
    } elseif ($tipo == 1) {
        header("Location:tabla_admon.php");
    } elseif ($tipo == 2) {
        header("Location:tabla_super.php");
    } elseif ($tipo == 3) {
        header("Location:tabla_usu.php");
    } else {
        header("Location:index.php");
    }
    ?>
    <?php include_once('./templates/scripts.php') ?>

</body>

</html>