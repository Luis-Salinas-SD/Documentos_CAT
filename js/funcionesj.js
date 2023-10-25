function enviarDatos(){
        //Recogemos los valores introducimos en los campos de texto
		correo = document.formulario.correo.value;
		//dorsal = document.formulario.dorsal.value;

         //Aquí será donde se mostrará el resultado
		//jugador = document.getElementById('jugador'); mostrara en input
		//no se muestra nada solo vamos a verificar que exista el correo en base de datos 


		//nombrec = document.getElementById('mostrardat'); //ver en div dentro de un <p>
		//curso = document.getElementById('nombrecurso'); //crear id="nombrecurso"  en el html 
		//fecha = document.getElementById('verfecha'); //crear id="verfecha"  en el html
	 	
		//instanciamos el objetoAjax
		ajax = objetoAjax();

		//Abrimos una conexión AJAX pasando como parámetros el método de envío, y el archivo que realizará las operaciones deseadas
		ajax.open("POST", "consultaj2.php", true);



		//cuando el objeto XMLHttpRequest cambia de estado, la función se inicia
		ajax.onreadystatechange = function() {

             //Cuando se completa la petición, mostrará los resultados
			if (ajax.readyState == 4){
									
				//El método responseText() contiene el texto de nuestro 'consultar.php'. Por ejemplo, cualquier texto que mostremos por un 'echo'
				//jugador.value = (ajax.responseText)  // original  Mostrar en input
				
				//nombrec.innerHTML = (ajax.responseText) //mostrar en <p> dentro de un <div>
				var array = JSON.parse(ajax.responseText);
				var i;
				
				for(i = 0; i < array.length; i++) {
				nombrec.innerHTML = array[i].nombrec;
				curso.innerHTML = array[i].nomcur;
				fecha.innerHTML = array[i].fecha_fin;
				
				}		
			}
		}

		//Llamamos al método setRequestHeader indicando que los datos a enviarse están codificados como un formulario.
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

		//enviamos las variables a 'consulta.php'
		//ajax.send("&correo="+correo+"&dorsal="+dorsal)
	ajax.send("correo="+correo);
	
}

function showhide(){
	
		var nombrec = document.getElementById('mostrardat');
	var div1 = document.getElementById('valcorr');
	var div2 = document.getElementById('impconst');

	if (nombrec != ''){

		div1.style.display = "none";
		div2.style.display = "block";
	}


}




