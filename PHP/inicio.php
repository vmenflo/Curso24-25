<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=p, initial-scale=1.0">
    <title>Primera web PHP</title>
</head>
<body>
    <?php
    // Declarar variables ($)
        $texto1="Víctor";
        $texto2="María";
        $a=5;
        $b=2;
        echo "<h1> Mi primera web </h1>";
        echo "<p>HOLA! " .$texto1 ." y " .$texto2 ."</p>";
        echo "<p> El resultado de sumar" .$a ." y " .$b ." es " .($a+$b)."</p>";
    ?>
</body>
</html>