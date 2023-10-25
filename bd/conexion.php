<?php

$hostname = 'localhost'; //Locale



/*** db maria username ***/

$username = 'root';


/*** db maria password ***/
$password =''; 



try {
  
  $dbh = new PDO("mysql:host=$hostname;dbname=bd_svc", $username, $password); //server dgi
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->exec("set names utf8");
    return $dbh;
   return $dbh;
    }
catch(PDOException $e)
    {
    echo $e->getMessage();
    }


?>