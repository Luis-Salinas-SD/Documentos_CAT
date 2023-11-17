<div class="col-12 table-responsive mb-3" id="tbl_asig">
    <table class="table table-bordered">
        <thead>
            <tr class="text-center">
                <th>Área</th>
                <th>Servidor Público</th>
                <th>Concepto</th>
                <th>Tipo de Resolución</th>
                <th>Número de Resolución</th>
                <th>Fecha</th>
                <th>Notas</th>

            </tr>
        </thead>
        <tbody>

            <?php

            $sql = "SELECT a.idreg as idasigna, s.area as area,  u.id_usuario as cvesp,
            u.nombre as sp, c.tarea as concep, r.tipodocref , r.nodoc, r.fecha, r.nota as nota from  tbl_asignados a, tbl_usuarios u, cat_areas s, cat_conceptos c,tbl_resolucion r
            where u.id_usuario = a.cvesp
                    and s.id = u.idarea
                    and  c.id = a.idconcepto
                    and r.docref= a.idfolio
                    and u.id_usuario=r.sprecibe
                    and a.idfolio = $idfolio
                    and a.id_area=$idarea";
            $resultado = $conexion->query($sql);
            while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
                $idasigna = $row['idasigna'];
                $usuario = $row['cvesp'];
            ?>
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
                    <td>
                        <?php echo $row['tipodocref']; ?>
                    </td>
                    <td class="text-center">
                        <?php echo $row['nodoc']; ?>
                    </td>
                    <td>
                        <?php echo $row['fecha']; ?>
                    </td>
                    <td>
                        <?php echo $row['nota']; ?>
                    </td>
                    <?php $cvesp = $row['cvesp']; ?>


                </tr>
            <?php
            } ?>
        </tbody>
    </table>
</div>