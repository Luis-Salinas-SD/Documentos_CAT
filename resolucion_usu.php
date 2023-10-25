<!DOCTYPE html>
<?php

session_start();
if (@!$_SESSION['cvesp']) {
    header("Location:index.php");
}
?>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href="./css/tcal.css" />
    <link rel="stylesheet" href="css/estilo_index.css">
    <link rel="stylesheet" href="./css/estilo.css" />
    <script type="text/javascript" src="./js/tcal.js"></script>
    <script type="text/javascript" src="./js/activar.js"></script>

    <title>CONTROL DE DOCUMENTACION </title>
</head>

<body>
<?php
$tipo=$_SESSION['tipo_usuario'];
    if($tipo==3){
?> 
    <header></header>
    <table width="980" class="ubica1">
        <td width="479" align="left"><a> Bienvenido <strong>
                    <?php echo $_SESSION['nombre']; ?></strong></a> </td>
        <td width="105" align="right"><a href="desconectar.php"> Cerrar Sesion </a></td>
    </table>


    <div class="header row">
        <div class="navegacion col">

            <nav class="navbar navbar-default" role="navigation">

                <ul id="button">


                    <li><a href="tabla_usu.php">REGRESAR A TABLA</a></li>
                    <li><a href="historial_usuario.php">HISTORIAL</a></li>


                </ul>
            </nav>
        </div>
    </div>
    <div class="container">

        <div class="row">
            <div class="col-12">
                <?php 
                $idfolio = $_POST['idfolio'];
                ?>
                <form action="guardar_res_usu.php" method="post" class="form-control" enctype="multipart/form-data" >


                    <?php 
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

                    <fieldset class="fieldset1">
                        <legend class="legend1 estilo4">
                            Resolución </legend>
                        <div class="row">
                            <div class="col-sm-4">

                                <p> Tipo de Documento de la resolución </p>
                                <input name="tipo_doc" class="form-control" type="text" onKeyPress="return letra(event)" onKeyUp="activar1()" value="" required="required" onpaste="return false" tabindex="1">
                            </div>
                            <div class="col-sm-4">
                                <p>Número de Documento de la resolución </p>
                                <input name="num_doc" class="form-control" type="text" onKeyPress="return letra(event)" onKeyUp="activar1()" value="" required="required" onpaste="return false" tabindex="2">
                            </div>
                            <div class="col-sm-4">
                                <p>Fecha de la resolución</p>
                                <?php 
                                date_default_timezone_set('America/Mexico_City');
                                $fecha = date('y/m/d');
                                ?>
                                <input name="fechares" id="fechaid1" type="datetimepicker" disabled="disabled" value="20<?php echo $fecha ?>" required="required" class="form-control" tabindex="" />
                                <input name="fechares" type="hidden" value="20<?php echo $fecha; ?>" />
                            </div>
                        </div>
                        <div class="row ">
                        <div class="col-sm-8">
                                <p>Notas: </p>
                                <input name="nota" class="form-control" type="text" onKeyPress="return letra(event)" onKeyUp="activar1()" value="" required="required" onpaste="return false" tabindex="3">
                            </div>
                        </div>


                    </fieldset>

                    <fieldset class="fieldset1">
                        <legend class="legend1 estilo4">
                            <p>Asunto / Documento </p>
                        </legend>
                        <div class="row">
                            <div class="col-sm-4">
                                <p>Fecha</p>

                                <input name="fechaact" id="fechaid1" disabled="disabled" type="text" value="<?php echo $fecha = $row['fechaact']; ?>" class="form-control" />
                            </div>
                            <div class="col-sm-8">
                                <p>Remitente</p>
                                <p><input name="remitente" disabled="disabled" class="form-control" type="text" value="<?php echo $row['remitente']; ?>">
                            </div>
                        </div>

                        <fieldset class="fieldset1">
                            <legend class="legend1 estilo4">
                                <p>Detalle del Documento</p>
                            </legend>
                            <div class="row">
                                <div class="col-sm-4">
                                    <p>Fecha de emisión del documento</p>
                                    <p><input name="fechadoc" id="fechaid1" disabled="disabled" type="text" value="<?php echo $fecha = $row['fecha_doc']; ?>" class="form-control" />
                                </div>
                                <div class="col-sm-4">
                                    <p>Referencia</p>
                                    <p><input name="referencia" disabled="disabled" class="form-control" type="text" value="<?php echo $row['docreferencia']; ?>">
                                </div>
                            </div>
                            <p>Descripción</p>
                            <p><textarea name="asunto"  class="form-control" disabled="disabled" value="" > <?php echo $row['descripcion']; ?></textarea>

                                <p>Observaciones</p>
                                <p><input name="observacion" disabled="disabled" class="form-control" type="text" value="<?php echo $row['observacion']; ?>">

                        </fieldset>

                        <input name="usu" type="hidden" value="<?php echo $_SESSION['id_usuario']; ?>" />
<!--mostrar archivo para modificar 
                    
					<label for="archivo" class="col-sm-2 control-label">Archivo</label>-->
					<div class="col-sm-10">
					<input type="file" class="form-control" id="archivo" name="archivo">
						
						<?php 
							$path = "files/".$idfolio;
							if(file_exists($path)){
								$directorio = opendir($path);
								while ($archivo = readdir($directorio))
								{
									if (!is_dir($archivo)){
                                        echo "$archivo";
                                     //   echo "$archivo <a href='#' class='delete' title='Ver Archivo Adjunto' ><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a>                                       </div>";
										echo "<div class='center'><iframe  src='files/$idfolio/$archivo' width='120%' frameborder='0' height='550'></iframe></div>";
									}
								}
							}
							
						?>
						
					</div>

                        <div class="row">
                            <div class="col-sm-4">
                                <input type="submit" title="Guardar" value=" " class="aceptar" id="opcion" tabindex="4" /></div>
                            <div class="col-sm-4">
                            </div>
                </form>

                <div class="col-sm-4">
                    <form id="ver" action="tabla_usu.php" method="post">
                        <input type="submit" class="tbl" title="Ver Tabla" id="opcion" value=" " tabindex="5" />
                    </form>
                </div>
            </div>

        </div>
    </div>
    </div>
    <?php
  }elseif($tipo==1){

    header("Location:tabla_admon.php");

  }elseif($tipo==2){

    header("Location:tabla_super.php");

      }elseif($tipo==4){

        header("Location:tabla_oficialia.php");

  }else{
      header("Location:index.php");

  }

?> 
</body>

</html> 