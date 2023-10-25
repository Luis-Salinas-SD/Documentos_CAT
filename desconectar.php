<?php

	require('./bd/conndb1.php');
 	$conexion = getConn();
	
session_start();
	
	$usuario= $_SESSION['cvesp'];

if ($usuario)
{
	$sql="SELECT * FROM tbl_usuarios WHERE cvesp= '$usuario'"; 
	$resultado= $conexion->query($sql);
	$f=$resultado->fetch(PDO::FETCH_ASSOC);
	
	$des=$f['estado'];
			if($des=='1'){
			$sql1="UPDATE  tbl_usuarios SET estado='0' WHERE cvesp= '$usuario'";
			$result1= $conexion->query($sql1);

			session_unset();
			session_destroy();
			header("Location:index.php");
}

}




?>