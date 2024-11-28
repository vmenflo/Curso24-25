<?php
    session_start();
    require "src/funciones_ctes.php";
    //conectamos
    try{
        @$conexion=mysqli_connect(SERVIDOR_BD,USUARIO_BD,CLAVE_BD,NOMBRE_BD);
        mysqli_set_charset($conexion,"utf8");
    }catch(Exceptions $e){
        session_destroy();
    die(error_page("Examen notas","<p>No se ha podido conectar a la BD: ".$e->getMessage()."</p>"));
    }

    //conectamos para ver si hay alumnos
    try{
        $consulta="select * from alumnos";
        $result_select=mysqli_query($conexion,$consulta);
        
    }catch(Exceptions $e){
        session_destroy();
        mysqli_close($conexion);
    die(error_page("Examen notas","<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p>"));
    }

    // Obtenemos los datos del alumno en concreto
    if(isset($_POST["alumno"])){
        try{
            $consulta="select * from notas where cod_alu='".$_POST["alumno"]."'";
            $result_detalle_alumno=mysqli_query($conexion,$consulta);
            
        }catch(Exceptions $e){
            session_destroy();
            mysqli_close($conexion);
        die(error_page("Examen notas","<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p>"));
        }
    }
    //cerramos
    mysqli_close($conexion);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen Notas</title>
</head>
<body>
    <h1>Notas de los Alumnos</h1>
    <?php

        if(mysqli_num_rows($result_select)<=0){
            echo "<p> En estos momentos no tenemos a ningún alumno registrado en la BD.</p>";
        }else{
            require "vistas/vista_seleccion.php";
        }
        if(isset($_POST["alumno"])){
            require "vistas/vista_detalle.php";
        }
       
    ?>
</body>
</html>