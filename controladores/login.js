function validarLogin(event){
    event.preventDefault();
	
	var formulario = document.getElementById("formLogin");
	var correo = document.getElementById("emailLogin").value;
	var contra = document.getElementById("contraLogin").value;

	//Validar campos no vacios
	if(correo.length == 0){
		alert("Ingresa un correo");
		return;
	}

	if(contra.length == 0){
		alert("Ingresa una contraseña");
		return;
	}

    const url = "../modelos/main.php";
    var accion = "logear";
	
	var datos = "correo="+correo+"&contra="+contra+"&accion="+accion;

	function gestorLogin(){

		if(respuestaAjax == "OK"){
			// window.location = "../vistas/crud.php";
			formulario.submit();
			return;
		}

		if(respuestaAjax == "clave_fallida"){
			alert("La contraseña no es la correcta para este correo");
			return;
		}

		if(respuestaAjax == "no_registrado"){
			alert("Usuario no registrado");
			return;
		}

		if(respuestaAjax == "error"){
			alert("Error");
			return;
		}
	}

	Ajax(url, datos, gestorLogin);
}
