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
    <title>CONTROL DE DOCUMENTOS</title>
</head>

<body>
    <?php
    $tipo = $_SESSION['tipo_usuario'];
    if ($tipo == 2) {
    ?>
        <!--! Nav Menu  -->
        <?php include_once('./nav-menu.php') ?>
        <div class="contenedor">
            <div class="card m-2 shadow bg-vino">
                <div class="card-body">
                    <h2>Control de documentos</h2>
                </div>
            </div>

            <div class="card mt-5 mx-2">
                <?php
                $idfolio = $_POST['idfolio'];
                ?>
                <?php
                $i = 1;
                require("./bd/conndb1.php");
                $conexion = getConn();
                $usu = $_SESSION['cvesp'];
                $idarea = $_SESSION['idarea'];
                $sql = "SELECT * FROM tbl_docs WHERE tbl_docs.Idfolio=$idfolio ";
                $result = $conexion->query($sql);
                $row = $result->fetch(PDO::FETCH_ASSOC);
                ?>

                <div class="row p-3">
                    <div class="col-12 d-flex justify-content-end">
                        <form id="ver" action="tabla_super.php" method="post">
                            <button type="submit" class="btn btn-secondary" id="opcion">
                                <img src="./assets/icons/back.svg" alt="" srcset="">
                                Atrás
                            </button>
                        </form>
                    </div>
                </div>

                <form enctype="multipart/form-data" class="p-3">
                    <input type="hidden" name="idfolio" value="<?php echo $idfolio; ?>">
                    <input type="hidden" id="area" value=<?php echo $idarea; ?> name="area">

                    <fieldset class="p-2">
                        <div class="row">
                            <h4 class="txt-green">Descripción del asunto</h4>
                        </div>
                        <hr class="txt-green mb-4">

                        <div class="row mb-4">
                            <div class=" col-12 col-sm-6">
                                <label for="" class="form-label">Fecha</label>
                                <input name="fechaact" disabled="disabled" type="text" value="<?php echo $fecha = $row['fechaact']; ?>" class="form-control" />
                            </div>
                            <div class=" col-12 col-sm-6">
                                <label for="" class="form-label">Nombre del remitente</label>
                                <input name="remitente" disabled="disabled" class="form-control" type="text" value="<?php echo $row['remitente']; ?>" tabindex="1" />
                            </div>
                        </div>

                        <div class="row">
                            <h4 class="txt-green">Detalle del documento</h4>
                        </div>
                        <hr class="txt-green mb-4">

                        <div class="row mb-4">
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label">Fecha de emisión del documento</label>
                                <input name="fechadoc" disabled="disabled" type="text" value="<?php echo $fecha = $row['fecha_doc']; ?>" class="form-control" />
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label">Número de oficio</label>
                                <input name="referencia" disabled="disabled" class="form-control" type="text" value="<?php echo $row['docreferencia']; ?>" tabindex="4" />
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-12">
                                <label for="">Descripción</label>
                                <textarea name="asunto" class="form-control" disabled="disabled" value=""> <?php echo $row['descripcion']; ?></textarea>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-12">
                                <label for="">Observaciones</label>
                                <input name="observacion" disabled="disabled" class="form-control" type="text" value="<?php echo $row['observacion']; ?>" tabindex="4">
                            </div>
                        </div>

                        <?php include("tabla_res_super.php"); ?>

                        <div class="col-sm-12">
                            <!--	<input type="file" class="form-control" id="archivo" name="archivo">-->

                            <h5 class="txt-green">Archivos adjuntos</h5>

                            <?php
                            $path = "files/" . $idfolio;
                            if (file_exists($path)) {
                                $directorio = opendir($path);
                                while ($archivo = readdir($directorio)) {
                                    $i++;
                                    if (!is_dir($archivo)) {

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

                        <input name="usu" type="hidden" value="<?php echo $_SESSION['cvesp']; ?>" />

                    </fieldset>
                </form>

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