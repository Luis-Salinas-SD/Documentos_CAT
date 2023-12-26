<!-- <script language="javascript">
  $(document).ready(function() {
    $("#area").on('change', function() {
      $("#area option:selected").each(function() {
        elegido = $(this).val();
        $.post("./usuarios.php", {
          elegido: elegido
        }, function(data) {
          $("#usuarios").html(data);
        });
      });
    });
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
</script> -->

<!-- <script language="javascript">
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
</script> -->

<?php
//include "php/navbar.php";
include "bd/conexion.php";
$idarea = $_SESSION['idarea'];
?>

<div class="col-12 text-center text-secondary">
  <h4>Servidores Públicos Asignados</h4>
</div>
<div class="col-12 text-end">
  <!-- Button trigger modal -->
  <form class="form-inline" role="search" id="buscar">
    <div class="form-group">
      <!--<input type="text" name="s" class="form-control" placeholder="Buscar">-->
    </div>
    <!-- <button type="submit" class="btn btn-default">&nbsp;<i class="glyphicon glyphicon-search"></i>&nbsp;</button> -->
    <a data-toggle="modal" href="#newModal" class="btn btn-success m-3">Asignar</a>
  </form>
</div>

<br>
<!-- Modal -- SUTITUIR POR COMBOS-->
<div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title text-secondary">Asignar Actividades</h4>
      </div>
      <div class="modal-body">
        <form role="form" method="post" id="agregar"> <!-- action="leerdatos.php" -->
          <input type="hidden" id="folio" value=<?php echo $idfolio; ?> name="folio">
          <input type="hidden" id="area" value=<?php echo $idarea; ?> name="area">
          <div class="form-group mb-3">
            <label for="lastname" class="form-label">Servidor Público</label>
            <?php
            $sql1 = "SELECT * FROM tbl_usuarios, cat_areas where cat_areas.Id= $idarea and cat_areas.Id=tbl_usuarios.idarea  ";
            $resultado = $dbh->query($sql1); ?>
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
            <label for="address" class="form-label">Catálogo de servicios</label>
            <select name="concepto" class="form-select" tabindex="10" id="concepto">
              <option name="concepto" value="0"> Elige un Concepto</option>
            </select>
          </div>

          <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary">Agregar</button>
          </div>
        </form>
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="tabla" class="col-12 p-2"></div>



<script>
  let opcion = document.getElementById('usuarios');
  let concepto = document.getElementById('concepto');
  let nuevaOpcion


  opcion.addEventListener('click', (e) => {
    let idUsuario = e.target.value;

    fetch('conceptos.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(idUsuario)
      })
      .then(response => response.json())
      .then(rTarea => {
        // acceder a los elementos individualmente
        concepto.innerHTML = "";
        rTarea.forEach(usuario => {
          // Crear un nuevo elemento option
          nuevaOpcion = document.createElement("option");
          nuevaOpcion.value = usuario.id; // Asignar el valor del usuario
          nuevaOpcion.text = usuario.tarea; // Asignar el texto del usuario

          // Agregar la nueva opción al elemento select
          concepto.add(nuevaOpcion);
        });
      })
      .catch(erro => console.error('Error:' + erro))
  })
</script>



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
    $.post("agregar.php", $("#agregar").serialize(), function(data) {
      alert('Asignado con exito');
      location.reload()
      $("#agregar")[0].reset();
    });
  });
</script>