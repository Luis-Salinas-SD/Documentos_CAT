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
    <title>Control de Documentación</title>
</head>

<body>
    <?php
    $tipo = $_SESSION['tipo_usuario'];
    if ($tipo == 3) {
    ?>
        <!--! Nav Menu  -->
        <?php include_once('./nav-menu.php') ?>


        <div class="contenedor">

            <!-- Header -->
            <div class="card mb-5 m-2 shadow bg-vino">
                <div class="card-body">
                    <h3>Resolución</h3>
                </div>
            </div>

            <div class="card mx-2 p-2">
                <?php
                $idfolio = $_POST['idfolio'];
                ?>

                <div class="row">
                    <div class="col-12 d-flex justify-content-end">
                        <div class="m-1">
                            <form id="ver" action="tabla_usu.php" method="post">
                                <button type="submit" class="btn btn-secondary" id="opcion">
                                    <img src="./assets/icons/back.svg" alt="" srcset="">
                                    Atrás
                                </button>
                            </form>
                        </div>
                        <div class="m-1">
                            <a href="historial_usuario.php" class="btn btn-vino">Historial</a>
                        </div>
                    </div>
                </div>

                <form action="guardar_res_usu.php" method="post" enctype="multipart/form-data">

                    <?php
                    $i = 1;
                    require("./bd/conndb1.php");
                    $conexion = getConn();
                    $usu = $_SESSION['id_usuario'];
                    $sql = "SELECT * FROM tbl_docs, tbl_asignados, tbl_usuarios
                            WHERE tbl_docs.Idfolio=$idfolio
                            and tbl_docs.Idfolio=tbl_asignados.idfolio
                            and tbl_asignados.cvesp=tbl_usuarios.id_usuario
                            and tbl_asignados.cvesp=$usu ";
                    $result = $conexion->query($sql);
                    $row = $result->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <input type="hidden" name="idfolio" value="<?php echo $idfolio; ?>">
                    <input type="hidden" name="referencia" value="<?php echo $row['docreferencia']; ?>">

                    <fieldset class="p-2">
                        <div class="row txt-green">
                            <h4>Resolución</h4>
                        </div>
                        <hr class="txt-green mb-4">

                        <div class="row mb-2">
                            <div class="col-12 col-sm-4">
                                <label for="" class="form-label">Tipo de documento de la resolución</label>
                                <input name="tipo_doc" class="form-control" type="text" onKeyPress="return letra(event)" onKeyUp="activar1()" value="" required="required" onpaste="return false" tabindex="1">
                            </div>
                            <div class="col-12 col-sm-4">
                                <label for="" class="form-label">Número de documento de la resolución</label>
                                <input name="num_doc" class="form-control" type="text" onKeyPress="return letra(event)" onKeyUp="activar1()" value="" required="required" onpaste="return false" tabindex="2">
                            </div>
                            <div class="col-12 col-sm-4">
                                <label for="">Fecha de la resolución</label>
                                <?php
                                date_default_timezone_set('America/Mexico_City');
                                $fecha = date('y/m/d');
                                ?>
                                <input name="fechares" id="fechaid1" type="datetimepicker" disabled="disabled" value="20<?php echo $fecha ?>" required="required" class="form-control" tabindex="" />
                                <input name="fechares" type="hidden" value="20<?php echo $fecha; ?>" />
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-12">
                                <label for="" class="form-label">Notas:</label>
                                <input name="nota" class="form-control" type="text" onKeyPress="return letra(event)" onKeyUp="activar1()" value="" required="required" onpaste="return false" tabindex="3">
                            </div>
                        </div>

                    </fieldset>

                    <fieldset class="p-2">
                        <div class="row txt-green">
                            <h4>Descripción del asunto</h4>
                        </div>
                        <hr class="txt-green mb-4">

                        <div class="row mb-3">
                            <div class="col-12 col-sm-3">
                                <label for="" class="form-label">Fecha</label>
                                <input name="fechaact" id="fechaid1" disabled="disabled" type="text" value="<?php echo $fecha = $row['fechaact']; ?>" class="form-control" />
                            </div>
                            <div class="col-12 col-sm-9">
                                <label for="" class="form-label">Nombre del remitente</label>
                                <input name="remitente" disabled="disabled" class="form-control" type="text" value="<?php echo $row['remitente']; ?>">
                            </div>
                        </div>
                    </fieldset>

                    <fieldset class="p-2">
                        <div class="row txt-green">
                            <h4>Detalle del documento</h4>
                        </div>
                        <hr class="txt-green mb-4">

                        <div class="row mb-3">
                            <div class="col-12 col-sm-3">
                                <label class="form-label">Fecha de emisión del documento</label>
                                <input name="fechadoc" id="fechaid1" disabled="disabled" type="text" value="<?php echo $fecha = $row['fecha_doc']; ?>" class="form-control" />
                            </div>
                            <div class="col-12 col-sm-9">
                                <label class="form-label">Número de oficio</label>
                                <input name="referencia" disabled="disabled" class="form-control" type="text" value="<?php echo $row['docreferencia']; ?>">
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
                                <input name="observacion" disabled="disabled" class="form-control" type="text" value="<?php echo $row['observacion']; ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <input name="usu" type="hidden" value="<?php echo $_SESSION['id_usuario']; ?>" />
                                <!--mostrar archivo para modificar-->
                                <label for="archivo" class="control-label">Archivo</label>
                                <input type="file" class="form-control mb-3" id="archivo" name="archivo">
                                <?php
                                $path = "files/" . $idfolio;
                                if (file_exists($path)) {
                                    $directorio = opendir($path);
                                    while ($archivo = readdir($directorio)) {
                                        $i++;
                                        if (!is_dir($archivo)) {
                                            //echo "$archivo";
                                            //   echo "$archivo <a href='#' class='delete' title='Ver Archivo Adjunto' ><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>                                       </div>";
                                            //echo "<div class='center'><iframe  src='files/$idfolio/$archivo' width='100%' frameborder='0' height='550'></iframe></div>";
                                            echo "<button type='button' class='btn btn-danger m-1' data-bs-toggle='modal' data-bs-target='#ident_$i' data-toggle='tooltip' data-placement='top' title='$archivo'><img src='./assets/icons/pdf.svg'> </button>";
                                            //echo "<div class='center'><iframe  src='files/$idfolio/$archivo' width='100%' frameborder='0' height='550'></iframe></div>";
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

                        </div>

                        <div class="row mb-2">
                            <div class="col-12 d-flex justify-content-center">
                                <input type="submit" title="Guardar" value="Guardar" class="btn btn-success" id="opcion" tabindex="4" />
                            </div>
                        </div>




                    </fieldset>

                </form>

            </div>



        </div>
    <?php
    } elseif ($tipo == 1) {

        header("Location:tabla_admon.php");
    } elseif ($tipo == 2) {

        header("Location:tabla_super.php");
    } elseif ($tipo == 4) {

        header("Location:tabla_oficialia.php");
    } else {
        header("Location:index.php");
    }
    ?>

    <?php include_once('./templates/scripts.php') ?>

</body>

</html>