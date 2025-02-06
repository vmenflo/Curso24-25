<?php
session_name("Actividad_8");
session_start();
require "src/funciones_ctes.php";

if(isset($_POST["btnCerrarSession"])){
    session_destroy();
    header("Location:index.php");
    exit;
}


if(isset($_SESSION["token"])){

    require "src/seguridad.php";

    if($datos_usuario_log["tipo"]==="admin"){
        require "vistas/vista_admin.php";
    }else{
        require "vistas/vista_normal.php";
    }
}else{
    require "vistas/vista_login.php";
}

?>

