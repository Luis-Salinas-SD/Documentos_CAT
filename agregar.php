<?php


if (!empty($_POST)) {

	/* $idfolio = isset($_POST['folio']);
	echo "Folio no.:" . $idfolio . "<br>";
	$cvesp = isset($_POST['usuario']);
	echo "Clave de Servidor no.:" . $cvesp . "<br>";
	$concepto = isset($_POST['concepto']);
	echo "Concepto no.:" . $concepto . "<br>"; */

	if (isset($_POST['folio']) && isset($_POST['usuario']) && isset($_POST['concepto']) && isset($_POST['area'])) {
		if ($_POST["folio"] != "" && $_POST["usuario"] != "" && $_POST["concepto"] != "" && $_POST["area"] != "") {

			echo "<br>";
			include "./bd/conexion.php";
			$idfolio = trim($_POST['folio']);
			$cvesp = trim($_POST['usuario']);
			$idconcep = trim($_POST['concepto']);
			$idarea = trim($_POST['area']);

			$sql = ("INSERT INTO tbl_asignados(idfolio, cvesp, idconcepto,id_area) VALUES($idfolio,'$cvesp',$idconcep,$idarea)");
			$result = $dbh->query($sql);

			$query = "INSERT INTO tbl_resolucion(docref, estatus,sprecibe) VALUES ('$idfolio', 1, '$cvesp')";
			$result2 = $dbh->query($query);

			$query2 = "UPDATE tbl_docs SET asignar=1 WHERE Idfolio=$idfolio";
			$resultados = $dbh->query($query2);

			if (($result != null) && ($result2 != null) && ($resultados != null)) {
				print "<script>alert(\"Agregado exitosamente.\");window.location='asignar.php';</script>";
			} else {
				print "<script>alert(\"No se pudo agregar.\");window.location='asignar.php';</script>";
				//print "<script>alert(\"No se pudo agregar.\");</script>";
			}
		}
	}
}
