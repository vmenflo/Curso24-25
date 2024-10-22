<?php 
    // Funcion explode:
    function mi_explode($separador, $frase)
{
    $aux = [];
    $i = 0;
    $l_frase = strlen($frase);
    
    // Saltar separadores al principio
    while ($i < $l_frase && $frase[$i] == $separador)
        $i++;

    if ($i < $l_frase) {
        $j = 0;
        $aux[$j] = $frase[$i];  // Primer carácter
        
        for ($i = $i + 1; $i < $l_frase; $i++) {
            if ($frase[$i] != $separador) {
                $aux[$j] .= $frase[$i];  // Concatenar carácter actual
            } else {
                // Saltar separadores consecutivos
                while ($i < $l_frase && $frase[$i] == $separador)
                    $i++;

                // Si aún hay caracteres, comenzar nueva cadena
                if ($i < $l_frase) {
                    $j++;
                    $aux[$j] = $frase[$i];
                }
            }
        }
    }

    return $aux;
}

function contar_palarbas($array) {
    $contador = 0;
    $indice = 0;
    $vocales = ['a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U'];  // Array de vocales

    while (isset($array[$indice])) {
        $contiene_vocal = false;

        // Verificar cada carácter de la palabra para ver si contiene una vocal
        for ($i = 0; $i < strlen($array[$indice]); $i++) {
            if (in_array($array[$indice][$i], $vocales)) {
                $contiene_vocal = true;
                break;  // Si encontramos una vocal, salimos del bucle
            }
        }

        // Solo contar si la palabra no contiene vocales
        if (!$contiene_vocal) {
            $contador++;
        }

        $indice++;  // Avanzar al siguiente elemento
    }
    
    return $contador;
}



    if(isset($_POST["enviar"])){
        $error_form = $_POST["texto"]==="";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
</head>
<body>
    <h1>Ejercicio 2</h1>
    <form action="Ejer2.php" method="post" enctype="multipart/form-data">
    <p>
        <label for="texto">Introduzca un texto: </label>
        <input type="text" name="texto" id="texto">
        <?php
            if(isset($_POST["enviar"]) && $error_form){
                echo "<span> *Campo vacío* </span>";
            }
        ?>
    </p>
    <p>
        <label for="separador">Elija el separador</label>
        <select name="separador" id="separador">
            <option <?php if(isset($_POST["enviar"]) && $_POST["separador"] ===","){echo "selected";}?> value=",">coma</option>
            <option <?php if(isset($_POST["enviar"]) && $_POST["separador"] ===";"){echo "selected";}?>  value=";">punto y coma</option>
            <option <?php if(isset($_POST["enviar"]) && $_POST["separador"] ===":"){echo "selected";}?>  value=":">dos puntos</option>
            <option <?php if(isset($_POST["enviar"]) && $_POST["separador"] ===" "){echo "selected";}?>  value=" ">(espacio)</option>
            <option <?php if(isset($_POST["enviar"]) && $_POST["separador"] ==="."){echo "selected";}?>  value=".">punto</option>
        </select>
    </p>
    <p>
        <button type="submit" name="enviar" >Enviar</button>
    </p>
    </form>
    <?php
        if(isset($_POST["enviar"])&& !$error_form){
            $palabras = mi_explode($_POST["separador"],$_POST["texto"]);
            $recuento =contar_palarbas($palabras);
            echo "<p> El texto ".$_POST["texto"]." con el separador ".$_POST["separador"]." contiene ".$recuento." palabras.</p>";
        }
    ?>
</body>
</html>