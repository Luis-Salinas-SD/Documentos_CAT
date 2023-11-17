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
    if ($tipo == 4) {
    ?>

        <?php include_once('./nav-menu.php') ?>

        <div class="contenedor">

            <!-- Header -->
            <div class="card m-2 shadow bg-vino">
                <div class="card-body">
                    <h2>Control de Documentos</h2>
                </div>
            </div>

            <div class="card mt-5 mx-2 shadow">
                <div class="card-body">
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
                    <form action="guardar.php" method="post" enctype="multipart/form-data">
                        <div class="row txt-green">
                            <h4>Asunto / Documento</h4>
                        </div>
                        <hr class="txt-green mb-4">

                        <div class="row mb-3">
                            <div class="col-12 col-sm-6">
                                <input name="idfolio" type="hidden" value="<?php echo $idfolio; ?>" />
                                <label for="" class="form-label">Fecha</label>
                                <?php
                                date_default_timezone_set('America/Mexico_City');
                                $fecha = date('y/m/d');
                                $fecha1 = date('d/m/Y');
                                ?>
                                <input name="fechaact" disabled="disabled" tabindex="1" value="<?php echo $fecha1; ?>" required="required" class="form-control" />
                                <input name="fechaact" type="hidden" value="<?php echo $fecha; ?>" required="required" />
                            </div>
                            <div class="col-12 col-sm-6">
                                <label for="" class="form-label">Remitente</label>
                                <input name="remitente" class="form-control" type="text" onKeyUp="activar1()" value="" required="required" tabindex="2" />
                            </div>
                        </div>
                        <div class="row txt-green">
                            <h4>Detalles del Documento</h4>
                        </div>
                        <hr class="txt-green mb-4">

                        <div class="row mb-3">
                            <div class="col-12 col-sm-6">
                                <label for="" class="form-label">Fecha de emisión del documento</label>
                                <input id="fechaid1" name="fechadoc" type="date" value=" " required="required" class="form-control" tabindex="3" />

                            </div>
                            <div class="col-12 col-sm-6">
                                <label for="" class="form-label">Referencia</label>
                                <input name="referencia" class="form-control" type="text" onKeyUp="activar1()" value="" required="required" tabindex="4" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="" class="form-label">Descripción</label>
                                <textarea name="asunto" class="form-control" onKeyUp="activar1()" required tabindex="6"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="" class="form-label">Observaciones</label>
                                <textarea name="observacion" class="form-control" type="text" onKeyUp="activar1()" value="" required tabindex="7"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <input name="usu" type="hidden" value="<?php echo $_SESSION['cvesp']; ?>" />
                                <label for="archivo" class="form-label">Archivo</label>
                                <input type="file" class="form-control" id="archivo" name="archivo" accept="application/pdf">
                                <span class="text-secondary my-1">NOTA:El sistema solo acepta archivos en formato pdf que no excedan el tamaño máximo permitido (25 Mb )</span>
                            </div>

                        </div>

                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-success">
                                GUARDAR
                            </button>
                        </div>

                    </form>
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
</body>

</html>