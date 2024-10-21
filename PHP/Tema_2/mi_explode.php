<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi explode</title>
</head>

<body>
    <?php function mi_explode($separador, $frase)
    {
        $aux = [];
        $i = 0;
        $l_frase = strlen($frase);
        while ($i < $l_frase && $frase[$i] == $separador)  //Lee separadores hasta que termina
            $i++;

        if ($i < $l_frase) {
            $j = 0;
            $aux[$j] = $frase[$i];
            for ($i = $i + 1; $i < $l_frase; $i++) {
                if ($frase[$i] != $separador) {
                    $aux[$j] .= $frase;
                } else {
                    while ($i < $l_frase && $frase[$i] == $separador)
                        $i++;

                    if ($i < $l_frase) {
                        $j++;
                        $aux[$j] = $frase[$i];
                    }
                }
            }
        }

        return $aux;
    }

    $texto = "hola,, ,,adios";
    $arr = mi_explode(",", $texto);
    echo "<p>" . count($arr) . "</p>";


    ?>
</body>

</html>