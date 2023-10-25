<!DOCTYPE html>
<?php
$i = 1;
session_start();
if (@!$_SESSION['cvesp']) {
	header("Location:index.php");
}
?>
<html>

<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/estilo_index.css">

	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<title>CONTROL DE DOCUMENTACION</title>
</head>

<body>
	<?php
	$tipo = $_SESSION['tipo_usuario'];
	if ($tipo == 3) {
	?>

		<?php include_once('./nav-menu.php') ?>
		<header>

		</header>
		<table width="980" class="ubica1">
			<td width="479" align="left"><a> Bienvenido <strong><?php echo $_SESSION['nombre']; ?></strong></a> </td>

			<td width="105" align="right"><a class="external" href="./Manuales/analista.pdf">
					<input id="ayuda" type="image" src="./img/help.png" alt="Ayuda" title="Ayuda">
				</a>
			</td>

			<td width="105" align="right"><a href="desconectar.php"> Cerrar Sesion </a></td>
		</table>


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

		<div class="container">
			<div class="row">
				<div class="col-12">

					<table id="ubica1" class="table table-striped">
						<thead>
							<tr id="bordes2">
								<th id="bordes2" colspan="11">
									<p class="Estilo4">CONTROL DE DOCUMENTOS

										<?php $date = date_create('2000');
										echo date_format($date, 'Y'); ?> </p>
								</th>
							</tr>
						</thead>
						<tbody>
							<tr class="letra1">
								<td>
									<div align="center"><em><strong><span> Consecutivo </span></strong></em></div>
								</td>

								<td>
									<div align="center"><em><strong><span> Fecha del Documento</span></strong></em></div>
								</td>
								<td id="bordes2">
									<div align="center"><em><strong><span> Numero de Oficio </span></strong></em></div>
								</td>
								<td id="bordes2">
									<div align="center"><em><strong><span> Nombre del remitente</span></strong></em></div>
								</td>
								<td id="bordes2">
									<div align="center"><em><strong><span> Concepto</span></strong></em></div>
								</td>
								<td colspan="2" id="bordes2">
									<div align="center"><em><strong><span> Estatus</span></strong></em></div>
								</td>

							</tr>


							<?php
							require('./bd/conndb1.php');
							$conexion = getConn();
							$usu = $_SESSION['id_usuario'];

							$_pagi_sql = "SELECT * FROM tbl_docs,tbl_asignados, tbl_resolucion
	WHERE tbl_docs.fechaact >= '2019-01-01'
	and tbl_asignados.cvesp=$usu
	and tbl_resolucion.estatus=1
    and tbl_asignados.cvesp=tbl_resolucion.sprecibe
	and tbl_asignados.idfolio=tbl_docs.Idfolio
	and tbl_docs.idfolio=tbl_resolucion.docref
	order by tbl_docs.idfolio desc";

							//and fecha >='2019-01-01'
							$_pagi_result = $conexion->query($_pagi_sql);
							$numfilas = $_pagi_result->rowCount();
							if ($numfilas == 0) {
								echo '<script>alert(" NO CUENTA CON REGISTROS EN ESTA SECCION ")</script>';
							} else {

								$_pagi_nav_estilo = "cls_pagi";
								$enlacesdepaginacion = 11;

								include("paginator2.inc.php");

								while ($i <= 1) {
									$x = $_pagi_hasta;

									while ($row = $_pagi_result->fetch(PDO::FETCH_ASSOC)) {

							?>
										<tr class="letra2" id="bordes2">
											<td id="bordes2">
												<div align="center"><span> <?php echo $x; ?></span></div>
											</td>
											<td id="bordes2">
												<div align="center"><span><?php echo $row['fecha_doc']; ?></span></div>
											</td>
											<td id="bordes2">
												<div align="center"><span> <?php echo $row['docreferencia']; ?></span></div>
											</td>
											<td id="bordes2">
												<div align="center"><span><?php echo $row['remitente']; ?></span></div>
											</td>
											<td id="bordes2">
												<div align="center"><span><?php echo $row['descripcion']; ?></span></div>
											</td>
											<td id="bordes2">
												<div align="center" class="alert alert-success"><span>
														<strong>En proceso</strong>
													</span></div>
											</td>

											<td align="center" id="bordes2">
												<form name="resolucion" method="post" action="./resolucion_usu.php">
													<input type="hidden" name="idfolio" value="<?php echo $row['Idfolio'] ?>">
													<input type="submit" name="resolucion" class="btn btn-info" value="RESOLUCION">

												</form>
											</td>




										</tr>
									<?php
										$i++;
										$x--;
									}
									$sig = $_Num_regis_Consul + 1;
									?>

							<?php

								}
							}
							?>
						</tbody>
					</table>
					<?php

					$conexion = null;
					if ($numfilas == 0) {
					} else {
						echo "<div id = \"cls_pagi\"><p align=\"center\">" . $_pagi_navegacion . "</p>";
					}

					?>
				</div>
			</div>
		</div>

		</div>
		<script type="text/javascript">
			$(document).ready(function() {
				$("a.external").on('click', function() {
					url = $(this).attr("href");
					window.open(url, '_blank');
					return false;
				});
			});
		</script>
	<?php
	} elseif ($tipo == 1) {

		header("Location:tabla_admon.php");
	} elseif ($tipo == 2) {

		header("Location:tabla_super.php");
	} elseif ($tipo == 4) {

		header("Location:tabla_oficialia.php");
	} else {
		header("Location:index.php");
	}

	?>

</body>

</html>