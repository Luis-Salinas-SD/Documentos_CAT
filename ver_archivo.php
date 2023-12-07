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
    <title>Emision de documentos</title>
</head>

<body>
    <?php
    $tipo = $_SESSION['tipo_usuario'];
    if ($tipo == 4) {
    ?>
        <?php include_once('./nav-menu.php') ?>
        <div class="contenedor">

            <!-- Header -->
            <div class="card m-2 shadow bg-vino">
                <div class="card-body">
                    <h2>Control de documentos</h2>
                </div>
            </div>

            <div class="card mt-5 mx-2 shadow p-3">

                <div class="row">
                    <div class="col-12 d-flex justify-content-end">
                        <form id="ver" action="tabla_oficialia.php" method="post">
                            <button type="submit" class="btn btn-secondary m-3" id="opcion">
                                <img src="./assets/icons/back.svg" alt="" srcset="">
                                Atrás
                            </button>
                        </form>
                    </div>
                </div>
                <form action="guardar_modificar.php" method="post" enctype="multipart/form-data" class="p-3">
                    <input name="idfolio" type="hidden" value="<?php echo $idfolio ?>" />
                    <?php
                    $idfolio = $_POST['idfolio'];
                    $idarea = $_SESSION['idarea'];
                    ?>

                    <?php
                    $i = 1;
                    require("./bd/conndb1.php");
                    $conexion = getConn();
                    $usu = $_SESSION['cvesp'];

                    $sql = "SELECT * FROM tbl_docs WHERE tbl_docs.Idfolio=$idfolio ";
                    $result = $conexion->query($sql);
                    $row = $result->fetch(PDO::FETCH_ASSOC);

                    ?>

                    <fieldset>
                        <div class="row txt-green">
                            <h4>Descripción del documento</h4>
                        </div>
                        <hr class="txt-green mb-4">

                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label for="" class="form-label">
                                    Fecha
                                </label>
                                <input name="fechaact" disabled="disabled" id="fechaid1" type="date" tabindex="1" value="<?php echo $row['fechaact']; ?>" required="required" class="form-control" />
                                <input name="fechaact" type="hidden" value="<?php echo $row['fechaact']; ?>" />
                            </div>
                            <div class="col-12 col-sm-6">
                                <label for="" class="form-label">Nombre del remitente</label>
                                <p><input name="remitente" class="form-control" type="text" disabled="disabled" onKeyPress="return letra(event)" onKeyUp="activar1()" value="<?php echo $row['remitente']; ?>" required="required" onpaste="return false" tabindex="2" />
                            </div>
                        </div>

                        <div class="row txt-green">
                            <h4>Detalle del Documento</h4>
                        </div>
                        <hr class="txt-green mb-4">

                        <div class="row mb-3">
                            <div class="col-12 col-sm-6">
                                <label for="" class="form-label">Fecha de emisión del documento</label>
                                <input name="fechadoc" id="fechaid1" type="date" disabled="disabled" value="<?php echo $fecha = $row['fecha_doc']; ?>" required="required" class="form-control" tabindex="3" />
                            </div>
                            <div class="col-12 col-sm-6">
                                <label for="" class="form-label">Número de referencia</label>
                                <input name="referencia" class="form-control" disabled="disabled" type="text" onKeyPress="return letra(event)" onKeyUp="activar1()" value="<?php echo $row['docreferencia']; ?>" required="required" onpaste="return false" tabindex="4" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="" class="form-label">Descripción</label>
                                <textarea name="asunto" class="form-control" disabled="disabled" value=""> <?php echo $row['descripcion']; ?></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="" class="form-label">Observaciones</label>
                                <input name="observacion" class="form-control" disabled="disabled" type="text" onKeyPress="return letra(event)" onKeyUp="activar1()" value="<?php echo $row['observacion']; ?>" onpaste="return false" tabindex="7">
                            </div>
                        </div>







                        <input name="usu" type="hidden" value="<?php echo $_SESSION['cvesp']; ?>" />
                        <!--mostrar archivo para modificar -->

                        <label for="archivo" class="col-12 control-label">Archivo</label>
                        <div class="col-sm-12">
                            <!--<input type="file" class="form-control" id="archivo" name="archivo" accept="application/pdf">
                            <label for="archivo" class="col-12 control-label">NOTA:El sistema solo acepta archivos en formato pdf que no excedan el tamaño máximo permitido (1 Mb )</label>-->

                            <?php
                            $path = "files/" . $idfolio;

                            if (file_exists($path)) {
                                $directorio = opendir($path);
                                while ($archivo = readdir($directorio)) {
                                    $i++;
                                    if (!is_dir($archivo)) {

                                        echo "<button type='button' class='btn btn-danger m-1' data-bs-toggle='modal' data-bs-target='#ident_$i' data-toggle='tooltip' data-placement='top' title='$archivo'><img src='./assets/icons/pdf.svg'> </button>";
                                        //echo "<div class='center'><iframe  src='files/$idfolio/$archivo' width='100%' frameborder='0' height='550' align='center'></iframe></div>";
                                        echo "<div class='modal fade' id='ident_$i' tabindex='-1' aria-labelledby='$archivo' aria-hidden='true'>
                                                <div class='modal-dialog modal-dialog-centered modal-xl'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <h5 class='modal-title text-capitalize' id='exampleModalLabel'>$archivo</h5>
                                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                        </div>
                                                        <div class='modal-body'>
                                                            <div class='center'><iframe src='files/$idfolio/$archivo' width='100%' frameborder='0' height='550'></iframe></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>";
                                    }
                                }
                            }

                            ?>

                        </div>

                        <div class="row">
                            <!--         <div class="col-sm-4">
                                                        <input type="submit" title="Guardar" value=" " class="aceptar" id="opcion" tabindex="11" /></div>
                                                    <div class="col-sm-4">
                                                    </div>-->
                </form>

            </div>

            <!--<div class="row">
                    <div class="col-12">
                        <?php // include('asignar.php')
                        ?>
                    </div>
                    <div id="muestra">
                        <?php // include("tabla_asigna.php");
                        ?>
                    </div>
                </div>-->
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