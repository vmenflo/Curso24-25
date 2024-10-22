<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>
<body>
    <h1>Ejercicio 1. Generador de "claves_cesar.txt"</h1>
    <form action="Ejer1.php" method="post" enctype="multipart/form-data">
        <button type="submit" name="enviar">Generar</button>
        <?php
            if(isset($_POST["enviar"])){
                $ruta = "claves_cesar.txt";
                @$file= fopen($ruta,"r");
                if(!$file){
                    echo "<p> Resupuesta </p>";
                    @$file=fopen($ruta,"w");
                    //primera linea
                    $primera_linea ="Letra/Desplamiento;1;2;3;4;5;6;7;8;9;10;11;12;13;14;15;16;17;18;19;20;21;22;23;24;25;26";
                    fputs($file, $primera_linea.PHP_EOL);
                    $valor=0;
                    $final=26;
                    for ($i=0; $i < 27; $i++) { 
                        $linea ="";

                        for ($j=$valor; $j < $final ; $j++) { 
                           if($j>=26){
                                $linea.=chr(($j-26)+65).";";
                            }else{
                            $linea.=chr($j+65).";";
                            }
                        }
                        fputs($file, $linea.PHP_EOL);
                        $valor++;
                        $final++;
                    }

                    $contenido = file_get_contents($ruta);
                    echo "<textarea rows='30' cols='100'>".$contenido."</textarea>";
                    echo "<p> Fichero creado con éxito</p>";
                    fclose($file);
                }else{
                    echo "<p> Resupuesta </p>";
                    $contenido = file_get_contents($ruta);
                    echo "<textarea rows='30' cols='100'>".$contenido."</textarea>";
                    echo "<p> Fichero leído con éxito </p>";
                    fclose($file);
                }
            }
        ?>
    </form>
</body>
</html>