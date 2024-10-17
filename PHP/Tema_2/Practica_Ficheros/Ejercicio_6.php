<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6</title>
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
    <h1>Ejercicio 6</h1>
    <form action="Ejercicio_6.php" method="post" enctype="multipart/form-data">
        <label for="pais">Seleccione un país para conocer su PIB en los ultimos años</label>
        <select name="pais" id="pais">
            <?php 
                $ruta = "http://dwese.icarosproject.com/PHP/datos_ficheros.txt"; 
                @$file = fopen($ruta, "r");
                    if(!$file){ // si no se ha podido abrir mostramos el mensaje
                        die("<p> No se ha podido abrir el fichero</p>");
                    }
                $arr_paises = array();
                $primer_linea = fgets($file);
                while(!feof($file)){
                    $linea = fgets($file);
                    $arr_fila = explode("\t", $linea);
                    $campo_pais = $arr_fila[0];
                    $arr_campo_pais = explode(",", $campo_pais);
                    $arr_paises [] = end($arr_campo_pais);
                }
                for ($i=0; $i <count($arr_paises); $i++) { 
                    echo "<option value='".($i+1)."'>".$arr_paises[$i]."</option>";
                }
                fclose($file);
            ?>
        </select>
            </br></br>
        <button type="submit" name="enviar">Elegir</button>
    </form>
    <?php 
        if(isset($_POST["enviar"])){
            @$file = fopen($ruta, "r");
                    if(!$file){ // si no se ha podido abrir mostramos el mensaje
                        die("<p> No se ha podido abrir el fichero</p>");
                    }
            // Indice para poder elegir el país que pidamos
            $indice = $_POST["pais"];
            echo "<table>";
            echo "<tr>";
                    // Usamos la primera línea para los títulos
                    $linea = fgets($file);
                    $contenido = explode("\t", $linea);
                    $tamaño = count($contenido);
                    for ($i=0; $i <count($contenido) ; $i++) { 
                        echo "<th>".$contenido[$i]."</td>";
                    }
            echo "</tr>";
            echo "<tr>";
                    $contador=1; // Le sumaremos 1 en cada iteración para poder llevar la cuenta, empieza en 1 porque el 0 es el th de antes
                    while(!feof($file)){
                        $linea = fgets($file);
                        if($indice == $contador){
                            $contenido = explode("\t", $linea);
                            for ($i=0; $i <$tamaño ; $i++) { 
                                if(isset($contenido[$i])){
                                    echo "<td>".$contenido[$i]."</td>";
                                }else{
                                    echo "<td></td>";
                                }
                                
                            }
                        }
                        $contador++;
                    }
            echo "</tr>";
            echo "</table>";
            fclose($file);
        }
    ?>
    
</body>
</html>