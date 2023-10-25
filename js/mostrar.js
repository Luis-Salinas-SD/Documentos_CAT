// Función para recoger los datos de PHP según el navegador, se usa siempre.
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


function enviarDatos(){


    //Aquí será donde se mostrará el resultado
    divMostrar = document.getElementById('mostrar');
		//Recogemos los valores introducimos en los campos de texto
		folio = document.asignado.idfolio.value(idfolio); 
		sp = document.asignado.usuarios.value;
        concepto = document.asignado.concepto.value;
       

    //instanciamos el objetoAjax
    ajax = objetoAjax();

  //uso del medotod POST
  //archivo que realizará la operacion
    ajax.open("POST", "save_task.php", true);

    //cuando el objeto XMLHttpRequest cambia de estado, la función se inicia
    ajax.onreadystatechange = function () {
        //la función responseText tiene todos los datos pedidos al servidor
        if (ajax.readyState == 4) {
  		//mostrar resultados en esta capa
            divMostrar.innerHTML = ajax.responseText
              
        }
    }
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	//enviando los valores a registro.php para que inserte los datos
		ajax.send("usuarios="+sp+"&concepto="+concepto+"&folio="+folio)
		
	}
