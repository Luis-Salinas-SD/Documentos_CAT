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
    <title>EMISION DE DOCUMENTOS</title>
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
                    <h2>Agregar Nuevo Asunto</h2>
                </div>
            </div>

            <div class="card mt-5 mx-2">

                <?php
                $i = 1;
                require('./bd/conndb1.php');
                $conexion = getConn();

                $query = "SELECT (max(Idfolio) +1) from tbl_docs";
                $resultado = $conexion->query($query);
                $row = $resultado->fetch(PDO::FETCH_COLUMN);
                if ($row >= 1) {
                    $idfolio = $row;
                } else {
                    $idfolio = 1;
                }
                ?>

                <form action="guardar1.php" method="post" enctype="multipart/form-data">

                    <div class=" m-3">
                        <fieldset class="p-2">

                            <div class="row txt-green">
                                <h4>Descripción del asunto</h4>
                            </div>
                            <hr class="txt-green mb-4">

                            <div class="row mb-4">
                                <div class="col-12 col-sm-6 mb-3">
                                    <label for="" class="form-label">Nombre del remitente <span class="text-danger">*</span></label>
                                    <input name="remitente" class="form-control text-secondary" type="text" onKeyUp="activar1()" value="" required="required" tabindex="2" />
                                </div>
                                <div class="col-12 col-sm-6 mb-3">
                                    <input name="idfolio" type="hidden" value="<?php echo $idfolio; ?>" />
                                    <label class="form-label">Fecha </label>
                                    <?php
                                    date_default_timezone_set('America/Mexico_City');
                                    $fecha = date('y/m/d');
                                    $fecha1 = date('d/m/Y');
                                    ?>
                                    <input name="fechaact" disabled="disabled" tabindex="1" value="<?php echo $fecha1; ?>" required="required" class="form-control" />
                                    <input name="fechaact" type="hidden" value="<?php echo $fecha; ?>" required="required" />
                                </div>
                            </div>


                            <div class="row mb-4">
                                <h4 class="txt-green">Detalle del Documento</h4>
                            </div>
                            <hr class="txt-green mb-4">

                            <div class="row mb-3">
                                <div class="col-12 col-sm-6 mb-3">
                                    <label for="" class="form-label">
                                        Fecha de emisión del documento <span class="text-danger">*</span>
                                    </label>
                                    <input id="fechaid1" name="fechadoc" type="date" value=" " required="required" class="form-control" tabindex="3" />
                                </div>
                                <div class="col-12 col-sm-6 mb-3">
                                    <label for="" class="form-label">Número de oficio <span class="text-danger">*</span></label>
                                    <input name="referencia" class="form-control text-secondary" type="text" onKeyUp="activar1()" value="" required="required" tabindex="4" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="" class="form-label">Descripción <span class="text-danger">*</span></label>
                                    <textarea name="asunto" class="form-control text-secondary" onKeyUp="activar1()" required tabindex="6"></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="" class="form-label">Observaciones</label>
                                    <textarea name="observacion" class="form-control" type="text" onKeyUp="activar1()" value="" tabindex="7"></textarea>
                                    <input name="usu" type="hidden" value="<?php echo $_SESSION['cvesp']; ?>" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="archivo" class="form-label">Archivo</label>
                                    <input type="file" class="form-control" id="archivo" name="archivo" accept="application/pdf">
                                    <span class="text-secondary">
                                        <b>NOTA:</b> El sistema solo acepta archivos en formato PDF que no excedan el tamaño máximo permitido (25 MB )
                                    </span>
                                </div>
                            </div>
                        </fieldset>
                    </div>

                    <div class="col-12 text-center my-3">
                        <button type="submit" class="btn btn-success">
                            Guardar
                        </button>
                    </div>
                </form>

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