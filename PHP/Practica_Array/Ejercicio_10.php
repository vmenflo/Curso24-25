<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 10 de Arrays</title>
</head>
<body>
    <?php
        echo "<h2> Array con la media de los pares y mostrar los impares</h2>";

        $numeros[]=1;
        $numeros[]=2;
        $numeros[]=3;
        $numeros[]=4;
        $numeros[]=5;
        $numeros[]=6;
        $numeros[]=7;
        $numeros[]=8;
        $numeros[]=9;
        $numeros[]=10;

        for($i=0;$i<count($numeros);$i++){
            if($numeros[$i]%2==0)
                echo "<p> La media del Par ".$numeros[$i]." es ".($numeros[$i]/2)." .</p>";
            echo "<p> El numero impar es : ".$numeros[$i]."</p>";

        }
    ?>
</body>
</html>