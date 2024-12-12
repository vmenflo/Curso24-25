<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>
<body>
    <h1>POO: Ejercicio 1</h1>
    <?php
        require "class_fruta.php";
        $pera = new Fruta();
        $pera->setColor("verde");
        $pera->setTamanyo("mediano");

        echo "<h2> Información de mi fruta Pera </h2>";
        echo "<p>Color: ".$pera->getColor()."; Tamaño: ".$pera->getTamanyo()."</p>";
    ?>
</body>
</html>