<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 12 de Arrays</title>
</head>
<body>
    <?php
        echo "<p>Ejercicio 12 de Arrays: mismo ejercicio pero usando array_push</p>";
        $animales[]="Lagartija";    
        array_push($animales, "Araña", "Perro", "Gato", "Ratón");

        $numeros[]=12;
        array_push($numeros,34,45,52,12);

        $arboles[]="Sauce";
        array_push($arboles, "Naranjo","Pino","Chopo",34,"Perro");

        $combinado = array_merge($animales,$numeros,$arboles);

        foreach ($combinado as $key => $value) {
            echo "<p>".$value."</p>";
        }
    ?>
</body>
</html>