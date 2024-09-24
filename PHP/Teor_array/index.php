<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoria de Arrays</title>
</head>
<body>
    <?php
    // forma de rellenar una array
    $nota[0]=5;
    $nota[1]=9;
    $nota[2]=5;
    $nota[3]=8;
    $nota[4]=6;
    $nota[5]=6;

    // Para saber el tamaño de la array
    echo "<p> El numero de elementos que tiene el array nota es: ".count($nota)."</p>";

    // Para mostrar un array con ol y li
    
    echo "<h2> Elementos de un array </h2>";
    echo "<ol>";
    for($i=0;$i<count($nota);$i++)
    {
        echo "<li>".$nota[$i]."</li>";
    }

    echo "</ol>";

    // Otra forma de rellenarlo
    $nota1=array(5,7,8,9,6);

    // para indicar la posicion seria así
    $nota2=array(0=>1,1=>2,"Juan"=>8);

    var_dump($nota1);
    echo "<br/>";

    var_dump($nota);
    echo "<br/>";
    print_r($nota);
    
    // Continuaria con la posicion 6 porque es la libre, incluso que una posición sea asociativa
    $nota[]=5;
    $nota[]=9;
    $nota[]=5;
    $nota["Juan"]=8;
    $nota[]=6;
    $nota[]=6;

    echo "<br/>";
    print_r($nota);

    // Para mostrar un array de este tipo usaremos un foreach
    echo "<p> Mostramos el array consecuencial y asociativo con un foreach </p>";
    echo "<ol>";
    foreach ($nota as $key => $valor) {
        echo "<li> Clave: ".$key." valor: ".$valor."</li>";
    }
    echo "</ol>";

    //Mostramos la array declarada manualmente
    echo "<p> Mostramos el array nota2 </p>";
    echo "<ul>";
    foreach ($nota2 as $key => $valor) {
        echo "<li> Clave: ".$key." valor: ".$valor."</li>";
    }
    echo "</ul>";
    // Array BIDIMENSIONAL
    echo "<p> Array bidimensional</p>";
    // En el array en la posicion Dani dentro hay otro array
    $notaDAW["Dani"]["DWESE"]=7;
    $notaDAW["Dani"]["DWECLI"]=7;
    $notaDAW["Tomas"]["DWESE"]=3;
    $notaDAW["Tomas"]["DWECLI"]=5.5;

    echo "<h1> Notas de los alumnos de segundo de DAW </h1>";
    echo "<ol>";
    foreach($notaDAW as $alumno => $asignaturas)
    {
        echo "<li>".$alumno;
        echo "<ul>";
        foreach($asignaturas as $asignatura => $note){
            echo "<li>".$asignatura.": ".$note."</li>";
        }
        echo "</ul>";
        echo "</li>";
    }
    echo "</ol>";

    ?>
</body>
</html>