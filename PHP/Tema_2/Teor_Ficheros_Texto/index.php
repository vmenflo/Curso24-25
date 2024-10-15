<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoría Ficheros de Texto</title>
</head>
<body>
    <?php
        // r es lectura
        // w es escritura, si existe lo abre y lo borra. Si no existe el archivo lo crea
        // Función abrir un fichero
        @$file = fopen("prueba.txt", "r");
        if(!$file){ // si no se ha podido abrir mostramos el mensaje
            die("<p> No se ha podido abrir el fichero</p>");
        }

        // Siempre que se abre un fichero hay que cerrarlo

        //Recorrer fichero
        while(!feof($file)){
            $linea = fgets($file);
            echo "<p>".$linea."</p>";
        }
        echo "<h2> Fin del fichero </h2>";
        // ponemos de nuevo el puntero al principio para poder ver la otra forma de mostrarlo
        fseek($file,0);
        echo "<h2> Así le gusta a MA </h2>";
        // Forma que le gusta a Miguel Angel
        while($linea=fgets($file)){
            echo "<p>".$linea."</p>";
        }

        fclose($file);
        // Vamos añadir una línea nueva

        @$file = fopen("prueba.txt", "a"); // Sifuese una w machaca todo lo que hay y escribo lo que le indiquemos.
        if(!$file){ // si no se ha podido abrir mostramos el mensaje
            die("<p> No se ha podido abrir el fichero</p>");
        }
        // dos formas de escribir fputs y fwrite
        fputs($file, PHP_EOL."Tercera línea");
        fwrite($file, PHP_EOL."Cuarta línea");

        fclose($file);

        // Función para leer entero un fichero
        echo "<h2> Lectura entera de un fichero </h2>";
        $todo = file_get_contents("prueba.txt");
        echo "<pre>".$todo."</pre>";
        echo "<p> Lo mostramos con nl2br que transforma todos los huecos en salto de linea</p>";
        echo nl2br($todo);
        
        /*
        echo "<h3> Lectura de una web </h3>";
        $web=file_get_contents("https://www.google.es");
        echo $web;
        */
    ?>
</body>
</html>