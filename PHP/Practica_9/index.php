<?php
session_name("Practica9");
session_start();
require "src/funciones_ctes.php";

if (isset($_POST["btnCerrarSession"])) {
    session_destroy();
    header("Location:index.php");
    exit;
}

if (isset($_SESSION["usuario"])) {
    //Control de baneo  
    //consulta a la BD y si está inicio sesión y salto a index
    require "src/seguridad.php";

    // Muestro vista después de Login
    if ($datos_usuario_log["tipo"] == "admin") {
        require "vistas/vista_admin.php";
    } else {
        require "vistas/vista_logueado.php";
    }
    mysqli_close($conexion);
} elseif (isset($_POST["btnRegistro"])||(isset($_POST["btnContRegistro"]) )) {
    require "vistas/vista_registro.php";
} else {
    require "vistas/vista_login.php";
}
?>