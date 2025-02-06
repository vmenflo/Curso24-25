<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 7</title>
</head>
<body>
    <?php
    require "class_pelicula.php";
    $peliculaUno = new Pelicula("Terminator","1984","James Cameron",3, true, "2024-12-15", 0.5);
    echo "<p> Ficha de la pelicula </p>";
    echo "<p>Nombre: ".$peliculaUno->getNombre()."</p>";
    echo "<p>Director: ".$peliculaUno->getDirector()."</p>";
    echo "<p>Año : ".$peliculaUno->getAño()."</p>";
    echo "<p>Precio del alquiler : ".$peliculaUno->getPrecio()."</p>";
    $peliculaUno->getAlquilada();
    echo "<p> Fecha de la devolución: ".$peliculaUno->getFechaDev()."</p>";

    echo "<p> Devolución de la pelicula</p>";
    $peliculaUno->penalizacion();

    ?>
</body>
</html>