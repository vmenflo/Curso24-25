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
            $consulta="select notas.cod_asig, notas.nota, asignaturas.denominacion from notas join asignaturas on notas.cod_asig = asignaturas.cod_asig where notas.cod_alu = '".$_POST["alumno"]."'";
            $result_detalle_alumno=mysqli_query($conexion,$consulta);
            $_SESSION["alumno"]=$_POST["alumno"];

        }catch(Exceptions $e){
            session_destroy();
            mysqli_close($conexion);
        die(error_page("Examen notas","<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p>"));
        }

        //Obtenemos las notas que le faltan
        try
        {
            $consulta="select * from asignaturas where cod_asig not in (select cod_asig from notas where cod_alu='".$_POST["alumno"]."')";
            $result_asignaturas_faltan=mysqli_query($conexion,$consulta);
            
        }
        catch(Exception $e)
        {
            session_destroy();
            mysqli_close($conexion);
            die(error_page("Examen2 PHP","<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p>"));
        }
    }

    if(isset($_POST["btnCalificar"])){
        try
        {
            $consulta="insert into notas (cod_alu, cod_asig, nota) values ('".$_POST["cod_alumno"]."','".$_POST["asignatura"]."','0.00')";
            $result_asignaturas_faltan=mysqli_query($conexion,$consulta);
            
        }
        catch(Exception $e)
        {
            session_destroy();
            mysqli_close($conexion);
            die(error_page("Examen2 PHP","<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p>"));
        }
    }

    if(isset($_POST["btnBorrar"])){
        try
        {
            $consulta="delete from notas where cod_alu='".$_POST["cod_alu"]."' and cod_asig='".$_POST["cod_asig"]."'";
            $result_grupos_libres_profesor_dia_hora=mysqli_query($conexion,$consulta);
        }
        catch(Exception $e)
        {
            session_destroy();
            mysqli_close($conexion);
            die(error_page("Examen2 PHP","<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p>"));
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