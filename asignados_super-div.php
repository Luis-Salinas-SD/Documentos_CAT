<tr>
    <td class="center">
        <?php echo $i; ?>
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
    $sql = "SELECT COUNT(*) as total , estatus FROM tbl_resolucion WHERE docref =$idfolio and estatus=1";
    $resul = $conexion->query($sql);
    $row = $resul->fetch(PDO::FETCH_ASSOC);
    if ($row['total'] >= 1) {
    ?>

        <td class="pt-3 text-center">
            <div class="alert alert-amarillo" style="width: 100px">
                En proceso...
            </div>
        </td>

        <td class="center d-flex">

            <form name="resolucion" method="post" action="./resolucion-div.php">
                <input type="hidden" name="idfolio" value="<?php echo $idfolio; ?>">
                <button type="submit" name="resolucion" class="btn btn-success p-1 mx-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Resolución">
                    <img src="assets/icons/info.svg">
                </button>
            </form>

            <form name="modificar" method="post" action="./modificar_super-div.php">
                <input type="hidden" name="idfolio" value="<?php echo $idfolio; ?>">
                <button type="submit" name="modificar" class="btn btn-warning p-1 mx-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Modificar">
                    <img src="assets/icons/edit.svg">
                </button>
            </form>

            <?php
            $usu = $_SESSION['id_usuario']; //4

            $query = "SELECT * FROM tbl_docs,tbl_asignados, tbl_resolucion WHERE tbl_docs.fechaact >= '2019-01-01'
                        and tbl_asignados.cvesp=$usu
                        and tbl_resolucion.estatus=1
                        and tbl_asignados.cvesp=tbl_resolucion.sprecibe
                        and tbl_asignados.idfolio=tbl_docs.Idfolio
                        and tbl_docs.idfolio=tbl_resolucion.docref
                        and tbl_asignados.idfolio=$idfolio
                        order by tbl_docs.idfolio desc";

            $resul = $conexion->query($query);
            //$numfilas = $query->rowCount();
            $row = $resul->fetch(PDO::FETCH_ASSOC); //false

            //$row = $resul->fetch(PDO::FETCH_ASSOC);
            $usuarios = $row['cvesp'];
            if ($usuarios <> $usu) {
            ?>


            <?php
            } else {

            ?>

                <a href="resolucion_super.php?idfolio=<?php echo $idfolio; ?>" class="spinner-border text-warning px-2">
                    <input type=image src="./img/notificacion.png" name="notificacion" width="23"></a>
            <?php

            }
            //}
            ?>
        </td>


    <?php
    } else if ($row['total'] == 0) {
    ?>

        <td class="text-center">
            <span class="alert alert-verde" style="width: 104px;">
                Finalizado
            </span>
        </td>

        <td class="center">
            <form name="resolucion" method="post" action="./resolucion-div.php">
                <input type="hidden" name="idfolio" value="<?php echo $idfolio; ?>">
                <button type="submit" name="resolucion" class="btn btn-primary p-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver más">
                    <img src="assets/icons/eye.svg">
                </button>
            </form>
        </td>

    <?php
    }
    ?>
</tr>