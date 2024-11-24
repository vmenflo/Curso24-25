<?php
    session_start();  // Iniciar sesión para mantener los datos entre recargas de página
    require "src/funciones_ctes.php";
    //Conectamos con la base
    try{
        @$conexion=mysqli_connect(SERVIDOR_BD,USUARIO_BD,CLAVE_BD,NOMBRE_BD);
        mysqli_set_charset($conexion,"utf8");
    }catch(Exception $e){
        die(error_page("Examen2 23-24","<p>No se ha podido conectar a la BD: ".$e->getMessage()."</p>"));
    }
    //Una vez conectados obtenemos los profesores
    try{
        $consulta = "select * from usuarios";
        $result_datos_usuarios=mysqli_query($conexion,$consulta);
    }catch(Exception $e){
        die(error_page("Examen2 23-24","<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p>"));
    }

    // Traemos los datos del profesor en concreto que indiquemos
    if(isset($_POST["btnMostrarHorario"])){
        try{
            $consulta = "SELECT h.dia, h.hora, g.nombre AS grupo_nombre FROM horario_lectivo h JOIN grupos g ON h.grupo = g.id_grupo WHERE h.usuario = '".$_POST['horario']."'";
            $result_datos_horario_profesor=mysqli_query($conexion,$consulta);

        // Creamos la matriz del horario
        $horario = [];
        while ($fila = mysqli_fetch_assoc($result_datos_horario_profesor)) {
            $dia = $fila['dia']; 
            $hora = $fila['hora']; 
            $grupo = $fila['grupo_nombre']; 
            $horario[$dia][$hora] = $grupo; // Lo almacenamos
        }
        $_SESSION["horario"]=$horario;
        }catch(Exception $e){
            die(error_page("Examen2 23-24","<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p>"));
        }
    }

    // Siempre se cierra
    mysqli_close($conexion);

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Examen2 PHP</title>
        <style>
            table{
                border-collapse: collapse;
            }
            table,td,th,tr{border:1px solid black;
                padding:0.5rem;
                text-align:center;
            }
        </style>
    </head>
    <body>
        <?php
            require "vistas/vista_seleccion.php";

            if(isset($_POST["btnMostrarHorario"])){
                require "vistas/vista_tabla.php";
            }
            if(isset($_POST["btnEditar"])){
                echo "<p> Has pulsdado</p>";
            }
        ?>
    </body>
</html>