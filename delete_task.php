<?php


include("./bd/conndb.php");


$idasigna = $_POST['idasigna'];
$cvesp = $_POST['cvesp'];
$idfolio = $_POST['idfolio'];


$sql = "DELETE FROM tbl_asignados WHERE idreg = $idasigna";
$result = $conexion->query($sql);


$sql1 = "DELETE FROM tbl_resolucion WHERE docref = $idfolio and  sprecibe=$cvesp ";
$result1 = $conexion->query($sql1);



include("tabla_asigna.php");
 