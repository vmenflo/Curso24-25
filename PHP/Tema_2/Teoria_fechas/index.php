<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoria de fechas en PHP</title>
</head>
<body>
    <h1>Teoría de fechas</h1>
    <?php
    // Función fundamental para trabajar con fechas, time dará los segundos que han pasado desde enero de 1970
    
    echo "<p>".time()."</p>";
    
    // Así le damos forma a la fecha (23/12/19)
    $fecha=date("y/m/d", 1702944000);
    echo $fecha;
    echo "</br>";
    $fecha=date("y-m-d H:i:s", 1702944000);
    echo $fecha;
    echo "</br>";

    $fechaActual = date("y-m-d H:i:s", time());
    echo "<p> La hora actual es: ".$fechaActual." <p>";

    // checkdate(dia,mes,anyo) - >Saber si una fecha es válida
    if(checkdate("2",29,2004)){
        echo "<p> La fecha existe</p>";
    }else{
        echo "<p> La fecha no existe</p>";
    }

    // mktime(hora,minuto,segundo,mes,dia,año) -> Cuantos segundo pasaron desde 1970 hasta esa fecha
    echo "<p>".mktime(0,0,0,4,27,2004)."</p>"; 
    echo "<p>".date("d/m/y",1083016800)."</p>";

    // Stringtotime - tiene que ser con ese formato (mes, día, /anyo) || (anyo, mes, día)
    echo "<p>".strtotime("2004/04/27")."<p>";

    // 3 funciones matematicas
    // Obtener el valor absoluto

    echo "<p> Valor absoluto de -8: ".abs(-8)."</p>";
    echo "<p> Valor absoluto de 9.67: ".floor(9.67)."</p>";
    echo "<p> Valor absoluto de 9.67: ".ceil(9.67)."</p>";

    ?>
</body>
</html>