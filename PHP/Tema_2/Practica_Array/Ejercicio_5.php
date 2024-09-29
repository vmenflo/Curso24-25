<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5 de Arrays</title>
</head>
<body>
    <?php
        $persona["nombre"]="Pedro Torres";
        $persona["dirección"] = "C/ Mayor 37";
        $persona["telefono"] = 952635898;
        echo "<h2> Datos de la persona </h2>";
        foreach ($persona as $indice => $valor) 
            echo "<p> Su ".$indice." es ".$valor."</p>";
    ?>
</body>
</html>