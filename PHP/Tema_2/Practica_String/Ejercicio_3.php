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
        /*
        Forma en el caso que no me dejará usar srt_replace
        function quitar_espacios($texto){
        $cadena="";
            for(){
                if($texto[$i]!=" "){
                    $cadena.=$texto[$i];
                }
            }
            return $cadena;
        }
        */

        // registramos los errores
        $texto = trim($_POST["texto"]);
        $texto_m = strtoupper($texto);
        $texto_limpio = str_replace(" ", "", $texto_m);
        $longitud_texto= strlen($texto_limpio);
        $error_texto=($texto=="" || $longitud_texto<3 || !todo_letras($texto_limpio));
        $errores_form = $error_texto;

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
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
    <form id="principal" action="Ejercicio_3.php" method="post">
        <h1>Frases Palindromas- Formulario</h1>
        <p>Dime una frase y te diré si es polindroma</p>
        <p>
            <label for="primera">Frase: </label><input id="texto" name="texto" type="text" value="<?php if(isset($_POST["primera"])){echo $_POST["primera"];}?>">
            <?php
             if(isset($_POST["enviar"])&& $error_texto){
                if($texto==""){
                    echo "<span class='rojo'> Campo vacío </span>";
                }else if($longitud_texto<3){
                    echo "<span class='rojo'> Debes teclear al menos tres caracteres </span>";
                } else{
                    echo "<span class='rojo'> Debes teclear letras</span>";
                } 
                }?>
        </p>
        <button name="enviar">Comparar</button>
    </form>
    <?php
        if(isset($_POST["enviar"]) && !$errores_form){

        $es_capicua = true;
        for ($i = 0; $i < $longitud_texto / 2; $i++) {
            if ($texto_limpio[$i] != $texto_limpio[$longitud_texto - $i - 1]) {
            $es_capicua = false;
            break;
            }
        }

        $resultado = "";
        if ($es_capicua) {
            $resultado = "<p>$texto es una frase palíndromo</p>";
        } else {
            $resultado = "<p>$texto NO es una frase palíndromo</p>";
        } 

        echo "<div id='resultado'><h1>Frases palindromas- Resultados</h1>" . $resultado . "</div>";
        }
    ?>
</body>
</html> 