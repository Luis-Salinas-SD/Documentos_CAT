<?php
	
	$mysqli = new mysqli('localhost', 'root', '', 'bd_svc');
	
	if($mysqli->connect_error){
		
		die('Error en la conexion' . $mysqli->connect_error);
		
	}
?>