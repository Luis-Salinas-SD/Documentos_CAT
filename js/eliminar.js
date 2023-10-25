function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
 
	try {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	} catch (E) {
		xmlhttp = false;
	}
}
 
if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
	  xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}
 

function BorraRegistro() {
	//donde se mostrar� el resultado de la eliminacion
	divMuestra = document.getElementById('muestra');

	//idasigna = document.borrar_registro.idasigna.value;
	//idfolio = document.borrar_registro.idfolio.value;
	idasigna = document.getElementById("idasigna").value;
	idfolio = document.getElementById("idfolio").value;
	cvesp = document.getElementById("cvesp").value;
	//usaremos un cuadro de confirmacion	

	//instanciamos el objetoAjax
	ajax = objetoAjax();

	ajax.open("POST", "delete_task.php", true);
	//uso del medotod GET
	//indicamos el archivo que realizar� el proceso de eliminaci�n
	//junto con un valor que representa el id del empleado  + "&usuarios=" + usuarios
	
	ajax.onreadystatechange = function () {
		if (ajax.readyState == 4) {
			//mostrar resultados en esta capa
			divMuestra.innerHTML = ajax.responseText
			//TablaNueva();
		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	//enviando los valores a registro.php para que inserte los datos
	ajax.send("idasigna="+idasigna+"&idfolio="+idfolio+"&cvesp="+cvesp)
	//ajax.send(null)
}

/*function TablaNueva(){

	//window.location.assign("nuevo_addc.php");

}*/
