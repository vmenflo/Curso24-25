<?php
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
                echo "<h3>Horario del Profesor: ".$nombre_profesor."</h3>";
                $dias[]="";
                $dias[]="Lunes";
                $dias[]="Martes";
                $dias[]="Miércoles";
                $dias[]="Jueves";
                $dias[]="Viernes";

                $horas=["8:15-9:15","9:15,10:15","10:15,11:15","11:15,11:45","11:45,12:45","12:45,13:45","13:45,14:45","14:45,15:45"];

                echo "<table>";
                    echo "<tr>";
                        for ($i=0; $i < count($dias); $i++) { 
                            echo "<th>".$dias[$i]."</th>";
                        }
                    echo "</tr>";
                    for ($i=0; $i <count($horas); $i++) { 
                        echo "<tr>";
                            echo "<th>".$horas[$i]."</th>";
                            if($i===3){
                                echo "<td colspan='5'> Descanso</td>";
                            }else{
                            for ($j=1; $j < count($dias); $j++) {
                                
                                    echo "<td>Hola</td>";
                                
                                }
                            }
                        echo "</tr>";
                    }
                echo "</table>";
                
            }
            
       

        ?>
    </body>
</html>