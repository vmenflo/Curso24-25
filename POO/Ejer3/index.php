<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
</head>

<body>
    <h1>POO: Ejercicio 2</h1>
    <?php
    require "class_fruta.php";
    echo "<p>Frutas creadas hasta el momento: ".Fruta::cuentaFruta()."</p>";
    $pera = new Fruta("verde", "mediano");
    echo "<p>Creamos una fruta ... </p>";
    echo "<p>Frutas creadas hasta el momento: ".Fruta::cuentaFruta()."</p>";
    unset($pera); // Tambien $pera = null;
    echo "<p>borramos una fruta ... </p>";
    echo "<p>Frutas creadas hasta el momento: ".Fruta::cuentaFruta()."</p>";
    

    ?>
</body>

</html>