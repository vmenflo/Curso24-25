<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 18 de Arrays</title>
</head>
<body>
    <?php
        $deportes[]="futbol";
        $deportes[]="baloncesto";
        $deportes[]="natacion";
        $deportes[]="tenis";

        for($i=0;$i<count($deportes);$i++)
            echo "<p>".$deportes[$i]."</p>";
        echo "<p> Tiene ".count($deportes)." elementos</p>"; // Mostrar los elementos
        echo "<p> Situar el puntero en el primero ".current($deportes)."</p>";
        echo "<p> Avanzamos una posición ".next($deportes)."</p>";
        echo "<p> Mostramos el valor de la última posición ".end($deportes)."</p>";
        echo "<p> Retrocedemos una posición a la última ".prev($deportes)."</p>";
    ?>
</body>
</html>