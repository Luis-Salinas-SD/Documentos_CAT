<?php
session_start();
require('./bd/conndb1.php');
$conexion = getConn();
$usuario = $_POST['usuario'];
$password = $_POST['password'];

$sql = "SELECT * FROM tbl_usuarios WHERE cvesp= '$usuario'";
$resultado = $conexion->query($sql);
if ($f = $resultado->fetch(PDO::FETCH_ASSOC)) {

	if ($password == $f['pass']) {

		$des = $f['estado'];
		$tipo = $f['tipo_usuario'];

		if ($des == '0') {
			if ($tipo == 1) {
				$sql1 = "UPDATE  tbl_usuarios SET estado='1' WHERE cvesp= '$usuario' and tipo_usuario=$tipo";
				$result1 = $conexion->query($sql1);
				$_SESSION['cvesp'] = $f['cvesp'];
				$_SESSION['nombre'] = $f['nombre'];
				$_SESSION['tipo_usuario'] = $f['tipo_usuario'];
				$_SESSION['idarea'] = $f['idarea'];
				$_SESSION['id_usuario'] = $f['id_usuario'];
				$_SESSION['tipo_usuario'] = $f['tipo_usuario'];
				header("Location:tabla_admon.php");
			} else if ($tipo == 2) {
				$sql1 = "UPDATE  tbl_usuarios SET estado='1' WHERE cvesp= '$usuario' and tipo_usuario=$tipo";
				$result1 = $conexion->query($sql1);
				$_SESSION['cvesp'] = $f['cvesp'];
				$_SESSION['nombre'] = $f['nombre'];
				$_SESSION['tipo_usuario'] = $f['tipo_usuario'];
				$_SESSION['idarea'] = $f['idarea'];
				$_SESSION['id_usuario'] = $f['id_usuario'];
				$_SESSION['tipo_usuario'] = $f['tipo_usuario'];
				header("Location:tabla_super.php");
			} else if ($tipo == 3) {
				$sql1 = "UPDATE  tbl_usuarios SET estado='1' WHERE cvesp= '$usuario' and tipo_usuario=$tipo";
				$result1 = $conexion->query($sql1);
				$_SESSION['cvesp'] = $f['cvesp'];
				$_SESSION['nombre'] = $f['nombre'];
				$_SESSION['tipo_usuario'] = $f['tipo_usuario'];
				$_SESSION['idarea'] = $f['idarea'];
				$_SESSION['id_usuario'] = $f['id_usuario'];
				$_SESSION['tipo_usuario'] = $f['tipo_usuario'];
				header("Location:tabla_usu.php");
			} else if ($tipo == 4) {
				$sql1 = "UPDATE  tbl_usuarios SET estado='1' WHERE cvesp= '$usuario' and tipo_usuario=$tipo";
				$result1 = $conexion->query($sql1);
				$_SESSION['cvesp'] = $f['cvesp'];
				$_SESSION['nombre'] = $f['nombre'];
				$_SESSION['tipo_usuario'] = $f['tipo_usuario'];
				$_SESSION['idarea'] = $f['idarea'];
				$_SESSION['id_usuario'] = $f['id_usuario'];
				$_SESSION['tipo_usuario'] = $f['tipo_usuario'];
				header("Location:tabla_oficialia.php");
			}
		} else {
			echo '<script>alert("SESION INICIADA... FAVOR DE CERRAR SESION ANTERIOR PARA PODER INGRESAR")</script> ';

			echo "<script>location.href='index.php'</script>";
		}
	} else {
		echo '<script>alert("CONTRASEÑA INCORRECTA")</script> ';

		echo "<script>location.href='index.php'</script>";
	}
} else {

	echo '<script>alert("ESTE USUARIO NO EXISTE")</script> ';

	echo "<script>location.href='index.php'</script>";
}

?>

<script>
	setTimeout('document.location.reload()', 20000);
</script>