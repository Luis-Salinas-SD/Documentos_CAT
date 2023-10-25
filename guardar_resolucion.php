<?php
session_start();
include("./bd/conndb.php");

 $idfolio = $_POST['idfolio'];
 $tipodoc = $_POST['tipo_doc'];
 $num_doc = $_POST['num_doc'];
 $fechares = $_POST['fechares'];
 $cvesp = $_POST[ 'usu'];
 $nota = $_POST[ 'nota'];
 
$idfolio = $idfolio;


$query1 = ("UPDATE tbl_resolucion SET tipodocref='$tipodoc', nodoc='$num_doc', fecha='$fechares', estatus= 0, nota='$nota'
WHERE docref=$idfolio and sprecibe='$cvesp' ");
$result = $conexion->query($query1);
	
	if($_FILES["archivo"]["error"]>0){
		echo '<script>alert("Sin cargar archivo")</script> ';
		} else {
		
		$permitidos = array("application/pdf");
		$limite_kb = 25600;
		
		if(in_array($_FILES["archivo"]["type"], $permitidos) && $_FILES["archivo"]["size"] <= $limite_kb * 25600)
		{
			
			$ruta = 'files/'.$idfolio.'/';
			$archivo = $ruta.$_FILES["archivo"]["name"];
			
			if(!file_exists($ruta)){
				mkdir($ruta);
			}
			
			if(!file_exists($archivo)){
				
				$resultado = @move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivo);
				
				if($resultado){
					//echo "Archivo Guardado";
					echo '<script>alert("Archivo Guardado")</script> ';
					
										
				
				
				} else {
					echo '<script>alert("Error al guardar archivo")</script> ';
					echo "<script>location.href='tabla_admon.php' </script>";
				}
				
				} else {
				echo '<script>alert("Archivo ya existe")</script> ';
				echo "<script>location.href='tabla_admon.php' </script>";
			}
			
			} else {
			echo '<script>alert("Archivo no permitido o excede el tamaño")</script> ';
			echo "<script>location.href='tabla_admon.php' </script>";
		}
		
	}
	if($result){
		echo '<script>alert("REGISTRO GUARDADO")</script> ';
		echo "<script>location.href='tabla_admon.php' </script>";

		  
		}
		 else{
		 echo "no exitosa";
	 }
			
	
	
 ?>