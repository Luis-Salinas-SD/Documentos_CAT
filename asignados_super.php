<tr>

    <td class="center">
        <?php echo $x; ?>
    </td>
    <td class="center">
        <?php echo $fecha_doc; ?>
    </td>
    <td class="center">
        <?php echo $docreferencia; ?>
    </td>
    <td class="center">
        <?php echo $remitente; ?>
    </td>
    <td class="center">
        <?php echo $descripcion; ?>
    </td>
    
    <?php 
   
    $sql = "SELECT COUNT(*) as total , estatus FROM tbl_resolucion  
        WHERE docref =$idfolio
        and estatus=1";
    $resul = $conexion->query($sql);
    $row = $resul->fetch(PDO::FETCH_ASSOC);
    if ($row['total'] >= 1) {
        ?>
    <td class="center">
    <div class="alert-success">
            EN PROCESO
        </div>
    </td>

    <td class="center">
        <form name="resolucion" method="post" action="./resolucion3.php">
            <input type="hidden" name="idfolio" value="<?php echo $idfolio; ?>">
            <input type="submit" name="resolucion" class=" btn-info" value="RESOLUCION">

        </form>
    </td>

    <td class="center">
        <form name="modificar" method="post" action="./modificar_super.php">
            <input type="hidden" name="idfolio" value="<?php echo $idfolio; ?>">
            <input type=image src="./img/mofi.png" name="modificar">

        </form>
    </td>

    
    <td class="center">
   
        <?php
         $usu = $_SESSION['id_usuario'];

      $query = "SELECT * FROM tbl_docs,tbl_asignados, tbl_resolucion
                        WHERE tbl_docs.fechaact >= '2019-01-01'
                        and tbl_asignados.cvesp=$usu
                        and tbl_resolucion.estatus=1
                        and tbl_asignados.cvesp=tbl_resolucion.sprecibe
                        and tbl_asignados.idfolio=tbl_docs.Idfolio
                        and tbl_docs.idfolio=tbl_resolucion.docref
                        and tbl_asignados.idfolio=$idfolio
                        order by tbl_docs.idfolio desc";

            $resul = $conexion->query($query);
               
              //  $numfilas = $query->rowCount();
              $row = $resul->fetch(PDO::FETCH_ASSOC);
                 $usuarios= $row['cvesp'];
             if ($usuarios<>$usu)  {   
                ?>
                            
             <?php            
                } else{
                    
                    ?>
                  
                  <a href="resolucion_super.php?idfolio=<?php echo $idfolio; ?>" class="spinner-border text-warning">
                  <input type=image src="./img/notificacion.png" name="notificacion"></a>
                <?php
                 
                }
            //}
                 ?>
                    </td> 


                <?php
                } else
                if ($row['total'] == 0) {
                    ?>

    <td class="center">
        <div class=" alert-danger">
            <strong>FINALIZADO</strong>
        </div>
    </td>

    <td class="center">
        <form name="resolucion" method="post" action="./resolucion3.php">
            <input type="hidden" name="idfolio" value="<?php echo $idfolio; ?>">
            <input type="submit" name="resolucion" class=" btn-warning" value="VER DETALLE">

        </form>
    </td>
   
    <?php

}
//}

?> 