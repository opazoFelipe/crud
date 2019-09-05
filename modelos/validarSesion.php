<?php
    session_start();
    $_SESSION["usuario"] = "usuario";
    header("Location: ../vistas/crud.php");
?>