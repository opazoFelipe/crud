<?php
	class conexion
	{
		public function get_conexion()
		{
			try
			{
				$conexion=new PDO('mysql: host = localhost; port= 3306; dbname = CRUD', "root", "felipe");
				$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				return $conexion;
			}catch(PDOException $e)
			{
					echo "La conexion fallo <br>".$e->getMessage();
					
			}
		}
	}
?>