<?php
session_name("Practica10");
    session_start();
    require "src/funciones_ctes.php";
    
    
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio prácticar para el Examen, Login y CRUD</title>
    <style>
            .centrado{text-align:center}
            table, td, th{border:1px solid black}
            table{border-collapse:collapse;margin:0 auto;width:90%}
            th{background-color:#CCC}
            .enlace{background:none;border:none;color:blue;text-decoration:underline;cursor:pointer}
            .mensaje{font-size:1.25rem; color:blue}
        </style>
</head>
<body>
    <h2>Práctica 10</h2>
    <?php
        if (isset($_POST["btnSalir"])) {
            session_destroy();
            header("Location:index.php");
            exit;
        }

        if(isset($_SESSION["usuario"])){
            //Control de baneo  
            //consulta a la BD y si está inicio sesión y salto a index
            require "src/seguridad.php";
            //Si es admin
            if($datos_usuario_log["tipo"]=="admin")
                require "vistas/vista_admin.php";
            //Si es normal
            if($datos_usuario_log["tipo"]=="normal")
                require "vistas/vista_logueado_normal.php";
            
            mysqli_close($conexion);
        }else{
            require "vistas/vista_login.php";
        }
        

    ?>
</body>
</html>