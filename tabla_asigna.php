<script language="JavaScript" type="text/javascript" src="./js/eliminar.js"></script>
<form name="borrar_registro" action="" onsubmit="BorraRegistro(); return false">
    <div class="col-sm-8" id="tbl_asig">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Área</th>
                    <th>Servidor Público</th>
                    <th>Concepto </th>
                    <th>Action </th>
                </tr>
            </thead>
            <tbody>

                <?php


                //echo  $idfolio = $_POST['idfolio'];
               // echo $cvesp = $_POST['cvesp'];

                $query = "SELECT * from tbl_asignados where idfolio=$idfolio";
                $resultado = $conexion->query($query);
                $numfilas = $resultado->rowCount();
                if ($numfilas == 0) {

                    $sql1 = "UPDATE tbl_docs SET asignar=0 where Idfolio=  $idfolio ";
                    $res = $conexion->query($sql1);
                } else {

                    $sql = "SELECT a.idreg as idasigna, s.area as area,  u.cvesp as cvesp, u.nombre 
            as sp, c.tarea as concep ,a.idfolio 
            from  tbl_asignados a, tbl_usuarios u, cat_areas s, cat_conceptos c
	        where u.cvesp = a.cvesp
		        and s.id = u.idarea
			        and  c.id = a.idconcepto
                        and a.idfolio = $idfolio";

                    $resultado = $conexion->query($sql);

                    while ($row1 = $resultado->fetch(PDO::FETCH_ASSOC)) {
                        $cvesp = $row1['cvesp'];
                        $idasigna = $row1['idasigna'];
                        $idfolio;
                        ?>
                <tr>
                    <td>
                        <?php echo $row1['area']; ?>
                    </td>
                    <td>
                        <?php echo $row1['sp']; ?>
                    </td>
                    <td>
                        <?php echo $row1['concep']; ?>
                    </td>
                    <td>
                        <input type="hidden" id="idasigna" name="idasigna" value="<?php echo $idasigna; ?>">
                        <input type="hidden" id="idfolio" name="idfolio" value="<?php echo $idfolio; ?>">
                        <input type="hidden" id="cvesp" name="cvesp" value="<?php echo $cvesp; ?>">
                        <input type="submit" class="btn btn-danger btn-block" value="Eliminar" />
                    </td>

                </tr>


                <?php 
            }
             }
            ?>
</form>
</tbody>
</table>
</div> 