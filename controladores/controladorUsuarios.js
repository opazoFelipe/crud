function ingresarUsuario(){
	if(document.getElementById("botonGuardar")){
		document.getElementById("botonGuardar").remove();
	}
	var formulario = document.getElementById("formularioModificar");
	document.getElementById("tituloFormulario").innerHTML = "Ingresar Un Nuevo Usuario";

	document.getElementById("tablaUsuarios").style.display = "none";
	formulario.style.display="block";

	var submit = document.createElement("button");
	submit.innerHTML = "Guardar";
	submit.setAttribute("id", "botonGuardar");
	submit.addEventListener("click", guardarIngreso);
	formulario.appendChild(submit);

	document.getElementById("nombreIngresar").value = "";
	document.getElementById("aPaternoIngresar").value = "";
	document.getElementById("aMaternoIngresar").value = "";
	document.getElementById("telefonoIngresar").value = "";
	document.getElementById("correoIngresar").value = "";
	document.getElementById("contraIngresar").value = "";
}

function guardarIngreso(){

	var nombre = document.getElementById("nombreIngresar").value;
	var aPaterno = document.getElementById("aPaternoIngresar").value;
	var aMaterno = document.getElementById("aMaternoIngresar").value;
	var telefono = document.getElementById("telefonoIngresar").value;
	var correo = document.getElementById("correoIngresar").value;
	var contra = document.getElementById("contraIngresar").value;

	//Validar campos no vacios
	if(nombre.length == 0 | aPaterno.length == 0 | aMaterno.length == 0 | telefono-length == 0 | correo.length == 0 | contra.length == 0){
		alert("Llena todos los campos porfavor");
		return;
	}else{

		const url = "../modelos/main.php";
		var accion = "ingresar";

		var datos = "nombre="+nombre+"&aPaterno="+aPaterno+"&aMaterno="+aMaterno+"&telefono="+telefono+"&correo="+correo+"&contrasenia="+contra+"&accion="+accion;

		Ajax(url, datos, function(){
			if(respuestaAjax == "OK"){
				alert("Usuario ingresado correctamente");
			}
			if(respuestaAjax == "correo_existe"){
				alert("El correo ingresado ya existe, prueba con otro");
				return;
			}
			if(respuestaAjax == "no_registrado"){
				alert("Usuario no ingresado correctamente");
			
			}
			if(respuestaAjax == "error"){
				alert("Error al intentar ingresar el usuario");
			
			}
			document.getElementById("formularioModificar").style.display = "none";
				var submit = document.createElement("button");
				submit.remove();
				mostarUsuarios();
				return;
		});
	}
}

function mostarUsuarios(){
	document.getElementById("formularioModificar").style.display = "none";
	var bodyTabla = document.getElementById("bodyTablaUsuarios");

	while (bodyTabla.firstChild) {
		bodyTabla.removeChild(bodyTabla.firstChild);
	}
	const url = "../modelos/main.php"; 
	var accion = "mostrarTodos";
	var datos = "accion="+accion;

	function gestorUsuarios(){
		if(respuestaAjax == "vacio"){
			alert("Aun no hay usuarios registrados");
			return;
		}
		if(respuestaAjax == "error"){
			alert("Error al mostrar usuarios registrados");
			return;
		}

		var usuarios = JSON.parse(respuestaAjax);
		
		var cantUsuarios = usuarios.length;
		
		for(var i = 0; i < cantUsuarios; i++){
			
			var id= usuarios[i]["correo"];
			var fila = document.createElement("tr");
			fila.setAttribute("id", id);

			var nombre = document.createElement("td");
			var aPaterno = document.createElement("td");
			var aMaterno = document.createElement("td");
			var correo = document.createElement("td");
			var contra = document.createElement("td");
			var telefono = document.createElement("td");
			var acciones = document.createElement("td");
			var botonModificar = document.createElement("button");
			var botonEliminar = document.createElement("button");

			botonModificar.innerHTML = "Modificar";
			botonEliminar.innerHTML = "Eliminar";

			botonModificar.addEventListener("click", modificarUsuario);
			botonEliminar.addEventListener("click", eliminarUsuario);	

			acciones.appendChild(botonModificar);
			acciones.appendChild(botonEliminar);

			nombre.innerHTML = usuarios[i]["nombre"];
			aPaterno.innerHTML = usuarios[i]["aPaterno"];
			aMaterno.innerHTML = usuarios[i]["aMaterno"];
			correo.innerHTML = usuarios[i]["correo"];
			telefono.innerHTML = usuarios[i]["telefono"];
			contra.innerHTML = usuarios[i]["contra"];

			fila.appendChild(nombre);
			fila.appendChild(aPaterno);
			fila.appendChild(aMaterno);
			fila.appendChild(correo);
			fila.appendChild(telefono);
			fila.appendChild(contra);
			fila.appendChild(acciones);

			bodyTabla.append(fila);
			document.getElementById("tablaUsuarios").style.display = "block";
		}
	}

	Ajax(url, datos, gestorUsuarios);
}

function modificarUsuario(){
	
	if(document.getElementById("botonGuardar")){
		document.getElementById("botonGuardar").remove();
	}
	document.getElementById("tituloFormulario").innerHTML = "Modificar Usuario Seleccionado";
	var formulario = document.getElementById("formularioModificar");
	var submit = document.createElement("button");
	submit.innerHTML = "Guardar";
	submit.setAttribute("id", "botonGuardar");
	submit.addEventListener("click", guardarModificacion);
	formulario.appendChild(submit);

	var filaPadre = this.parentNode.parentNode;
	var datosActuales = filaPadre.childNodes;

	document.getElementById("tablaUsuarios").style.display = "none";
	formulario.style.display="block";

	document.getElementById("nombreIngresar").value = datosActuales[0].innerHTML;
	document.getElementById("aPaternoIngresar").value = datosActuales[1].innerHTML;
	document.getElementById("aMaternoIngresar").value = datosActuales[2].innerHTML;
	document.getElementById("telefonoIngresar").value = datosActuales[4].innerHTML;
	document.getElementById("correoIngresar").value = datosActuales[3].innerHTML;
	document.getElementById("contraIngresar").value = datosActuales[5].innerHTML;
	document.getElementById("oculto").value = datosActuales[3].innerHTML;

}

function eliminarUsuario(){
	var filaPadre = this.parentNode.parentNode;
	var correo = filaPadre.id;
	var r = confirm("¿Estas seguro de eliminar estos datos?");
	if(r){

		const url = "../modelos/main.php";
		var accion = "eliminar";

		var datos = "correo="+correo+"&accion="+accion;

		Ajax(url, datos, function(){
			if(respuestaAjax == "OK"){
				alert("Usuario eliminado correctamente");
				filaPadre.remove();
			}

		
			if(respuestaAjax == "no_eliminado"){
				alert("Usuario no eliminado");
			}
			if(respuestaAjax == "error"){
				alert("Error al intentar eliminar el usuario");	
			}
			return;
		});
		return;
	}
	return;
}

function guardarModificacion(){

	var nombre = document.getElementById("nombreIngresar").value;
	var aPaterno = document.getElementById("aPaternoIngresar").value;
	var aMaterno = document.getElementById("aMaternoIngresar").value;
	var telefono = document.getElementById("telefonoIngresar").value;
	var correoNuevo= document.getElementById("correoIngresar").value;
	var contra = document.getElementById("contraIngresar").value;
	var correoActual = document.getElementById("oculto").value;

	//Validar campos no vacios
	if(nombre.length == 0 | aPaterno.length == 0 | aMaterno.length == 0 | telefono-length == 0 | correoNuevo.length == 0 | contra.length == 0){
		alert("Llena todos los campos porfavor");
		return;
	}else{

		const url = "../modelos/main.php";
		var accion = "modificar";

		var datos = "nombre="+nombre+"&aPaterno="+aPaterno+"&aMaterno="+aMaterno+"&telefono="+telefono+"&correoNuevo="+correoNuevo+"&contrasenia="+contra+"&correoActual="+correoActual+"&accion="+accion;

		Ajax(url, datos, function(){
			if(respuestaAjax == "OK"){
				alert("Usuario modificado correctamente");
			
			}
			if(respuestaAjax == "correo_existe"){
				alert("El correo ingresado ya existe, prueba con otro");
				return;
			
			}
			if(respuestaAjax == "no_modificado"){
				alert("Usuario no modificado");
			
			}
			if(respuestaAjax == "error"){
				alert("Error al intentar modificar el usuario");
				
			}
			document.getElementById("formularioModificar").style.display = "none";
			var submit = document.createElement("button");
			submit.remove();
			mostarUsuarios();
			return;
		});
	}
}


function start(){
	document.getElementById("tablaUsuarios").style.display = "none";
	document.getElementById("formularioModificar").style.display = "none";
}

window.onload = start;