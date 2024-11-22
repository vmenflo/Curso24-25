<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 7 de Arrays</title>
</head>
<body>
    <?php
        $ciudades["MD"]="Madrid";
        $ciudades["BC"]="Barcelona";
        $ciudades["LD"]="Londres";
        $ciudades["NY"]="New York";
        $ciudades["LA"]="Los Ángeles";
        $ciudades["CG"]="chicago";

        echo "<h2> Ciudades : </h2>";
        foreach ($ciudades as $indice => $valor) 
            echo "<p> El indice del array que contiene como valor ".$valor." es ".$indice."</p>";
        
    ?>
</body>
</html>