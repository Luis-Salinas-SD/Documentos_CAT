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
    <script src="js/bootstrap.min.js"></script>
    <title>EMISION DE DOCUMENTOS | Modificar</title>
</head>

<body>
    <?php
    $tipo = $_SESSION['tipo_usuario'];
    if ($tipo == 1) {
    ?>

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
                <?php
                $idfolio = $_POST['idfolio'];
                $idarea = $_SESSION['idarea'];
                ?>

                <div class="row">
                    <div class="col-12 d-flex justify-content-end">
                        <form id="ver" action="tabla_admon.php" method="post">
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
                    $i = 1;
                    require("./bd/conndb1.php");
                    $conexion = getConn();
                    $usu = $_SESSION['cvesp'];

                    $sql = "SELECT * FROM tbl_docs WHERE tbl_docs.Idfolio=$idfolio ";
                    $result = $conexion->query($sql);
                    $row = $result->fetch(PDO::FETCH_ASSOC);

                    ?>


                    <fieldset class="p-2">
                        <div class="row txt-green">
                            <h4>Descripción del asunto</h4>
                        </div>
                        <hr class="txt-green mb-4">

                        <div class="row mb-4">

                            <div class="col-12 col-sm-6 mb-3">
                                <label for="" class="form-label">Fecha</label>
                                <input name="fechaact" disabled="disabled" id="fechaid1" type="date" tabindex="1" value="<?php echo $row['fechaact']; ?>" required="required" class="form-control" />
                                <input name="fechaact" type="hidden" value="<?php echo $row['fechaact']; ?>" />
                            </div>
                            <div class="col-12 col-sm-6 mb-3">
                                <label for="" class="form-label">Nombre del remitente</label>
                                <input name="remitente" class="form-control" type="text" onKeyPress="return letra(event)" onKeyUp="activar1()" value="<?php echo $row['remitente']; ?>" required="required" onpaste="return false" tabindex="2" />
                            </div>

                        </div>

                        <div class="row txt-green">
                            <h4>
                                Detalle del documento
                            </h4>
                        </div>
                        <hr class="txt-green mb-4">

                        <div class="row mb-4">
                            <div class="col-12 col-sm-6 mb-3">
                                <label for="">Fecha de emisión del documento</label>
                                <input name="fechadoc" id="fechaid1" type="date" value="<?php echo $fecha = $row['fecha_doc']; ?>" required="required" class="form-control" tabindex="3" />
                            </div>
                            <div class="col-12 col-sm-6 mb-3">
                                <label for="">Número de oficio</label>
                                <input name="referencia" class="form-control" type="text" onKeyPress="return letra(event)" onKeyUp="activar1()" value="<?php echo $row['docreferencia']; ?>" required="required" onpaste="return false" tabindex="4" />
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-12 mb-3">
                                <label for="">Descripción</label>
                                <textarea name="asunto" type="text" class="form-control" onKeyUp="activar1()" required tabindex="6"><?php echo $row['descripcion']; ?> </textarea>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="">Observaciones</label>
                                <input name="observacion" class="form-control" type="text" onKeyPress="return letra(event)" onKeyUp="activar1()" value="<?php echo $row['observacion']; ?>" onpaste="return false" tabindex="7">
                            </div>
                        </div>

                        <div class="row mb-1">
                            <input name="usu" type="hidden" value="<?php echo $_SESSION['cvesp']; ?>" />
                            <!--mostrar archivo para modificar -->
                        </div>

                        <div class="col-12 mb-3">
                            <label for="archivo" class="form-label">Archivo</label>
                            <input type="file" class="form-control mb-2" id="archivo" name="archivo" accept="application/pdf">
                            <span class="text-secondary"><b>NOTA: </b> El sistema solo acepta archivos en formato PDF que no excedan el tamaño máximo permitido (25MB)</span>
                            <br>

                            <?php
                            $path = "files/" . $idfolio;
                            if (file_exists($path)) {
                                $directorio = opendir($path);
                                while ($archivo = readdir($directorio)) {
                                    if (!is_dir($archivo)) {
                                        $i++;
                                        //echo "<div class='center'><iframe  src='files/$idfolio/$archivo' width='100%' frameborder='0' height='550' align='center'></iframe></div>";


                                        echo "<button type='button' class='btn btn-danger m-1' data-bs-toggle='modal' data-bs-target='#ident_$i' data-toggle='tooltip' data-placement='top' title='$archivo'><img src='./assets/icons/pdf.svg'> </button>";
                                        echo "<div class='modal fade' id='ident_$i' tabindex='-1' aria-labelledby='$archivo' aria-hidden='true'>
                                                <div class='modal-dialog modal-dialog-centered modal-xl'>
                                                    <div class='modal-content'>
                                                        <div class='modal-header'>
                                                            <h5 class='modal-title text-capitalize' id='exampleModalLabel'>$archivo</h5>
                                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                        </div>
                                                        <div class='modal-body'>
                                                        <iframe  src='files/$idfolio/$archivo' width='100%' frameborder='0' height='550' align='center'></iframe>
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
                            <div class="col-12 d-flex justify-content-center">
                                <div class="m-2">
                                    <input type="submit" title="Guardar" value="Guardar" class="btn btn-success" id="opcion" tabindex="11" />
                                </div>
                            </div>
                        </div>
                    </fieldset>

                </form>
                <div class="col-12">
                    <?php include('asignar.php') ?>
                </div>
                <div id="muestra">
                    <?php
                    // include("tabla_asigna.php");
                    ?>
                </div>
            </div>

        </div>

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