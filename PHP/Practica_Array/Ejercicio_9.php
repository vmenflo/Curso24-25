<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 9 de Arrays</title>
    <style>
        table, td, th {border:1px solid black;}
        table{border-collapse:collapse;}
    </style>
</head>
<body>
    <?php
        $lenguajes_cliente[0] ="HTML";
        $lenguajes_cliente[1] ="CSS";
        $lenguajes_servidor[0]="DOCKER";
        $lenguajes_servidor[1]="PHP";

        $lenguajes=array_merge($lenguajes_cliente,$lenguajes_servidor);

        echo "<table>";
        echo "<tr>";
        echo "<th>Lenguajes clientes</th><th>Lenguajes servidor</th>";
        for($i=0; $i< count($lenguajes_cliente);$i++){
            echo "<tr>";
            echo "<td>".$lenguajes[$i]."</td>";
            echo "<td>".$lenguajes[count($lenguajes)/2 + $i]."</td>";
            echo "</tr>";
        }
        echo "</tr>";
        echo "</table>";
    ?>
</body>
</html>