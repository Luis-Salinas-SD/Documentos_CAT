<?php

function getConn(){

/*** db maria username ***/

$username ='root';

/*** db maria password ***/
$password ='';

$conexion = new PDO("mysql:host=localhost;dbname=bd_svc", $username, $password);
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conexion->exec("set names utf8");
    return $conexion;

}
?>
