<?php

//include "bd/conexion.php";

include "bd/conexion.php";


//$user_id=null;
//$sql1= "select * from person";
if (isset($_GET['folio'])) {
	//echo "Variable definida!!!";
	$folio = $_GET['folio'];
}

$query = "SELECT * from tbl_asignados where idfolio=$folio";
$resultado = $dbh->query($query);
$numfilas = $resultado->rowCount();
if ($numfilas == 0) {

	$sql1 = "UPDATE tbl_docs SET asignar=0 where Idfolio=$folio";
	$res = $dbh->query($sql1);
} else {

	$sql = "select a.idreg as id, a.idfolio as folio, s.area as area, u.id_usuario as cve, u.nombre as sp, c.tarea as concep  from  tbl_asignados a, tbl_usuarios u, cat_areas s, cat_conceptos c where u.id_usuario = a.cvesp and s.id = u.idarea and  c.id = a.idconcepto and a.idfolio = $folio";
	$query = $dbh->query($sql);
	$numfila = $query->rowCount();
?>

	<?php if ($numfila > 0) { ?>
		<div class="table-responsive m-2">
			<table class="table table-bordered table-hover">
				<thead>
					<th>Área</th>
					<th>Servidor Público</th>
					<th>Concepto</th>
					<!--<th>Direccion</th>
				<th>Telefono</th> -->
					<th></th>
				</thead>
				<?php while ($r = $query->fetch(PDO::FETCH_ASSOC)) : ?>
					<tr>
						<?php
						$id = $r["id"];
						$folio = $r["folio"];
						$cve = $r["cve"];
						?>

						<td><?php echo $r["area"]; ?></td>
						<td><?php echo $r["sp"]; ?></td>
						<td><?php echo $r["concep"]; ?></td>
						<!--<td><?php //echo $r["address"];
								?></td>
					<td><?php //echo $r["phone"];
						?></td>-->
						<td style="width:150px;" class="text-center">
							<!--	<a data-id="<?php //echo $cvesp;
												?>" class="btn btn-edit btn-sm btn-warning">Editar</a> -->
							<a href="#" id="del-<?php echo $id; ?>" class="btn btn-sm btn-danger">
								<img src="./assets/icons/trash.svg" alt="" srcset="">
							</a>
							<script>
								var cvesp = "<?php echo $cve; ?>";
								$("#del-" + <?php echo $id; ?>).click(function(e) {
									e.preventDefault();
									p = confirm("Estas seguro?");
									if (p) {
										$.get("eliminar.php", "id=" + <?php echo $id; ?> + "&sp=" + <?php echo $cve; ?> + "&folio=" + <?php echo $folio; ?>, function(data) {
											loadTabla();
										});
									}
								});
							</script>
						</td>
					</tr>
				<?php endwhile; ?>
			</table>
		</div>
	<?php } else {

	?>
		<p class="alert alert-warning">No hay resultados</p>


<?php //endif;
	}
}
?>
<!-- Modal -->
<script>
	$(".btn-edit").click(function() {
		var folio = "<?php echo $idfolio; ?>";
		cvesp = $(this).data("cvesp");
		$.get("./php/formulario.php", "cvesp=" + cvesp + "folio=" + folio, function(data) {
			$("#form-edit").html(data);
		});
		$('#editModal').modal('show');
	});
</script>
<?php ?>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Actualizar</h4>
			</div>
			<div class="modal-body">
				<div id="form-edit"></div>
			</div>

		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->