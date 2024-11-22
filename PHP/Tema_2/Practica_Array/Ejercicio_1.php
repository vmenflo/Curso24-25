<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 Arrays</title>
</head>
<body>
    <?php
        // Vamos a hacerlo con una constante aunque no lo pida el ejercicio
        // La forma mas común
        define("N_PARES",10);

        // Otra forma de crear constantes
        // const N_PARES=30;

        for($i=0;$i<N_PARES;$i++)
            $pares[]=$i*2; // Almacena los pares

        echo "<h2> Los ".N_PARES." primeros números pares </h2>";
        for($i=0;$i<N_PARES;$i++)
            echo "<p>".$pares[$i]."</p>";
    ?>
</body>
</html>