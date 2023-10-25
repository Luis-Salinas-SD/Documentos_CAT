function validar(){
	
	var servidor = document.getElementById("servidor").value;
	
	var correo = document.getElementById("correo").value;
	
	var p1 = document.getElementById("pass").value;
	
	var p2 = document.getElementById("pass_confirma").value;
	
	var expresion;
	
	expresion =/^(\w[-._+\w]*\w@\w[-._\w]*\w\.\w{2,3})$/;
	
		
	if(servidor ==="" || correo ==="" || p1 ==="" || p2 ===""){
		alert("Todos los campos son obligatorios");
		return false;
	}
	
	
	else if(servidor.length>9){
		alert("Verificar Clave de Servidor Publico");
		return false;
	}
	
	else if(isNaN(servidor)){
		alert("Ingresa los 9 digitos de la Clave de Servidor Publico");
	return false;
	}
	//correo
	
	else if(!expresion.test(correo)){
		alert("El correo no es Valido");
		return false;
	}
	
	//contraseña
	var espacios = false;
    var cont = 0;
     
    while (!espacios && (cont < p1.length)) {
      if (p1.charAt(cont) === " ")
        espacios = true;
      cont++;
    }
     
    	if (espacios) {
      alert ("La contraseña no puede contener espacios en blanco");
      return false;
	}
	    if (p1.length === 0 || p2.length === 0) {
      alert("Los campos de la password no pueden quedar vacios");
      return false;
    }
	  if (p1 !== p2) {
      alert("Las passwords deben de coincidir");
      return false;
    } 
	
	
			
}


