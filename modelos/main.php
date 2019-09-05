<?php

    require 'Usuario.php';

    $accion = $_POST["accion"];

    if($accion == "logear"){

        $usuario = new Usuario();
        $correo = $_POST["correo"];
        $contrasenia = $_POST["contra"];;

        if($correo == "" | $contrasenia == ""){
            echo "faltan_datos";
            die();
        }

        $logear = $usuario->logear($correo, $contrasenia);

        if($logear == "OK"){
            echo "OK";
            die();
        }

        if($logear == "clave_fallida"){
            echo "clave_fallida";
            die();
        }
        if($logear == "no_registrado"){
            echo "no_registrado";
            die();
        }
        if($logear == "error"){
            echo "error";
            die();
        }
    }

    if($accion  == "ingresar"){
        $nombre = $_POST["nombre"];
        $aPaterno = $_POST["aPaterno"];
        $aMaterno = $_POST["aMaterno"];
        $correo = $_POST["correo"];
        $telefono = $_POST["telefono"];
        $contrasenia = $_POST["contrasenia"];
            
       $usuario = new Usuario();

       $ingresar = $usuario->ingresar($correo, $nombre, $aPaterno, $aMaterno, $telefono, $contrasenia);

        if($ingresar == "OK"){
            echo "OK";
           
            die();
        }

        if($ingresar == "correo_existe"){
            echo "correo_existe";
           
            die();
        }
        if($ingresar == "no_registrado"){
            echo "no_registrado";
          
            die();
        }
        if($ingresar == "error"){
            echo "error";
           
            die();
        }

    }

    if($accion  == "modificar"){
        $nombre = $_POST["nombre"];
        $aPaterno = $_POST["aPaterno"];
        $aMaterno = $_POST["aMaterno"];
        $correoActual = $_POST["correoActual"];
        $telefono = $_POST["telefono"];
        $contrasenia = $_POST["contrasenia"];
        $correoNuevo = $_POST["correoNuevo"];
        
        $usuario = new Usuario();
 
        $modificar = $usuario->modificar($correoActual, $correoNuevo, $nombre, $aPaterno, $aMaterno, $telefono, $contrasenia);
 
         if($modificar == "OK"){
             echo "OK";
           
             die();
         }
         if($modificar == "no_modificado"){
             echo "no_modificado";
            
             die();
         }
         if($modificar == "error"){
             echo "error";
           
             die();
         }
     }

    if($accion == "eliminar"){
        $correo = $_POST["correo"];
        $usuario = new Usuario();

        $eliminar= $usuario->eliminar($correo);

        if($eliminar == "OK"){
            echo "OK";
           
            die();
        }
        if($eliminar == "no_eliminado"){
            echo "no_eliminado";
           
            die();
        }
        if($eliminar == "error"){
            echo "error";
          
            die();
        }
    }

    if($accion == "mostrarTodos"){
      
        $usuario = new Usuario();
        $usuarios = $usuario->mostrarTodos();

        if(is_array($usuarios)){
            echo json_encode($usuarios);
            
            die();
        }
        if($usuarios == "vacio"){
            echo "vacio";
         
            die();
        }
        if($usuarios == "error"){
            echo "error";
            
            die();
        }
    }

    if($accion == "mostrarUno"){
        
        $correo = $datos->$correo;
        $usuario = new Usuario();
        $usuarios = $usuario->mostrarUno($correo);

        if(is_array($usuarios)){
            echo json_encode($usuarios);
            
            die();
        }
        if($usuarios == "vacio"){
            echo "vacio";
            
            die();
        }
        if($usuarios == "error"){
            echo "error";
           
            die();
        }
     }
?>