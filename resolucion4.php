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
    <link rel="stylesheet" href="css/estilo_index.css">
    <script src="js/jquery-3.3.1.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
  <title>CONTROL DE DOCUMENTOS</title>
  </head>

<body>
<?php
$tipo=$_SESSION['tipo_usuario'];
    if($tipo==3){
?> 
        <header>
            
		</header>
        <p>
        <table width="980" class="ubica1">
					<td width="479" align="left" ><a>  Bienvenido <strong><?php echo $_SESSION['nombre']; ?></strong></a> </td>

					<td width="105" align="right"><a class="external" href="./Manuales/analista.pdf">
                     <input id="ayuda" type="image" src="./img/help.png" alt ="Ayuda" title="Ayuda">
                     </a>
					 </td>
					 
	  				<td width="105" align="right"><a href="desconectar.php"> Cerrar Sesion </a></td>
   				 </table>

<div class="container">
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
        
            <div class="row">
            <div class="col-lg-12">   

            <div class="center" style="text-align: center;"> 
                     <h2>
                          
                             CONTROL DE DOCUMENTOS 
                        
                    </h2>
            </div>
           <?php 
            $idfolio =$_REQUEST['idfolio'] ;
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
			<form  action="crearpt.php" method="post" class="form-control"  enctype="multipart/form-data" >
                <input  type="hidden"  name="idfolio"  value="<?php echo $idfolio; ?>" >


	        <fieldset class="fieldset1">
            <legend class="legend1 estilo4">
            <p>Asunto / Documento </p> </legend>
    		   <div class="row">
				<div class="col-sm-4">
			   Fecha
 				
            <input name="fechaact"  disabled="disabled" type="text"  value="<?php echo $fecha=$row['fechaact']; ?>"  class="form-control"/>
   			</div> 
			<div class="col-sm-8">
 			 Remitente
 			 <input name="remitente" disabled="disabled" class="form-control" type="text" value="<?php echo $row['remitente']; ?>" tabindex="1"/>
    </div> 
	</div> 
    
            <fieldset class="fieldset1">
            <legend class="legend1 estilo4">
            <p>Detalle del Documento</p> </legend>
			<div class="row">
				<div class="col-sm-4">
  			Fecha de emisión del documento
  			<input  name="fechadoc"  disabled="disabled" type="text"  value="<?php  echo $fecha = $row['fecha_doc']; ?>"  class="form-control"/>
 			</div> 
			<div class="col-sm-4">
			Referencia
			<input name="referencia" disabled="disabled" class="form-control" type="text"  value="<?php echo $row['docreferencia']; ?>"  tabindex="4"/> 
			</div> 
			
			</div> 	
			<p>Descripción</p>
			<p><textarea name="asunto"  class="form-control" disabled="disabled" value="" > <?php echo $row['descripcion']; ?></textarea>
				
			<p>Observaciones</p>
			<p><input name="observacion" disabled="disabled" class="form-control" type="text"value="<?php echo $row['observacion']; ?>" tabindex="4">

        </fieldset>
	
        <?php include ("tabla_resolucion.php"); ?>

 		<input name="usu" type="hidden" value="<?php echo $_SESSION['cvesp'];?>" />
		
         <div class="col-sm-10">
				<!--	<input type="file" class="form-control" id="archivo" name="archivo">-->
						
						<?php 
							$path = "files/".$idfolio;
							if(file_exists($path)){
								$directorio = opendir($path);
								while ($archivo = readdir($directorio))
								{
									if (!is_dir($archivo)){
                                        
                                        echo "$archivo";
										echo "<div class='center'><iframe  src='files/$idfolio/$archivo' width='120%' frameborder='0' height='550'></iframe></div>";
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
					</form >
					
                     <div class="col-sm-4">
					 <form id="ver" action="tabla_usu.php" method="post">
						<input type="submit" class="tbl" title="Ver Tabla" id="opcion" value=" "/> 
					</form>
					</div> 
   				</div> 
       
            
                   </div>
             </div>    
         
       
   
    <script type="text/javascript">
                    $(document).ready(function() {
                        $("form.external").on('click', function() {
                            url = $(this).attr("action");
                            window.open(url, '_blank');
                            return false;
                        });
                    });
                </script>
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