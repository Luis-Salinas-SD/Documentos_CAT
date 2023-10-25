function creaObjetoAjax(){
    var obj;
    if (window.XMLHttpRequest){
        object=new XMLHttpRequest();
        }
    else {
        obj=new ActiveXObject(Microsoft.XMLHTTP);
    }
    return obj;
}

function enviar() {
    //almaceno correo escrito por el usuario
    recorreo = correo = document.formulario.correo.value;
    //datos para enviar por post
    micorreo ="emailr="+recorreo;
    //Objeto XMLHttpRequest creado para la funcion
    objetoAjax = creaObjetoAjax(); 
    //Prepara envio con open 
    objetoAjax.open("POST", "index2a.php", true);
    //Enviar cabeceras para que acepten POST
    objetoAjax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    objetoAjax.setRequestHeader("Content-lenght", micorreo.lenght);
    objetoAjax.setRequestHeader("Connection", "close");
    objetoAjax.onreadystatechange = recogeCorreo;
        objetoAjax.send(micorreo);
}

function recogeCorreo() {
    if(objetoAjax.readyState == 4 && objetoAjax.status ==200){
        txtcorreo = objetoAjax.responseText;
        document.getElementById("veremail").innerHTML=txtcorreo;
    }


}