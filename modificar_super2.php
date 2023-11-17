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
    if ($tipo == 2) {
    ?>
        <!--! Nav Menu  -->
        <?php include_once('./nav-menu.php') ?>
        <div class="contenedor">

            <!-- Header -->
            <div class="card m-2 shadow">
                <div class="card-body">
                    <h2 class="text-secondary">Control de Documentos</h2>
                </div>
            </div>

            <div class="card mt-5 mx-2">
                <?php
                $idfolio = $_POST['idfolio'];
                $idarea = $_SESSION['idarea'];
                ?>
                <form action=" " method="post" enctype="multipart/form-data" class="p-3">
                    <input name="idfolio" type="hidden" value="<?php echo $idfolio ?>" />
                    <input type="hidden" id="area" value=<?php echo $idarea; ?> name="area">

                    <?php
                    $i = 1;
                    require("./bd/conndb1.php");
                    $conexion = getConn();
                    $usu = $_SESSION['cvesp'];

                    $sql = "SELECT * FROM tbl_docs WHERE tbl_docs.Idfolio=$idfolio ";
                    $result = $conexion->query($sql);
                    $row = $result->fetch(PDO::FETCH_ASSOC);

                    ?>
                    <div class="row">
                        <div class="col-12 text-end">
                            <a href="./tabla_super.php" class="btn btn-secondary m-2">
                                <img src="./assets/icons/back.svg" alt="" height="20px;">
                                <span>Atrás</span>
                            </a>
                        </div>
                    </div>

                    <fieldset class="fieldset1">
                        <div class="row text-primary">
                            <h4>Asunto / Documento</h4>
                        </div>
                        <hr class="text-primary mb-4">

                        <div class="row mb-3">
                            <div class="col-12 col-sm-6">
                                <label for="" class="form-label">Fecha</label>
                                <input name="fechaact" disabled="disabled" id="fechaid1" type="date" tabindex="1" value="<?php echo $row['fechaact']; ?>" required="required" class="form-control" />
                                <input name="fechaact" type="hidden" value="<?php echo $row['fechaact']; ?>" />
                            </div>
                            <div class="col-12 col-sm-6">
                                <label for="" class="form-label">Remitente</label>
                                <input disabled="disabled" name="remitente" class="form-control" type="text" onKeyPress="return letra(event)" onKeyUp="activar1()" value="<?php echo $row['remitente']; ?>" required="required" onpaste="return false" tabindex="2" />
                            </div>
                        </div>

                        <div class="row text-primary">
                            <h4>Detalle del Documento</h4>
                        </div>
                        <hr class="text-primary mb-4">

                        <div class="row mb-3">
                            <div class="col-12 col-sm-6">
                                <label for="" class="form-label">Fecha de emisión del documento</label>
                                <input disabled="disabled" name="fechadoc" id="fechaid1" type="date" value="<?php echo $fecha = $row['fecha_doc']; ?>" required="required" class="form-control" tabindex="3" />
                            </div>
                            <div class="col-12 col-sm-6">
                                <label for="" class="form-label">Referencia</label>
                                <input disabled="disabled" name="referencia" class="form-control" type="text" onKeyPress="return letra(event)" onKeyUp="activar1()" value="<?php echo $row['docreferencia']; ?>" required="required" onpaste="return false" tabindex="4" />
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
                                <input disabled="disabled" name="observacion" class="form-control" type="text" onKeyPress="return letra(event)" onKeyUp="activar1()" value="<?php echo $row['observacion']; ?>" onpaste="return false" tabindex="7">
                            </div>
                        </div>

                        <input name="usu" type="hidden" value="<?php echo $_SESSION['cvesp']; ?>" />

                        <!--mostrar archivo para modificar  -->

                        <div class="col-12">


                            <?php
                            $path = "files/" . $idfolio;
                            if (file_exists($path)) {
                                $directorio = opendir($path);
                                while ($archivo = readdir($directorio)) {
                                    if (!is_dir($archivo)) {


                                        echo "<div class='center'><iframe  src='files/$idfolio/$archivo' width='100%' frameborder='0' height='550' text-align=' center'></iframe></div>";
                                    }
                                }
                            }

                            ?>

                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                            </div>
                            <div class="col-sm-4">
                            </div>
                        </div>
                </form>

            </div>

            <div class="row">
                <div class="col-12">
                    <?php include('asignar_super.php') ?>
                </div>
                <div id="muestra">
                    <?php // include("tabla_asigna.php");
                    ?>
                </div>
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