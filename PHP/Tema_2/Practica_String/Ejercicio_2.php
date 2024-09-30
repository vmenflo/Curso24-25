<?php
    if(isset($_POST["enviar"])){
        // comprobar si es solo letras
        function todo_letras($palabra){
            for ($i=0; $i < strlen($palabra); $i++) {
                $todo_l=true; 
                if(ord($palabra[$i])<ord("A") || ord($palabra[$i])>ord("z")){
                    $todo_l=false;
                    break;
                }
            }
            return $todo_l;
        }

        // comprobar si es solo numeros
        function todo_numeros($palabra){
            for ($i=0; $i < strlen($palabra); $i++) {
                if(!ctype_digit($palabra[$i])){
                    return false;
                }
            }
            return true;
        }
        // registramos los errores
        $texto = trim($_POST["texto"]);
        $longitud_texto= strlen($texto);
        $error_texto=($texto=="" || $longitud_texto<3 || (!todo_letras($texto) && !todo_numeros($texto)));
        $errores_form = $error_texto;

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
    <style>
        body{
            background-color:#F2D7B6;
        }
        #principal{
            border:2px black solid;
            background-color:#D8EDF2;
            padding:1rem;
            margin-bottom:0.5rem;
        }
        #resultado{
            border:2px black solid;
            background-color:#D6F2D5;
            padding:1rem;
        }
        h1{text-align:center;}

        .rojo{color:red;}
    </style>
</head>
<body>
    <form id="principal" action="Ejercicio_2.php" method="post">
        <h1>Palíndromos / Capicúas - Formulario</h1>
        <p>Dime una palabra o un número y te diré si es polindromo o un número capicúo</p>
        <p>
            <label for="texto">Primera palabra: </label><input id="texto" name="texto" type="text" value="<?php if(isset($_POST["primera"])){echo $_POST["primera"];}?>">
            <?php
             if(isset($_POST["enviar"])&& $error_texto){
                if($texto==""){
                    echo "<span class='rojo'> Campo vacío </span>";
                }else if($longitud_texto<3){
                    echo "<span class='rojo'> Debes teclear al menos tres caracteres </span>";
                } else{
                    echo "<span class='rojo'> Debes teclear o letras o números </span>";
                } 
                }?>
        </p>
        <button name="enviar">Comparar</button>
    </form>
    <?php
        if(isset($_POST["enviar"]) && !$errores_form){
        $texto_m = strtoupper($texto);

        $es_capicua = true;
        for ($i = 0; $i < $longitud_texto / 2; $i++) {
            if ($texto_m[$i] != $texto_m[$longitud_texto - $i - 1]) {
            $es_capicua = false;
            break;
            }
        }

        $resultado = "";
        if (todo_letras($texto) && $es_capicua) {
            $resultado = "<p>$texto es un palíndromo</p>";
        } else if (todo_letras($texto) && !$es_capicua) {
            $resultado = "<p>$texto NO es un palíndromo</p>";
        } else if (todo_numeros($texto) && $es_capicua) {
            $resultado = "<p>$texto es capicúa</p>";
        } else {
            $resultado = "<p>$texto NO es capicúa</p>";
        }

        echo "<div id='resultado'><h1>Palíndromos / Capicúas - Resultados</h1>" . $resultado . "</div>";
        }
    ?>
</body>
</html> 