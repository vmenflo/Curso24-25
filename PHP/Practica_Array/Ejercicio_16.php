<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 16 de Arrays</title>
</head>
<body>
    <?php
        echo "<h2> Ejercicio 16 </h2>";
        $arr["5"]=1;
        $arr["12"]=2;
        $arr["13"]=56;
        $arr["x"]=42;

        print_r($arr);
        echo "<p> La Array tiene ".count($arr)." elementos.</p>";
        echo "<p> Elimnamos el valor 5</p>";
        unset($arr["5"]);
        print_r($arr);
        echo "<p> La Array tiene ".count($arr)." elementos.</p>";
        echo "<p> Eliminamos el array con unset </p>";
        unset($arr);

    ?>
</body>
</html>