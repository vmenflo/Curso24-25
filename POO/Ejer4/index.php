<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
</head>

<body>
    <h1>POO: Ejercicio 4</h1>
    <?php
    require "class_uva.php";

    $uva = new Uva("verde", "mediano", false);

    echo "<h2> Información de mi UVA </h2>";
    if($uva->tieneSemilla()){
        echo "<p> La uva tiene Semilla y además:</p>";
        $uva->imprimir();
    }else{
        echo "<p> La uva NO tiene Semilla y además:</p>";
        $uva->imprimir();
    }

    ?>
</body>

</html>