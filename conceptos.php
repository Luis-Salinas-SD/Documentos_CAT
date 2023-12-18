<?php

require('./bd/conexion.php');

$json = file_get_contents('php://input');
$idUsuario = json_decode($json, true);

$tareas = array();

$sql1 = "SELECT * FROM cat_conceptos WHERE id_usuario = $idUsuario;";
$resultado = $dbh->query($sql1);

while ($row = $resultado->fetch(PDO::FETCH_ASSOC)) {
    $id = $row['Id'];
    $tarea = $row['tarea'];

    $tareas[] = array(
        'id' => $id,
        'tarea' => $tarea
    );
}

echo json_encode($tareas);
