function objetoAjax() {
	var xmlhttp = false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {

		try {
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
		}
	}

	if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

//Función para recoger los datos del formulario y enviarlos por post  
function enviarDatosEmpleado() {
	
	divResultado = document.getElementById('resultado');

	folio = document.nuevo_empleado.folio.value;
	usuarios = document.nuevo_empleado.usuarios.value;
	concepto = document.nuevo_empleado.concepto.value;
	//instanciamos el objetoAjax
	ajax = objetoAjax();

	//uso del medotod POST
	//archivo que realizará la operacion
	//registro.php
	ajax.open("POST", "save_task.php", true);
	//cuando el objeto XMLHttpRequest cambia de estado, la función se inicia
	ajax.onreadystatechange = function () {
		//la función responseText tiene todos los datos pedidos al servidor
		if (ajax.readyState == 4) {
			//mostrar resultados en esta capa
			divResultado.innerHTML = ajax.responseText
			//llamar a funcion para limpiar los inputs
			LimpiarCampos();
		}
	}
	ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	//enviando los valores a registro.php para que inserte los datos
	ajax.send("folio=" + folio + "&usuarios=" + usuarios + "&concepto=" + concepto)
}

//función para limpiar los campos
function LimpiarCampos() {

	document.nuevo_empleado.area.value = "Elige una opción";
	document.nuevo_empleado.usuarios.value = "Elige una opción";
	document.nuevo_empleado.concepto.value = "Elige una opción";
	document.nuevo_empleado.area.focus();
}


