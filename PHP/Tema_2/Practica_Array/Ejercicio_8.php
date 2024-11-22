<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ejercicio 8 de Arrays</title>
</head>
<body>
    <?php
        $personas[]="Pedro";
        $personas[]="Ismael";
        $personas[]="sonia";
        $personas[]="Clara";
        $personas[]="Susana";
        $personas[]="Alfonso";
        $personas[]="Teresa";

        echo "<p> El array tiene ".count($personas)." elementos</p>";
        echo "<ul>";
        foreach ($personas as $key) {
            echo "<li>".$key."</li>";
        }
        echo "</ul>";
    ?>
</body>
</html>