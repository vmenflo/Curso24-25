<?php
function extension($texto){
    $ext = explode(".", $texto);
    if(end($ext) === "txt"){
        return end($ext);
    }else{
        return false;
    }
}
    if(isset($_POST["enviar"])){
        // Controlar los errores
        $error_fichero = !extension($_FILES["fichero"]["name"]) || $_FILES["fichero"]["size"]> 1*1024*1024|| $_FILES["fichero"]["error"];
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
    <style>
        table,td,th,tr{border:1px solid black;
        padding:0.5rem;
        text-align:center;}
        table{border-collapse:collapse;}
    </style>
</head>
<body>
    <h2>Ejercicio 4</h2>
    <?php
        $ruta = "Horario/horarios.txt";
        @$file= fopen($ruta,"r");

        if(!$file){
            echo "<h2> No se encuentra el archivo ".$ruta."</h2>";
        ?>
        <form action="Ejer4.php" method="post" enctype="multipart/form-data">
        <label for="fichero">Elija un archivo de texto (.txt) no superior a 1MB</label>
        <input type="file" name="fichero" id="fichero">
        <?php
            if(isset($_POST["enviar"]) && $error_fichero){
                if($_FILES["fichero"]["name"]===""){
                    echo "<span> Debes de subir un archivo</span>";
                }elseif($_FILES["fichero"]["error"]){
                    echo "<span>No se ha subido el archivo seleccionado </span>"; 
                }elseif(!extension($_FILES["fichero"]["name"])){
                    echo "<span> Debes de subir un archivo txt </span>";
                }else{
                    echo "<span> El archivo supera 1MB</span>";
                }
            }
        ?>
        <p><button type="submit" name="enviar">Subir</button></p>
    </form>
    <?php
        if(isset($_POST["enviar"])&& !$error_fichero){
            @$var = move_uploaded_file($_FILES["fichero"]["tmp_name"],"Horario/".$_FILES["fichero"]["name"]);
            // Controlar los errores
            if(!$var){
                echo "<p> No se ha podido mover el archivo </p>";
            }
        }
    ?>
        <?php
        }else{
        ?>
        <h2>Horarios de profesores</h2>
        <form action="Ejer4.php" method="post" enctype="multipart/form-data">
            <label for="profesor">Horario del profesor: </label>
            <select name="profesor" id="profesor">
                <?php
                    while(!feof($file)){
                        $linea = fgets($file);
                        $datos = explode("\t", $linea);
                        $profesor = $datos[0];

                        echo "<option value='".$profesor."' >".$profesor."</option>";
                    }
                ?>
            </select>
            <p><button type="submit" name="ver">Ver Horario</button></p>
        </form>
        <?php 
        if(isset($_POST["ver"])){
            fseek($file,0);
            $linea_profesor;
            $datos_profesor;
            while(!feof($file)){
                $linea_profesor=fgets($file);
                $datos_profesor = explode("\t", $linea_profesor);
                if($datos_profesor[0] === $_POST["profesor"]){
                    break;
                }
            }
            // Hacer la tabla
            $dias[0]="";
            $dias[]="Lunes";
            $dias[]="Martes";
            $dias[]="Miercoles";
            $dias[]="Jueves";
            $dias[]="Viernes";

            $horas[0]="8:15-9:15";
            $horas[]="9:15-10:15";
            $horas[]="10:15-11:15";
            $horas[]="11:15-11:45";
            $horas[]="11:45-12:45";
            $horas[]="12:45-13:45";
            $horas[]="13:45-14:45";
            // procesar los datos 
            // creamos una matriz vacia simulando el horario
            for ($i=0; $i <5 ; $i++) { 
                for ($j=0; $j <7; $j++) { 
                    $matriz_horario [$i][$j]= "";
                }
            }
            // almacenamos la informacion en esta matriz
            for ($i=1; $i <count($datos_profesor) ; $i+=3) { 
                $dia = $datos_profesor[$i];
                $hora = $datos_profesor[$i+1];
                $asignatura = $datos_profesor[$i+2];
                $matriz_horario[$dia][$hora]=$asignatura;
            }

            echo "<table>";
            echo "<tr>";
                for ($i=0; $i <count($dias) ; $i++) { 
                    echo "<th>".$dias[$i]."</th>";
                }
            echo "</tr>";
            for ($i=0; $i < count($horas) ; $i++) { 
                echo "<tr>";
                echo "<th>".$horas[$i]."</th>";
                    if($i===3){
                        echo "<td colspan='5'> Descanso</td>";
                    }else{
                    // Rellenar campos dentro como dias halla
                    for ($j=1; $j < count($dias); $j++) { 
                        
                        if(isset($matriz_horario[$j][$i+1])){
                            echo "<td>".$matriz_horario[$j][$i+1]."</td>";
                        }else{
                            echo "<td></td>";
                        }
                        
                    }
                    }
                echo "</tr>";
            }
            echo "</table>";
        }   
        ;fclose($file);}
        ?>

</body>
</html>