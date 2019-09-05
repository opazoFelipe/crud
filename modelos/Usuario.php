<?php 

	require 'conexion.php';

class Usuario{

	function logear($correo, $contrasenia){

		$correoExiste = false;

		$conexion = new conexion();
		$bd=$conexion->get_conexion();

		$sql = "USE CRUD";
		$smt=$bd->prepare($sql);
		$smt->execute();

		
		$sql = "SELECT * FROM usuarios WHERE correo = ?";
		$smt=$bd->prepare($sql);
		$smt->bindValue(1, $correo, PDO::PARAM_STR);
		$smt->execute();
		if($smt->rowCount() == 1){
			$correoExiste = true;
		}

		$sql = "SELECT * FROM usuarios WHERE correo = ? AND contrasenia = ?";
		$smt=$bd->prepare($sql);
		$smt->bindValue(1, $correo, PDO::PARAM_STR);
		$smt->bindValue(2, $contrasenia, PDO::PARAM_STR);
		if($smt->execute()){
			if($smt->rowCount() == 1){
				return "OK";
				die();
			}else{
				if($correoExiste){
					return "clave_fallida";
					die();
				}else{
					return "no_registrado";
					die();
				}
			}
		}else{
			return "error";
			die();
		}
	}

	function ingresar($correo, $nombre, $aPaterno, $aMaterno, $telefono, $contrasenia){
		$conexion = new conexion();
		$bd=$conexion->get_conexion();

		$sql = "USE CRUD";
		$smt=$bd->prepare($sql);
		$smt->execute();

		//Primero validar que el correo nuevo del usuario no exista previamente en la bd
		$sql = "SELECT * FROM usuarios WHERE correo = ?";
		$smt=$bd->prepare($sql);
		$smt->bindValue(1, $correo, PDO::PARAM_STR);
		$smt->execute();
		if($smt->rowCount() == 0){

			$sql = "INSERT INTO usuarios VALUES(?,?,?,?,?,?)";
			$smt=$bd->prepare($sql);
			$smt->bindValue(1, $nombre, PDO::PARAM_STR);
			$smt->bindValue(2, $aPaterno, PDO::PARAM_STR);
			$smt->bindValue(3, $aMaterno, PDO::PARAM_STR);
			$smt->bindValue(4, $correo, PDO::PARAM_STR);
			$smt->bindValue(5, $telefono, PDO::PARAM_STR);
			$smt->bindValue(6, $contrasenia, PDO::PARAM_STR);

			if($smt->execute()){
				if($smt->rowCount() == 1){
					return "OK";
					die();
				}else{
					return "no_registrado";
					die();
				}
			}else{
				return "error";
				die();
			}
		}else{
			return "correo_existe";
			die();
		}
	}

	function modificar($correo, $correoNuevo, $nombre, $aPaterno, $aMaterno, $telefono, $contrasenia){
		$conexion = new conexion();
		$bd=$conexion->get_conexion();

		$sql = "USE CRUD";
		$smt=$bd->prepare($sql);
		$smt->execute();

		if($correo != $correoNuevo){
			//Primero validar que el correo del nuevo usuario no exista previamente en la bd
			$sql = "SELECT * FROM usuarios WHERE correo = ?";
			$smt=$bd->prepare($sql);
			$smt->bindValue(1, $correoNuevo, PDO::PARAM_STR);
			$smt->execute();
			if($smt->rowCount() == 1){
				echo "correo_existe";
				die();
			}
		
			$sql = "UPDATE usuarios SET nombre = ?, 
									apellido_paterno = ?,
									apellido_materno = ?,
									correo = ?,
									telefono = ?,
									contrasenia = ?
								WHERE correo = ?
			";

			$smt=$bd->prepare($sql);

			$smt->bindValue(1, $nombre, PDO::PARAM_STR);
			$smt->bindValue(2, $aPaterno, PDO::PARAM_STR);
			$smt->bindValue(3, $aMaterno, PDO::PARAM_STR);
			$smt->bindValue(4, $correoNuevo, PDO::PARAM_STR);
			$smt->bindValue(5, $telefono, PDO::PARAM_STR);
			$smt->bindValue(6, $contrasenia, PDO::PARAM_STR);
			$smt->bindValue(7, $correo, PDO::PARAM_STR);

			if($smt->execute()){
				if($smt->rowCount() == 1){
					return "OK";
					die();
				}else{
					return "no_modificado";
					die();
				}
			}else{
				return "error";
				die();
			}
		}
	}

	function eliminar($correo){
		$conexion = new conexion();
		$bd=$conexion->get_conexion();

		$sql = "USE CRUD";
		$smt=$bd->prepare($sql);
		$smt->execute();

		$sql = "DELETE FROM usuarios WHERE correo = ?";
		$smt=$bd->prepare($sql);
		$smt->bindValue(1, $correo, PDO::PARAM_STR);
		if($smt->execute()){
			if($smt->rowCount() == 1){
				return "OK";
				die();
			}else{
				return "no_eliminado";
				die();
			}
		}else{
			return "error";
			die();
		}
	}

	function mostrarTodos(){
		$conexion = new conexion();
		$bd=$conexion->get_conexion();

		$sql = "USE CRUD";
		$smt=$bd->prepare($sql);
		$smt->execute();

		$sql = "SELECT * FROM usuarios ORDER BY correo";
		$smt=$bd->prepare($sql);
		if($smt->execute()){
			if($smt->rowCount() > 0){

				$usuarios = array();
				$i = 0;

				while($result = $smt->fetch(PDO::FETCH_ASSOC))
				{
					$nombre = $result["nombre"];
					$aPaterno=$result["apellido_paterno"];
					$aMaterno=$result["apellido_materno"];
					$correo=$result["correo"];
					$telefono=$result["telefono"];
					$contrasenia=$result["contrasenia"];

					$usuarios[$i] = [
						"nombre"=>$nombre,
						"aPaterno"=>$aPaterno,
						"aMaterno"=>$aMaterno,
						"correo"=>$correo,
						"telefono"=>$telefono,
						"contra"=>$contrasenia
					];		
					
					$i++;
				}

				return $usuarios;
			}else{
				return "vacio";
				die();
			}
		}else{
			return "error";
			die();
		}
	}

	function mostrarUno($correo){
		$conexion = new conexion();
		$bd=$conexion->get_conexion();

		$sql = "USE CRUD";
		$smt=$bd->prepare($sql);
		$smt->execute();
		
		$sql = "SELECT * usuarios WHERE correo = ?";
		$smt=$bd->prepare($sql);
		$smt->bindValue(1, $correo, PDO::PARAM_STR);

		if($smt->execute()){
			if($smt->rowCount() == 1){
				$result = $smt->fetch(PDO::FETCH_ASSOC);
				$nombre = $result["nombre"];
				$aPaterno=$result["apellido_paterno"];
				$aMaterno=$result["apellido_materno"];
				$correo=$result["correo"];
				$telefono=$result["telefono"];
				$contrasenia=$result["contrasenia"];

				$usuarios = array(
					"nombre"=>$nombre,
					"aPaterno"=>$aPaterno,
					"aMaterno"=>$aMaterno,
					"correo"=>$correo,
					"telefono"=>$telefono,
					"contra"=>$contrasenia
				);

				return $usuarios;
				die();
			}else{
				return "vacio";
				die();
			}
		}else{
			return "error";
			die();
		}
	}
}

 ?>