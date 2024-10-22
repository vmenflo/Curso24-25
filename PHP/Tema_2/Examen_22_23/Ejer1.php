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
                    echo "<p> Fichero creado con éxito</p>";
                    @$file=fopen($ruta,"w");
                    //primera linea
                    $primera_linea ="Letra/Desplamiento;1;2;3;4;5;6;7;8;9;10;11;12;13;14;15;16;17;18;19;20;21;22;23;24;25;26";
                    fputs($file, $primera_linea.PHP_EOL);
                    for ($i=0; $i < 27; $i++) { 
                        $linea ="";
                        for ($j=0; $j < 26 ; $j++) { 
                            $linea.=chr($j+65).";";
                        }
                        fputs($file, $linea.PHP_EOL);
                    }

                    $contenido = file_get_contents($ruta);
                    echo "<textarea>".$contenido."</textarea>";
                    fclose($file);
                }else{
                    echo "<p> Fichero leído con éxito </p>";
                    $contenido = file_get_contents($ruta);
                    echo "<textarea>".$contenido."</textarea>";
                    fclose($file);
                }
            }
        ?>
    </form>
</body>
</html>