<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 14 de Arrays</title>
    <style>
        table, th, td {border:1px solid black;}
        table {border-collapse:collapse;}
    </style>
</head>
<body>
    <?php
        echo "<h2> Tabla de los estadios de futbol</h2>";

        $estadios_futbol["Barcelona"]="Camp Nou";
        $estadios_futbol["Real Madrid"]="Santiago Bernabeu";
        $estadios_futbol["Valencia"]="Mestalla";
        $estadios_futbol["Real Sociedad"]="Anoeta";
        // Lo mostramos
        echo "<table>";
        echo "<tr><th>Ciudades</th><th>Estadios</th></tr>";
        foreach ($estadios_futbol as $ciudad => $estadio) {
            echo "<tr>";
            echo "<td>".$ciudad."</td><td>".$estadio."</td>";
            echo "</tr>";
        }
        echo "</table>";
        // Eliminamos el Camp nou
        unset($estadios_futbol["Barcelona"]);
        echo "<p> Hemos eliminado Barcelona</p></br>";

        // Lo mostramos
        echo "<table>";
        echo "<tr><th>Ciudades</th><th>Estadios</th></tr>";
        foreach ($estadios_futbol as $ciudad => $estadio) {
            echo "<tr>";
            echo "<td>".$ciudad."</td><td>".$estadio."</td>";
            echo "</tr>";
        }
        echo "</table>";
    ?>
</body>
</html>