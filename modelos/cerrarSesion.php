<?php
    session_start();
    error_reporting(0);
    $varsesion = $_SESSION["usuario"];

    if($varsesion == nul || $varsesion == ""){
        echo "Contenido Bloqueado";
        die();
    }

    session_destroy();
    header("Location: ../vistas/index.php");

?>