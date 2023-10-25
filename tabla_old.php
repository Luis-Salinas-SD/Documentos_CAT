<div class="col-sm-8" id="tbl_asig">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Área</th>
                <th>Servidor Público</th>
                <th>Concepto</th>
                
            </tr>
        </thead>
        <tbody>

            <?php

            $sql = "SELECT a.idreg as idasigna, s.area as area,  u.cvesp as cvesp, u.nombre as sp, c.tarea as concep  
            from  tbl_asignados a, tbl_usuarios u, cat_areas s, cat_conceptos c
	        where u.cvesp = a.cvesp
		        and s.id = u.idarea
			        and  c.id = a.idconcepto
			            and a.idfolio = $idfolio";
            $resultado = $conexion->query($sql);
            while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
                $idasigna = $row['idasigna'];  ?>
            <tr>
                
                <td>
                    <?php echo $row['area']; ?>
                </td>
                <td>
                    <?php echo $row['sp']; ?>
                </td>
                <td>
                    <?php echo $row['concep']; ?>
                </td>
                <?php $cvesp = $row['cvesp']; ?>
                

            </tr>
            <?php 
        } ?>
        </tbody>
    </table>
</div> 