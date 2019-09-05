<?php
    session_start();
    error_reporting(0);
    $varsesion = $_SESSION["usuario"];

    if($varsesion == nul || $varsesion == ""){
        echo "Debes Iniciar Sesion";
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="../controladores/controladorUsuarios.js"></script>
    <script src="../controladores/ajax.js"></script>
    <link rel="stylesheet" href="estiloCrud.css">
    <title>CRUD</title>
</head>
<body>
  
    <div id="botones">
        <button onclick="ingresarUsuario()">Ingresar usuario</button>
        <button onclick="mostarUsuarios()">Ver usuarios</button>
    </div>

    <a href="../modelos/cerrarSesion.php" id="cerrarSesion">Cerrar Sesion</a>

    <div id="tablaUsuarios">
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Correo</th>
                    <th>Telefono</th>
                    <th>Contraseña</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="bodyTablaUsuarios"></tbody>
        </table>
    </div>

    <div id="formularioModificar">
        <br>
        <h2 id="tituloFormulario"></h2>
      
        <form id="formulario" onsubmit="ingresarUsuario()">
            <label for="nombreIngresar"><strong>Nombre: </strong></label>
            <br>
            <input type="text" name="nombreIngresar" id="nombreIngresar">
            <br>
            <label for="aPaternoIngresar"><strong>Apellido Paterno: </strong></label>
            <br>
            <input type="text" name="aPaternoIngresar" id="aPaternoIngresar">
            <br>
            <label for="aMaternoIngresar"><strong>Apellido Materno: </strong></label>
            <br>
            <input type="text" name="aMaternoIngresar" id="aMaternoIngresar">
            <br>
            <label for="telefonoIngresar"><strong>Telefono: </strong></label>
            <br>
            <input type="text" name="telefonoIngresar" id="telefonoIngresar">
            <br>
            <label for="correoIngresar"><strong>Correo: </strong></label>
            <br>
            <input type="email" name="correoIngresar" id="correoIngresar">
            <br>
            <label for="contraIngresar"><strong>Contraseña: </strong></label>
            <br>
            <input type="password" name="contraIngresar" id="contraIngresar">
            <br>
            <br>
            <input type="hidden" name="" id="oculto">
        </form>
    </div>
    
</body>
</html>