<?php

require('./bd/conexion.php');

$json = file_get_contents('php://input');
$idArea = json_decode($json, true);

$areas = array();

if ($idArea == 1) {
    //$sql1 = "SELECT * FROM tbl_usuarios WHERE idarea=$idArea OR idarea=3;";
    $sql1 = "SELECT * FROM tbl_usuarios WHERE id_usuario !=12 AND id_usuario != 5 AND idarea=1 OR idarea=3;";
    $resultado = $dbh->query($sql1);
} else {
    $sql1 = "SELECT * FROM tbl_usuarios where idarea=$idArea;";
    $resultado = $dbh->query($sql1);
}



while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
    $cvesp = $row['id_usuario'];
    $nombre = $row['nombre'];

    $areas[] = array(
        'id_usuario' => $cvesp,
        'nombre' => $nombre
    );
}

echo json_encode($areas);
