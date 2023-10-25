<?php

include('./bd/conndb.php');


$idfolio = $_POST['folio'];
$cvesp = $_POST['usuarios'];
$idconcepto = $_POST['concepto'];

$sql = "INSERT INTO tbl_asignados(idfolio, cvesp, idconcepto) VALUES($idfolio,'$cvesp',$idconcepto)";
$result = $conexion->query($sql);

$query="UPDATE tbl_docs SET asignar=1 WHERE Idfolio=$idfolio";
$resultados = $conexion->query($query);

$query = "INSERT INTO tbl_resolucion(docref, estatus,sprecibe) 
			VALUES ('$idfolio', 1, '$cvesp')";
$result = $conexion->query($query);

include('tabla_asigna.php');
$conexion = 'null';
?>