<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 13 de Arrays</title>
</head>
<body>
   <?php
        echo "<h2> Mostrar el ejercicio anterior en orden inverso</h2>";
        $animales[]="Lagartija";    
        array_push($animales, "Araña", "Perro", "Gato", "Ratón");

        $numeros[]=12;
        array_push($numeros,34,45,52,12);

        $arboles[]="Sauce";
        array_push($arboles, "Naranjo","Pino","Chopo",34,"Perro");

        $combinado = array_merge($animales,$numeros,$arboles);
        // Invertir el orden se entiende que es ,false. Si pusiera ,true mantendría los indices
        $combinado_invertido = array_reverse($combinado);

        foreach ($combinado_invertido as $key => $value) {
            echo "<p>".$value."</p>";
        }
   ?>
</body>
</html>