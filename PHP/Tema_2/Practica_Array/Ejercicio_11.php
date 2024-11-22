<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 11 de Arrays</title>
</head>
<body>
    <?php
        echo "<h2> Ejercicio 11 de Arrays: juntar tres arrays con merge y mostrarlo</h2>";
        $animales[]="Lagartija";
        $animales[]="Araña";
        $animales[]="Perro";
        $animales[]="Gato";
        $animales[]="Ratón";

        $numeros[]=12;
        $numeros[]=34;
        $numeros[]=45;
        $numeros[]=52;
        $numeros[]=12;

        $arboles[]="Sauce";
        $arboles[]="Naranjo";
        $arboles[]="Pino";
        $arboles[]="Chopo";
        $numeros[]=34;
        $animales[]="Perro";

        $combinado = array_merge($animales,$numeros,$arboles);

        foreach ($combinado as $key => $value) {
            echo "<p>".$value."</p>";
        }
    ?>
</body>
</html>