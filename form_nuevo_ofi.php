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
                     <h3>
                          
                             AGREGAR NUEVO ASUNTO
                        
                    </h3>
            </div>
                                <?php
                                $i = 1;
                                require('./bd/conndb1.php');
                                $conexion = getConn();

                                $query = "SELECT (max(Idfolio) +1) from tbl_docs";
                                $resultado = $conexion->query($query);
                                $row = $resultado->fetch(PDO::FETCH_COLUMN);
                                if($row>=1){
                                     $idfolio=$row;
                                 }else{
                                     
                                     $idfolio=1;
                                    }
           
                                ?>

                                <form action="guardar.php" method="post" class="form-control" enctype="multipart/form-data">

                                    <div class="class-group">
                                        <fieldset class="fieldset1">
                                            <legend class="legend1 estilo4">
                                                <p>Asunto/ Documento </p>
                                            </legend>
                                            <div class="row">
                                                <div class="col-sm-4">


                                                    <input name="idfolio" type="hidden" value="<?php echo $idfolio; ?>" />
                                                    <p>Fecha <br>
                                                        <?php 
                                                        date_default_timezone_set('America/Mexico_City');
                                                        $fecha = date('y/m/d');
                                                        $fecha1 = date('d/m/Y');
                                                        ?>
                                                        <input name="fechaact" disabled="disabled" tabindex="1" value="<?php echo $fecha1; ?>" required="required" class="form-control" />
                                                        <input name="fechaact" type="hidden" value="<?php echo $fecha; ?>" required="required" />
                                                </div>
                                                <div class="col-sm-8">
                                                    Remitente
                                                    <input name="remitente" class="form-control" type="text" onKeyUp="activar1()" value="" required="required"  tabindex="2" />
                                                </div>
                                            </div>

                                            <fieldset class="fieldset1">
                                                <legend class="legend1 estilo4">
                                                    <p>Detalle del Documento</p>
                                                </legend>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <p>Fecha de emisión del documento
                                                            <input id="fechaid1" name="fechadoc" type="date" value=" " required="required" class="form-control" tabindex="3" />
                                                    </div>
                                                    <div class="col-sm-4">
                                                        Referencia
                                                        <input name="referencia" class="form-control" type="text"  onKeyUp="activar1()" value="" required="required" tabindex="4" />
                                                    </div>
                                                </div>
                                                <p>Descripción</p>
                                                <p><textarea name="asunto" class="form-control" onKeyUp="activar1()" required tabindex="6"></textarea>

                                                    <p>Observaciones</p>
                                                    <p><textarea name="observacion" class="form-control" type="text" onKeyUp="activar1()" value="" required tabindex="7"></textarea>

                                            </fieldset>
                                            <input name="usu" type="hidden" value="<?php echo $_SESSION['cvesp']; ?>" />

                                            <div class="row">
                                            <div class="form-group">
                                                                <label for="archivo" class="col-sm-2 control-label">Archivo</label>
                                                               
                                                                <div class="col-12">
                                                                    <input type="file" class="form-control" id="archivo" name="archivo" accept="application/pdf"  >
                                                                </div>
                                                                <label for="archivo" class="col-12 control-label">NOTA:El sistema solo acepta archivos en formato pdf que no excedan el tamaño máximo permitido (25 Mb )</label>
                                                            </div>
                                            </div>
                                            </div>

                                           
                                            <button type="submit" class="btn btn-primary">
                                                GUARDAR
                                            </button>
                                </form>
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