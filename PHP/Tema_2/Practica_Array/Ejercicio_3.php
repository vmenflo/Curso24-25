<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3 de Arrays</title>
</head>
<body>
    <?php
        $pelis["enero"]=9;
        $pelis["febrero"]=12;
        $pelis["marzo"]=0;
        $pelis["abril"]=17;
        $pelis["mayo"]=9;
        $pelis["junio"]=12;
        $pelis["julio"]=0;
        $pelis["agosto"]=17;
        $pelis["septiembre"]=9;
        $pelis["octubre"]=12;
        $pelis["noviembre"]=0;
        $pelis["diciembre"]=17;
        echo "<h1> Peliculas que he visto por mes: </h1>";
        foreach ($pelis as $mes => $peli) 
            if($peli!=0)
                echo "<p> En el mes ".$mes." se ha visto ".$peli." peliculas. </p>";
    ?>
</body>
</html>