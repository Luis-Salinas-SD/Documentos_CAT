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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css"/>
    <link rel="stylesheet" href="css/titulo.css"/>
    <script src="js/jquery-3.3.1.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
  <title>EMISION DE DOCUMENTOS</title>
  </head>

<body>
<?php
$tipo=$_SESSION['tipo_usuario'];
    if($tipo==4){
?> 
<div class="container">
        <header class="row">
            <div class="center"  id="titulo">   
               <!-- <H1>HEADER</H1> -->
            </div>
		</header>
        <p>
 			<section class="contenedor-main row">
              <div class="col-sm-2"> <!-- Inicio Menú -->
              <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Menú </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                        
              <a class="dropdown-item" href="./tabla_oficialia.php">PÁGINA PRINCIPAL</a>
                         <a class="dropdown-item" href="./form_nuevo_ofi.php"> REGISTRO NUEVO </a>

             </div>
             </div>           
         
            </div> <!-- FIN Menú-->
            
			 
            <main class="col-md-8">
            <table class="table table-striped" id="cabecera">
					<td><a><strong><?php echo $_SESSION['nombre']; ?></strong></a> </td>
	  		</table>
              </main>
                 

            <div class="col-sm-2">
			 <table class="table">
					<td width="350" align="right"><a href="desconectar.php" class="btn btn-info"> Cerrar Sesion </a></td>
   			 </table>	
            <!-- Lado derecho -->
             </div>  
             </section> 

            <div class="row">
            <div class="col-lg-12">   

            <div class="center" style="text-align: center;"> 
                     <h2>
                          
                             CONTROL DE DOCUMENTOS 
                        
                    </h2>
            </div>
                                        <?php 
                                        $idfolio = $_POST['idfolio'];
                                        $idarea=$_SESSION['idarea'];
                                        ?>
                                        <form action="guardar_modificar.php" method="post" class="form-control" enctype="multipart/form-data">
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

                                            <fieldset class="fieldset1">
                                                <legend class="legend1 estilo4">
                                                    <p>Asunto / Documento </p>
                                                </legend>

                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        Fecha<br>

                                                        <input name="fechaact" disabled="disabled" id="fechaid1" type="date" tabindex="1" value="<?php echo $row['fechaact']; ?>" required="required" class="form-control" />
                                                        <input name="fechaact" type="hidden" value="<?php echo $row['fechaact']; ?>" />
                                                    </div>
                                                    <div class="col-sm-8">
                                                        Remitente
                                                        <p><input name="remitente" class="form-control" type="text"  disabled="disabled"onKeyPress="return letra(event)" onKeyUp="activar1()" value="<?php echo $row['remitente']; ?>" required="required" onpaste="return false" tabindex="2" />
                                                    </div>
                                                </div>

                                                <fieldset class="fieldset1">
                                                    <legend class="legend1 estilo4">
                                                        <p>Detalle del Documento</p>
                                                    </legend>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <p>Fecha de emisión del documento</p>
                                                            <p><input name="fechadoc" id="fechaid1" type="date" disabled="disabled" value="<?php echo $fecha = $row['fecha_doc']; ?>" required="required" class="form-control" tabindex="3" />
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <p>Referencia</p>
                                                            <p><input name="referencia" class="form-control" disabled="disabled" type="text" onKeyPress="return letra(event)" onKeyUp="activar1()" value="<?php echo $row['docreferencia']; ?>" required="required" onpaste="return false" tabindex="4" />
                                                        </div>

                                                    </div>
                                                    <p>Descripción</p>
                                                    <p><textarea name="asunto"  class="form-control" disabled="disabled" value="" > <?php echo $row['descripcion']; ?></textarea>

                                                        <p>Observaciones</p>
                                                        <p><input name="observacion" class="form-control" disabled="disabled" type="text" onKeyPress="return letra(event)" onKeyUp="activar1()" value="<?php echo $row['observacion']; ?>" onpaste="return false" tabindex="7">

                                                </fieldset>

                                                <input name="usu" type="hidden" value="<?php echo $_SESSION['cvesp']; ?>" />
 <!--mostrar archivo para modificar -->
                    
					<label for="archivo" class="col-sm-2 control-label">Archivo</label>
					<div class="col-sm-10">
					<!--	<input type="file" class="form-control" id="archivo" name="archivo" accept="application/pdf" >
                        <label for="archivo" class="col-12 control-label">NOTA:El sistema solo acepta archivos en formato pdf que no excedan el tamaño máximo permitido (1 Mb )</label>-->
						
						<?php 
							$path = "files/".$idfolio;
							if(file_exists($path)){
								$directorio = opendir($path);
								while ($archivo = readdir($directorio))
								{
									if (!is_dir($archivo)){
                                        
                                     
                                        echo "$archivo";
										echo "<div class='center'><iframe  src='files/$idfolio/$archivo' width='120%' frameborder='0' height='550' align='center'></iframe></div>";
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

                                        <div class="col-sm-4">
                                            <form id="ver" action="tabla_oficialia.php" method="post">
                                                <input type="submit" class="btn btn-primary" title="Ver Tabla" id="opcion" value="REGRESAR " tabindex="12" />
                                            </form>
                                        </div>
                                    </div>

                                </div>
                              <!--  <div class="row">
                                    <div class="col-12">
                                            <?php // include('asignar.php') ?>
                                        </div>
                                        <p>
                                            <div id="muestra">
                                                <?php // include("tabla_asigna.php"); ?>
                                               
                                            </div>
                                    </div>-->
                                </div>
                            </div>
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

      }elseif($tipo==3){

        header("Location:tabla_usu.php");

  }else{
      header("Location:index.php");

  }

?> 
</body>
</html>