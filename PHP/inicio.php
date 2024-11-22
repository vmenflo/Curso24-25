<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=p, initial-scale=1.0">
    <title>Primera web PHP</title>
</head>
<body>
    <?php
    // Declarar variables ($)
        $texto1="Víctor";
        $texto2="María";
        $a=5;
        $b=2;
        echo "<h1> Mi primera web </h1>";
        echo "<p>HOLA! " .$texto1 ." y " .$texto2 ."</p>";
        echo "<p> El resultado de sumar" .$a ." y " .$b ." es " .($a+$b)."</p>";

    // Se usa isset para comprobar que la variable esta inicializada
    // se puede añadir alguna condición como && 5==5||7>=8
        if(isset($p)){
            $c=$p+$a;
        } else{
            $c=$a;
        }
        echo "<p>".$c."</p>";
    //Ejemplo de switch
    switch ($a) {
        case $a<1:
            # code...
            break;
        case $a<2:
            # code...
            break;
        default:
            # code...
            break;
    }

    if($a+$b>10)
        echo "<p> La suma de a + b es mayor que 10 </p>";
    else
        echo "<p> La suma de a+b NO es mayor que 10 </p>";

    // Ejemplos de bucles
    // for 

    for($i=0;$i<5;$i++){
        echo "<p>".$i."</p>";
    }

    // Ejemplo Bucle While
    $i=0;
    while ($i < 5) {
        echo "<p>".$i."</p>";
        $i++;
    }
    ?>
</body>
</html>