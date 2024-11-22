<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 15 de Arays</title>
    <style>
        table, th, td {border:1px solid black;}
        table {border-collapse:collapse;}
    </style>
</head>
<body>
    <?php
    echo "<h2> Array asociativo ordenado de menor a mayor</h2>";
    $arr["uno"]=3;
    $arr["dos"]=2;
    $arr["tres"]=123;
    $arr["cuatro"]=5;
    $arr["cinco"]=1;

    /*
    Funciones para ordenar una Array:
        *Mantienen el valor del indice*
        asort()-valor - menor a mayor
        arsort()-valor-mayor a menor
        krsort()-key-mayor a menor
        ksort()	-key-menor a mayor   

    */

    asort($arr);
    echo "<table>";
        echo "<tr><th>Key</th><th>Valor</th></tr>";
        foreach ($arr as $key => $valor) {
            echo "<tr>";
            echo "<td>".$key."</td><td>".$valor."</td>";
            echo "</tr>";
        }
        echo "</table>";
    ?>
</body>
</html>