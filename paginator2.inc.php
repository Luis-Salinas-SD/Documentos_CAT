<script src="js/ajax1.js"></script>

<?php
/**
 * Variables que se pueden definir antes de incluir el script v�a include():
 * ------------------------------------------------------------------------
 * $_pagi_sql OBLIGATORIA. Cadena. Debe contener una sentencia sql v�lida (y sin la cl�usula "limit").

 * $_pagi_cuantos OPCIONAL. Entero. Cantidad de registros que contendr� como m�ximo cada p�gina.
Por defecto est� en 20.

 * $_pagi_nav_num_enlaces OPCIONAL Entero. Cantidad de enlaces a los n�meros de p�gina que se mostrar�n como 
m�ximo en la barra de navegaci�n.
Por defecto se muestran todos.

 * $_pagi_mostrar_errores OPCIONAL Booleano. Define si se muestran o no los errores de MySQL que se puedan producir.
Por defecto est� en "true";

 * $_pagi_propagar OPCIONAL Array de cadenas. Contiene los nombres de las variables que se quiere propagar
por el url. Por defecto se propagar�n todas las que ya vengan por el url (GET).
 * $_pagi_conteo_alternativo OPCIONAL Booleano. Define si se utiliza mysql_num_rows() (true) o COUNT(*) (false).
Por defecto est� en false.
 * $_pagi_separador OPCIONAL Cadena. Cadena que separa los enlaces num�ricos en la barra de navegaci�n entre p�ginas.
Por defecto se utiliza la cadena " | ".
 * $_pagi_nav_estilo OPCIONAL Cadena. Contiene el nombre del estilo CSS para los enlaces de paginaci�n.
Por defecto no se especifica estilo.
 * $_pagi_nav_anterior OPCIONAL Cadena. Contiene lo que debe ir en el enlace a la p�gina anterior. Puede ser un tag <img>.
Por defecto se utiliza la cadena "&laquo; Anterior".
 * $_pagi_nav_siguiente OPCIONAL Cadena. Contiene lo que debe ir en el enlace a la p�gina siguiente. Puede ser un tag <img>.
Por defecto se utiliza la cadena "Siguiente &raquo;"
 * $_pagi_nav_primera OPCIONAL Cadena. Contiene lo que debe ir en el enlace a la primera p�gina. Puede ser un tag <img>.
Por defecto se utiliza la cadena "&laquo;&laquo; Primera".
 * $_pagi_nav_ultima OPCIONAL Cadena. Contiene lo que debe ir en el enlace a la p�gina siguiente. Puede ser un tag <img>.
Por defecto se utiliza la cadena "&Uacute;ltima &raquo;&raquo;"
--------------------------------------------------------------------------
 */


/*
* Verificaci�n de los par�metros obligatorios y opcionales.
*------------------------------------------------------------------------
*/
if (empty($_pagi_sql)) {
    // Si no se defini� $_pagi_sql... grave error!
    // Este error se muestra s� o s� (ya que no es un error de mysql)
    die("<b>Error Paginator : </b>No se ha definido la variable \$_pagi_sql");
}

if (empty($_pagi_cuantos)) {
    // Si no se ha especificado la cantidad de registros por p�gina
    // $_pagi_cuantos ser� por defecto 20
    $_pagi_cuantos = 5;
}

if (!isset($_pagi_mostrar_errores)) {
    // Si no se ha elegido si se mostrar� o no errores
    // $_pagi_errores ser� por defecto true. (se muestran los errores)
    $_pagi_mostrar_errores = true;
}

if (!isset($_pagi_conteo_alternativo)) {
    // Si no se ha elegido el tipo de conteo
    // Se realiza el conteo dese mySQL con COUNT(*)
    $_pagi_conteo_alternativo = false;
}

if (!isset($_pagi_separador)) {
    // Si no se ha elegido un separador
    // Se toma el separador por defecto.
    $_pagi_separador = " | ";
}

if (isset($_pagi_nav_estilo)) {
    // Si se ha definido un estilo para los enlaces, se genera el atributo "class" para el enlace
    $_pagi_nav_estilo_mod = "class=\"$_pagi_nav_estilo\"";
} else {
    // Si no, se utiliza una cadena vac�a.
    $_pagi_nav_estilo_mod = "";
}

if (!isset($_pagi_nav_anterior)) {
    // Si no se ha elegido una cadena para el enlace "siguiente"
    // Se toma la cadena por defecto.
    $_pagi_nav_anterior = "&laquo; Anterior";
}

if (!isset($_pagi_nav_siguiente)) {
    // Si no se ha elegido una cadena para el enlace "siguiente"
    // Se toma la cadena por defecto.
    $_pagi_nav_siguiente = "Siguiente &raquo;";
}

if (!isset($_pagi_nav_primera)) {
    // Si no se ha elegido una cadena para el enlace "primera"
    // Se toma la cadena por defecto.
    $_pagi_nav_primera = "&laquo;&laquo; Primera";
}

if (!isset($_pagi_nav_ultima)) {
    // Si no se ha elegido una cadena para el enlace "siguiente"
    // Se toma la cadena por defecto.
    $_pagi_nav_ultima = "&Uacute;ltima &raquo;&raquo;";
}

//------------------------------------------------------------------------


/*
* Establecimiento de la p�gina actual.
*------------------------------------------------------------------------
*/
// Protegemos el paso de variables de paginacion 	xxx
// ooooooooooooooooooooooo

$NombPag_Primera = $_SERVER['PHP_SELF'];

$Desti_Pag = "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0; url=$NombPag_Primera\"> <script type=\"text/javascript\"> window.location=\"$NombPag_Primera\"; </script>";

@$_Rec_pagn = $_GET['_pagi_pg'];
if (!preg_match("/^[0-9]{0,25}$/", $_Rec_pagn)) die($Desti_Pag);

// ooooooooooooooooooooooo

if (empty($_GET['_pagi_pg'])) {
    // Si no se ha hecho click a ninguna p�gina espec�fica
    // O sea si es la primera vez que se ejecuta el script
    // $_pagi_actual es la pagina actual-->ser� por defecto la primera.
    $_pagi_actual = 1;
} else {
    // Si se "pidi�" una p�gina espec�fica:
    // La p�gina actual ser� la que se pidi�.
    $_pagi_actual = $_GET['_pagi_pg'];
}
//------------------------------------------------------------------------


/*
* Establecimiento del n�mero de p�ginas y del total de registros.
*------------------------------------------------------------------------
*/
// Contamos el total de registros en la BD (para saber cu�ntas p�ginas ser�n)
// La forma de hacer ese conteo depender� de la variable $_pagi_conteo_alternativo
if ($_pagi_conteo_alternativo == false) {
    include('./bd/conndb.php');

    $usu = $_SESSION['cvesp'];
    $_pagi_sqlConta = preg_replace("/select[[:space:]](.*)[[:space:]]from/", "SELECT COUNT(*) FROM", $_pagi_sql);    /* xxx Linea modificada */
    $_pagi_result2 = $conexion->query($_pagi_sqlConta);
    // Si ocurri� error y mostrar errores est� activado
    if ($_pagi_result2 == false && $_pagi_mostrar_errores == true) {
        die(" Error en la consulta de conteo de registros: $_pagi_sqlConta. Mysql dijo: <b>" . mysql_error() . "</b>");
    }
    //$_pagi_totalReg = @mysqli_fetch_all($_pagi_result2, 0, 0);    // Total de registros xxx - Se ha agregado @ para evitar que se muestre error cuando los registros son 0
    $_Num_regis_Consul = $_pagi_result->rowCount();     // Agregamos esta linea xxx
} else {
    $_pagi_result3 = $conexion->query($_pagi_sql);
    // Si ocurri� error y mostrar errores est� activado
    if ($_pagi_result3 == false && $_pagi_mostrar_errores == true) {
        die(" Error en la consulta de conteo alternativo de registros: $_pagi_sql. Mysql dijo: <b>" . mysql_error() . "</b>");
    }
    $_pagi_totalReg = $_pagi_result3->rowCount();
    $_Num_regis_Consul = $_pagi_result->rowCount();    // Agregamos esta linea xxx
}
// Calculamos el n�mero de p�ginas (saldr� un decimal)
// con ceil() redondeamos y $_pagi_totalPags ser� el n�mero total (entero) de p�ginas que tendremos
$_pagi_totalPags = ceil($_Num_regis_Consul / $_pagi_cuantos);     // Sustituimos, de aqui en adelante, la variable  $_pagi_totalReg por $_Num_regis_Consul xxx

//------------------------------------------------------------------------


/*
* Propagaci�n de variables por el URL.
*------------------------------------------------------------------------
*/
// La idea es pasar tambi�n en los enlaces las variables hayan llegado por url.
$_pagi_enlace = $_SERVER['PHP_SELF'];
$_pagi_query_string = "?";

if (!isset($_pagi_propagar)) {
    //Si no se defini� qu� variables propagar, se propagar� todo el $_GET (por compatibilidad con versiones anteriores)
    //Perd�n... no todo el $_GET. Todo menos la variable _pagi_pg
    if (isset($_GET['_pagi_pg'])) unset($_GET['_pagi_pg']); // Eliminamos esa variable del $_GET
    $_pagi_propagar = array_keys($_GET);
} elseif (!is_array($_pagi_propagar)) {
    // si $_pagi_propagar no es un array... grave error!
    die("<b>Error Paginator : </b>La variable \$_pagi_propagar debe ser un array");
}
// Este foreach est� tomado de la Clase Paginado de webstudio
// (http://www.forosdelweb.com/showthread.php?t=65528)
foreach ($_pagi_propagar as $var) {
    if (isset($GLOBALS[$var])) {
        // Si la variable es global al script
        $_pagi_query_string .= $var . "=" . $GLOBALS[$var] . "&";
    } elseif (isset($_REQUEST[$var])) {
        // Si no es global (o register globals est� en OFF)
        $_pagi_query_string .= $var . "=" . $_REQUEST[$var] . "&";
    }
}

// A�adimos el query string a la url.
$_pagi_enlace .= $_pagi_query_string;

//------------------------------------------------------------------------


/*
* Generaci�n de los enlaces de paginaci�n.
*------------------------------------------------------------------------
*/
// La variable $_pagi_navegacion contendr� los enlaces a las p�ginas.
$_pagi_navegacion_temporal = array();
if ($_pagi_actual != 1) {
    // Si no estamos en la p�gina 1. Ponemos el enlace "primera"
    $_pagi_url = 1; //ser� el n�mero de p�gina al que enlazamos
    $_pagi_navegacion_temporal[] = "<a " . $_pagi_nav_estilo_mod . " href='" . $_pagi_enlace . "_pagi_pg=" . $_pagi_url . "'>$_pagi_nav_primera</a>";

    // Si no estamos en la p�gina 1. Ponemos el enlace "anterior"
    $_pagi_url = $_pagi_actual - 1; //ser� el n�mero de p�gina al que enlazamos
    $_pagi_navegacion_temporal[] = "<a " . $_pagi_nav_estilo_mod . " href='" . $_pagi_enlace . "_pagi_pg=" . $_pagi_url . "'>$_pagi_nav_anterior</a>";
}

// La variable $_pagi_nav_num_enlaces sirve para definir cu�ntos enlaces con 
// n�meros de p�gina se mostrar�n como m�ximo.
// Ojo: siempre se mostrar� un n�mero IMPAR de enlaces. M�s info en la documentaci�n.
// Definimos el numero de enlaces a paginas que queremos que aparezcan, 7 en este caso.
// Si queremos que aparezcan todos los enlaces eliminamos la siguiente linea. 
// $_pagi_nav_num_enlaces = "7";

if ($enlacesdepaginacion > 0)     // Modificacion que permite definir el numero de enlaces de paginaci�n xxx
{
    // Apareceran solo los enlaces de paginacion que indiquemos
    $_pagi_nav_num_enlaces = $enlacesdepaginacion;
} else {
    // Apareceran todos los enlaces de paginacion
}

if (!isset($_pagi_nav_num_enlaces)) {
    // Si no se defini� la variable $_pagi_nav_num_enlaces
    // Se asume que se mostrar�n todos los n�meros de p�gina en los enlaces.
    $_pagi_nav_desde = 1; //Desde la primera
    $_pagi_nav_hasta = $_pagi_totalPags; //hasta la �ltima
} else {
    // Si se defini� la variable $_pagi_nav_num_enlaces
    // Calculamos el intervalo para restar y sumar a partir de la p�gina actual
    $_pagi_nav_intervalo = ceil($_pagi_nav_num_enlaces / 2) - 1;

    // Calculamos desde qu� n�mero de p�gina se mostrar�
    $_pagi_nav_desde = $_pagi_actual - $_pagi_nav_intervalo;
    // Calculamos hasta qu� n�mero de p�gina se mostrar�
    $_pagi_nav_hasta = $_pagi_actual + $_pagi_nav_intervalo;

    // Ajustamos los valores anteriores en caso sean resultados no v�lidos

    // Si $_pagi_nav_desde es un n�mero negativo
    if ($_pagi_nav_desde < 1) {
        // Le sumamos la cantidad sobrante al final para mantener el n�mero de enlaces que se quiere mostrar. 
        $_pagi_nav_hasta -= ($_pagi_nav_desde - 1);
        // Establecemos $_pagi_nav_desde como 1.
        $_pagi_nav_desde = 1;
    }
    // Si $_pagi_nav_hasta es un n�mero mayor que el total de p�ginas
    if ($_pagi_nav_hasta > $_pagi_totalPags) {
        // Le restamos la cantidad excedida al comienzo para mantener el n�mero de enlaces que se quiere mostrar.
        $_pagi_nav_desde -= ($_pagi_nav_hasta - $_pagi_totalPags);
        // Establecemos $_pagi_nav_hasta como el total de p�ginas.
        $_pagi_nav_hasta = $_pagi_totalPags;
        // Hacemos el �ltimo ajuste verificando que al cambiar $_pagi_nav_desde no haya quedado con un valor no v�lido.
        if ($_pagi_nav_desde < 1) {
            $_pagi_nav_desde = 1;
        }
    }
}

for ($_pagi_i = $_pagi_nav_desde; $_pagi_i <= $_pagi_nav_hasta; $_pagi_i++) { //Desde p�gina 1 hasta �ltima p�gina ($_pagi_totalPags)
    if ($_pagi_i == $_pagi_actual) {
        // Si el n�mero de p�gina es la actual ($_pagi_actual). Se escribe el n�mero, pero sin enlace y en negrita.
        $_pagi_navegacion_temporal[] = "<span " . $_pagi_nav_estilo_mod . ">$_pagi_i</span>";
    } else {
        // Si es cualquier otro. Se escibe el enlace a dicho n�mero de p�gina.
        $_pagi_navegacion_temporal[] = "<a " . $_pagi_nav_estilo_mod . " href='" . $_pagi_enlace . "_pagi_pg=" . $_pagi_i . "'>" . $_pagi_i . "</a>";
    }
}

if ($_pagi_actual < $_pagi_totalPags) {
    // Si no estamos en la �ltima p�gina. Ponemos el enlace "Siguiente"
    $_pagi_url = $_pagi_actual + 1; //ser� el n�mero de p�gina al que enlazamos
    $_pagi_navegacion_temporal[] = "<a " . $_pagi_nav_estilo_mod . " href='" . $_pagi_enlace . "_pagi_pg=" . $_pagi_url . "'>$_pagi_nav_siguiente</a>";

    // Si no estamos en la �ltima p�gina. Ponemos el enlace "�ltima"
    $_pagi_url = $_pagi_totalPags; //ser� el n�mero de p�gina al que enlazamos
    $_pagi_navegacion_temporal[] = "<a " . $_pagi_nav_estilo_mod . " href='" . $_pagi_enlace . "_pagi_pg=" . $_pagi_url . "'>$_pagi_nav_ultima</a>";
}
$_pagi_navegacion = implode($_pagi_separador, $_pagi_navegacion_temporal);

//------------------------------------------------------------------------


/*
* Obtenci�n de los registros que se mostrar�n en la p�gina actual.
*------------------------------------------------------------------------
*/
// Calculamos desde qu� registro se mostrar� en esta p�gina
// Recordemos que el conteo empieza desde CERO.
$_pagi_inicial = ($_pagi_actual - 1) * $_pagi_cuantos;

// Consulta SQL. Devuelve $cantidad registros empezando desde $_pagi_inicial
$_pagi_sqlLim = $_pagi_sql . " LIMIT $_pagi_inicial,$_pagi_cuantos";
$_pagi_result = $conexion->query($_pagi_sqlLim);
// Si ocurri� error y mostrar errores est� activado
if ($_pagi_result == false && $_pagi_mostrar_errores == true) {
    die("Error en la consulta limitada: $_pagi_sqlLim. Mysql dijo: <b>" . mysql_error() . "</b>");
}

//------------------------------------------------------------------------


/*
* Generaci�n de la informaci�n sobre los registros mostrados.
*------------------------------------------------------------------------
*/
// N�mero del primer registro de la p�gina actual
$_pagi_desde = $_pagi_inicial + 1;

// N�mero del �ltimo registro de la p�gina actual
//$_pagi_hasta = $_pagi_inicial + $_pagi_cuantos;
$_pagi_hasta =  $_Num_regis_Consul - $_pagi_inicial;
if ($_Num_regis_Consul == 0) {

    if ($_pagi_hasta > $_Num_regis_Consul) {
        // Si estamos en la �ltima p�gina
        // El ultimo registro de la p�gina actual ser� igual al n�mero de registros.
        $_pagi_hasta = $_Num_regis_Consul;
    }
}
$_pagi_info = "desde el $_pagi_desde hasta el $_pagi_hasta de un total de $_Num_regis_Consul";

//------------------------------------------------------------------------


?>