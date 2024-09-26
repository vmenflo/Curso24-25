<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6</title>
</head>
<body>
    <?php
        $ciudades[]="Madrid";
        $ciudades[]="Barcelona";
        $ciudades[]="Londres";
        $ciudades[]="New York";
        $ciudades[]="Los Ángeles";
        $ciudades[]="chicago";
        
        echo "<h2> Ciuades : </h2>";
        for ($i=0; $i < count($ciudades); $i++) 
            echo "<p>La ciudad con el indice ".$i." tiene el nombre ".$ciudades[$i]."</p>";    
    ?>
</body>
</html>