<?php

require('./bd/conexion.php');

    $html = " ";
$elegido1= $_POST["elegido1"];
 $sql1 = "SELECT * FROM tbl_usuarios, cat_conceptos where cat_conceptos.id_usuario=$elegido1 and cat_conceptos.id_usuario=tbl_usuarios.id_usuario";
        $resultado = $dbh->query($sql1); 
        while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
            $idconcepto= $row['Id'];
            $tarea= $row['tarea'];
        $html = "<option name='turnado' value= $idconcepto>  $tarea </option>";

echo $html;
}
?>