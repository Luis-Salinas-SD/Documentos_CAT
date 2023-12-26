<?php
//include "php/navbar.php";
include "bd/conexion.php";
$idarea = $_SESSION['idarea'];
?>

<div class="col-12 text-center text-secondary">
  <h4>Servidores públicos asignados</h4>
</div>
<div class="col-12 text-end">
  <!-- Button trigger modal -->
  <form class="form-inline" role="search" id="buscar">
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

          <div class="form-group mb-2">
            <label for="name" class="form-label">Unidad administrativa </label>
            <?php
            //consulta datos a cargar en combo
            $sql = "SELECT * FROM cat_areas WHERE Id != 3 ORDER BY area;";
            $resultado = $dbh->query($sql);
            ?>

            <select name="area" id="area" class="form-control" tabindex="8">
              <option name="areas" value="0"> Elige una opción</option>
              <?php while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
                $area = $row['area'];
              ?>
                <option name="areas" value="<?php echo $row['Id']; ?>"><?php echo trim($area); ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group mb-2">
            <label class="form-label">Servidor público</label>
            <select name="usuario" id="usuarios" class="form-select" tabindex="9">
              <option value="0"> Elige un Servidor Publico</option>
            </select>
          </div>

          <div class="form-group mb-2">
            <label for="address" class="form-label">Catálogo de servicios</label>
            <select name="concepto" class="form-select" tabindex="10" id="concepto">
              <option name="concepto" value="0"> Elige un Concepto</option>
            </select>
          </div>

          <div class="col-12 text-end my-3">
            <button type="submit" class="btn btn-primary">Agregar</button>
          </div>

        </form>
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="tabla"></div>



<script>
  //% + + + + + + + + + + + + + + + + + Script para la elección de la asignacion de usuario y conceptos del MODAL + + + + + + + + + + + + + + + + + + + +

  //!variables
  let area = document.getElementById('area');
  let opcion = document.getElementById("usuarios");
  let concepto = document.getElementById('concepto');
  let nuevaOpcion

  //! Evento para mostrar a los usuarios
  area.addEventListener('change', (e) => {
    let idArea = e.target.value;
    //- Envio de la información a traves de fetch
    fetch('usuarios.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(idArea)
      })
      .then(response => response.json())
      .then(respuesta => {
        //= Limpiar las opcines del select
        opcion.innerHTML = "";
        //= Acceder al arreglo que viene de la respuesta del arreglo de usuarios.php
        respuesta.forEach(usuario => {
          //= Crear un nuevo elemento option
          nuevaOpcion = document.createElement("option");
          //= Asignando el valor y nombre a cada uno de ellos
          nuevaOpcion.value = usuario.id_usuario; //* Asignar el valor del usuario al <option>
          nuevaOpcion.text = usuario.nombre; //* Asignar el texto del usuario al <option>

          //= Agregar la nueva opción al elemento select
          opcion.add(nuevaOpcion);
        });
      })
      .catch(error => console.error('Error:' + error))

  })
  //# Evento para mostrar los conceptos
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
    //document.write("idfolio = " + idfolio);
    $('#editModal').modal('hide');
    $.get("./tabla.php", {
      folio: idfolio
    }, function(data) {
      $("#tabla").html(data);
    })
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