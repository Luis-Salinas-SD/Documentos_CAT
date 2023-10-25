<tr>

    <td class="center">
        <?php echo $i; ?>
    </td>

    <td class="center">
        <?php echo $row['fecha_doc']; ?>
    </td>
    <td class="center">
        <?php echo $row['docreferencia']; ?>
    </td>
    <td class="center">
        <?php echo $row['remitente']; ?>
    </td>
    <td class="center">
        <?php  echo $row['descripcion']; ?>
    </td>
    <td class="center">
        <div class="alert-info">
            SIN ASIGNAR
        </div>
    </td>
          <td class="center">
        <form name="modificar" method="post" action="./modificar.php">
            <input type="hidden" name="idfolio" value="<?php echo $idfolio; ?>">
            <input type=image src="./img/mofi.png" name="modificar">

        </form>
    </td> 
    