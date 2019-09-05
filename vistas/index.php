<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>LOGIN</title>
	<link rel="stylesheet" href="">
	<script src="../controladores/ajax.js"></script>
	<script src="../controladores/login.js"></script>
	<link rel="stylesheet" href="estiloLogin.css">
</head>
<body>
	<h1>Ingresa los datos para logearte</h1>
	<form action ="../modelos/validarSesion.php" id="formLogin" onsubmit="validarLogin(event)">
		<label for="emailLogin"><strong>Email: </strong></label>
		<br>
		<input type="email" name="emailLogin" id="emailLogin">
		<br>
		<label for="contraLogin"><strong>Contraseña: </strong></label>
		<br>
		<input type="password" name="contralLogin" id="contraLogin">
		<br>
		<input type="submit" name="" value="ingresar">
	</form>
</body>
</html>