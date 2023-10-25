<?php

require('./bd/conexion.php');

$html = " ";
$elegido= $_POST["elegido"];
 $sql1 = "SELECT * FROM tbl_usuarios, cat_areas where cat_areas.Id=$elegido and cat_areas.Id=tbl_usuarios.idarea";
        $resultado = $dbh->query($sql1);
        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
            $cvesp= $row['id_usuario'];
            $nombre= $row['nombre'];
        $html = "<option name='turnado' value= $cvesp>  $nombre </option>";

echo $html;
}
?>