<?php
session_start();
require "src/funciones_ctes.php";

if (isset($_POST["btnCerrarSession"])) {
    session_destroy();
    header("Location:index.php");
    exit;
}

if (isset($_SESSION["usuario"])) {
    require "vistas/seguridad.php";

    // Muestro vista despues de login
    require "vistas/vista_logueado.php";

    mysqli_close($conexion);
} else {
    require "vistas/vista_login.php";
}
?>