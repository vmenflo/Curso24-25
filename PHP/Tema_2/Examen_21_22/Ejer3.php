<?php
function comprobar_texto($texto){
    $palabra_limpia = str_replace([",",".","-"," "],"", strtolower($texto));
    for ($i=0; $i < strlen($palabra_limpia) ; $i++) { 
        if (ord($palabra_limpia[$i]) < ord('a') || ord($palabra_limpia[$i]) > ord('z')) {
            return false;
        }
    }
    return true;
}
if(isset($_POST["enviar"])){
    $error_form = !comprobar_texto($_POST["texto"]) || $_POST["texto"]==="";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
</head>
<body>
    <h2>Ejercicio 3</h2>
    <form action="Ejer3.php" method="post">
        <p>
            <label for="texto">Introduce las palabras separadas por , . o - </label>
            <input type="text" name="texto" id="texto">
            <?php
                if(isset($_POST["enviar"]) && $error_form){
                    if($_POST["texto"]===""){
                        echo "<span> Cadena vacía</span>";
                    }else{
                        echo "<span> Solo se admite letras y los separadores indicados </span>";
                    }
                }
            ?>
        </p>
        <p>¿Qué has usado para separarlas?</p>
        <select name="separador" id="separador">
            <option value=",">Coma (,)</option>
            <option value=".">punto (.)</option>
            <option value="-">guion (-)</option>
        </select>
        <p><button type="submit" name="enviar">Contar</button></p>
    </form>
    <?php
        if(isset($_POST["enviar"]) && !$error_form){
            $frase = trim(str_replace(" ", "", $_POST["texto"]));
            $palabras = explode($_POST["separador"],$frase);
            $contador = count($palabras);
            echo "<p> Has introducido ".$contador." palabras</p>";
        }
    ?>
</body>
</html>