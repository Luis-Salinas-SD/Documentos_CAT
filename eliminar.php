<?php

if(!empty($_GET)){
			include "./bd/conexion.php";
			
			$id=trim($_GET["id"]);
			$cvesp=trim($_GET["sp"]);
			$idfolio = trim($_GET["folio"]);

			$sql1 = "DELETE FROM tbl_resolucion WHERE docref = $idfolio and  sprecibe = '$cvesp'";
			echo $sql1;
			$result1 = $dbh->query($sql1);
 

			$sql = "DELETE FROM tbl_asignados WHERE idreg= $id";
			echo $sql;
			$query = $dbh->query($sql);


		


			if($query!=null){
				print "<script>alert(\"Eliminado exitosamente.\");window.location='./asignar.php';</script>";
			}else{
				print "<script>alert(\"No se pudo eliminar.\");window.location='./asignar.php';</script>";

			}

	



}

?>