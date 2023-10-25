<?php

$hostname = 'localhost'; //Locale

/*** db maria username ***/
$username = 'root';

/*** db maria password ***/
$password =''; 


try {
  
  $conexion = new PDO("mysql:host=$hostname;dbname=bd_svc",
    $username,
    $password,
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
  ); 
  
} catch (PDOException $e) {
  echo $e->getMessage();
}
?>