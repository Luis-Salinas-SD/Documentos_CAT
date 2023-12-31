<script language="javascript">
  $(document).ready(function() {

    $("#usuarios").on('change', function() {
      $("#usuarios option:selected").each(function() {
        elegido1 = $(this).val();
        $.post("./conceptos.php", {
          elegido1: elegido1
        }, function(data) {
          $("#concepto").html(data);
        });
      });
    });
  });
</script>

<?php
//include "php/navbar.php";
include "bd/conexion.php";
$idarea = $_SESSION['idarea'];
?>

<div class="card m-2">
  <div class="card-body">
    <h5 class="text-secondary">Servidores Públicos Asignados</h5>
    <!-- Button trigger modal -->
    <form class="form-inline" role="search" id="buscar">
      <div class="form-group">
        <!--<input type="text" name="s" class="form-control" placeholder="Buscar">-->
      </div>
      <!-- <button type="submit" class="btn btn-default">&nbsp;<i class="glyphicon glyphicon-search"></i>&nbsp;</button> -->
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newModal">
        Agregar
      </button>
    </form>
  </div>
</div>

<br>
<!-- Modal -- SUTITUIR POR COMBOS-->
<div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Asignar Actividades</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form role="form" method="post" id="agregar" class="p-2 m-1"> <!-- action="leerdatos.php" -->
          <input type="hidden" id="folio" value=<?php echo $idfolio; ?> name="folio">
          <input type="hidden" id="area" value=<?php echo $idarea; ?> name="area">
          <div class="form-group mb-2">
            <label for="lastname" class="form-label">Servidor Público</label>
            <?php
            $sql1 = "SELECT * FROM tbl_usuarios, cat_areas where cat_areas.Id= $idarea and cat_areas.Id=tbl_usuarios.idarea  ";
            $resultado = $dbh->query($sql1);
            ?>
            <select name="usuario" id="usuarios" class="form-select" tabindex="9">
              <option value="0"> Elige una opción</option>
              <?php
              while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
              ?>
                <option value="<?php echo $row['id_usuario']; ?>"><?php echo $row['nombre']; ?></option>
              <?php
              } ?>
            </select>
            <!-- <input type="text" class="form-control" name="lastname" required> -->
          </div>
          <div class="form-group mb-2">
            <label for="address" class="form-label">Concepto</label>
            <?php
            $sql2 = "SELECT * FROM tbl_usuarios, cat_conceptos where cat_conceptos.id_usuario=4 and cat_conceptos.id_usuario=tbl_usuarios.id_usuario";
            $resultado2 = $dbh->query($sql2); ?>
            <select name="concepto" class="form-control" tabindex="10" id="concepto">
              <option value="0"> Elige un Concepto</option>
              <?php
              while ($row2 = $resultado2->fetch(PDO::FETCH_ASSOC)) {
              ?>
                <option value="<?php echo $row2['Id']; ?>"><?php echo $row2['tarea']; ?></option>
              <?php
              }
              ?>
            </select>
          </div>

          <div class="col-12 d-flex justify-content-end mt-3">
            <button type="submit" class="btn btn-primary">Agregar</button>
          </div>
        </form>
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="tabla"></div>



<script>
  function loadTabla() {
    var idfolio = "<?php echo $idfolio; ?>";
    var idarea = "<?php echo $idarea; ?>";
    //document.write("idfolio = " + idfolio);
    $('#editModal').modal('hide');
    $.get("./super_tabla.php", {
      folio: idfolio,
      idarea: idarea
    }, function(data) {
      $("#tabla").html(data);
    })
    //{folio :  idfolio} "&usuarios="+sp
  }

  $("#buscar").submit(function(e) {
    e.preventDefault();
    $.get("busqueda.php", $("#buscar").serialize(), function(data) {
      $("#tabla").html(data);
      $("#buscar")[0].reset();
    });
  });

  loadTabla();

  $("#agregar").submit(function(e) {
    e.preventDefault();
    $.post("agregar_super.php", $("#agregar").serialize(), function(data) {});
    //alert("Agregado exitosamente!");
    $("#agregar")[0].reset();
    $('#newModal').modal('hide');
    loadTabla();
  });
</script>