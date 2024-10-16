<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5</title>
    <style>
        table,td,tr {
            border-collapse:collapse;
            border:2px black solid;
        }
        td{
            padding:0.2rem;
        }
    </style>
</head>
<body>
    <h2>Ejercicio 5</h2>
    <h4>TABLA PIB: PAISES DE LA UNIÓN EUROPEA </h4>
    <?php
        $ruta = "http://dwese.icarosproject.com/PHP/datos_ficheros.txt";
        @$file = fopen($ruta, "r");
            if(!$file){ // si no se ha podido abrir mostramos el mensaje
                die("<p> No se ha podido abrir el fichero</p>");
            }

        // HACER LA TABLA
        echo "<table>";
        $linea = fgets($file);
        $arr_datos = explode("\t", $linea);
        echo "<tr>";
            for ($i=0; $i <count($arr_datos) ; $i++) { 
                echo "<th>".$arr_datos[$i]."</th>";
            }
        echo "</tr>";
        while(!feof($file)){
            $linea = fgets($file);
            $arr_datos = explode("\t", $linea);
            echo "<tr>";
                for ($i=0; $i <count($arr_datos) ; $i++) { 
                    echo "<td>".$arr_datos[$i]."</td>";
                }
            echo "</tr>";
        }
        echo "</table>";
        fclose($file);
        
    ?>
</body>
</html>