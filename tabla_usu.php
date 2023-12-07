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
	<meta charset="UTF-8">
	<meta name="viewport" content="initial-scale=1, width=device-width">
	<!-- CSS y Scripts -->
	<?php include_once('./templates/header.php') ?>
	<title>Control de Documentación</title>
</head>

<body>
	<?php
	$tipo = $_SESSION['tipo_usuario'];
	if ($tipo == 3) {
	?>

		<?php include_once('./nav-menu.php') ?>

		<div class="contenedor">

			<!-- Header -->
			<div class="card mb-5 m-2 shadow bg-vino">
				<div class="card-body">
					<h3>Control de Documentos
						<?php $date = date_create('2000');
						echo date_format($date, 'Y'); ?>
					</h3>
				</div>
			</div>

			<div class="card mx-2">
				<div class="card-body">
					<div class="row">
						<div class="col-12 d-flex justify-content-end">
							<div class="m-1">
								<a href="historial_usuario.php" class="btn btn-vino">
									Historial
								</a>
							</div>
						</div>
					</div>

					<div class="table-responsive m-3 p-3">
						<table class="table table-bordered print-friendly hover m-2" id="catDocs">
							<thead>
								<tr class="text-center">
									<th>Consecutivo</th>
									<th>Fecha del Documento</th>
									<th>Número de Oficio</th>
									<th>Nombre del remitente</th>
									<th>Concepto</th>
									<th>Estatus</th>
									<th>Accion</th>
								</tr>
							</thead>
							<tbody>
								<?php
								require('./bd/conndb1.php');
								$conexion = getConn();
								$usu = $_SESSION['id_usuario'];

								$_pagi_sql = "SELECT * FROM tbl_docs,tbl_asignados, tbl_resolucion WHERE tbl_docs.fechaact >= '2019-01-01'
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
											<tr class="text-center">
												<td>
													<span><?php echo $x; ?></span>
												</td>
												<td>
													<span><?php echo $row['fecha_doc']; ?></span>
												</td>
												<td>
													<span> <?php echo $row['docreferencia']; ?>
												</td>
												<td>
													<span><?php echo $row['remitente']; ?></span>
												</td>
												<td>
													<span><?php echo $row['descripcion']; ?></span>
												</td>
												<td>
													<div class="alert alert-amarillo" style=" width: 125px;">
														<span>En proceso...</span>
													</div>
												</td>
												<td>
													<form name="resolucion" method="post" action="./resolucion_usu.php">
														<input type="hidden" name="idfolio" value="<?php echo $row['Idfolio'] ?>">
														<!-- <input type="submit" name="resolucion" class="btn btn-info" value="resolución"> -->
														<button type="submit" name="resolucion" class="btn btn-success p-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Resolución">
															<img src="assets/icons/info.svg">
														</button>
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

	<?php include_once('./templates/scripts.php') ?>


</body>

</html>