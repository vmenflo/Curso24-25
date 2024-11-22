<?php
    if(isset($_POST["enviar"])){
        // comprobar si hay numeros
        function numeros($palabra){
            $numeros=false;
            for ($i=0; $i < strlen($palabra); $i++) {
                    if(ctype_digit($palabra[$i])){
                        $numeros=true;
                        break;
                    }
                }
            return $numeros;
        }

        // registramos los errores
        $texto = $_POST["texto"];
        $error_texto=($texto=="" || numeros($texto));
        $errores_form = $error_texto;

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6</title>
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
    <form id="principal" action="Ejercicio_6.php" method="post">
        <h1>Quita Acentos - Formulario</h1>
        <p>Escribe un texto y quitaré los acentos</p>
        <p>
            <label for="texto">Texto: </label><textarea id="texto" name="texto" type="text">
                <?php if(isset($_POST["texto"])){echo $_POST["texto"];}?>
            </textarea>
            <?php
             if(isset($_POST["enviar"])&& $error_texto){
                if($texto==""){
                    echo "<span class='rojo'> Campo vacío </span>";
                }else if(numeros($texto)){
                    echo "<span class='rojo'> Debes teclear letras </span>";
                }  
                }?>
        </p>
        <button name="enviar">Comparar</button>
    </form>
    <?php
        if(isset($_POST["enviar"]) && !$errores_form){
            $array = array(
                'á' => 'a',
                'é' => 'e',
                'í' => 'i',
                'ó' => 'o',
                'ú' => 'u',
                'à' => 'a',
                'è' => 'e',
                'ì' => 'i',
                'ò' => 'o',
                'ù' => 'u',
                'ä' => 'a',
                'ë' => 'e',
                'ï' => 'i',
                'ö' => 'o',
                'ü' => 'u',
                'Á' => 'A',
                'É' => 'E',
                'Í' => 'I',
                'Ó' => 'O',
                'Ú' => 'U',
                'À' => 'A',
                'È' => 'E',
                'Ì' => 'I',
                'Ò' => 'O',
                'Ù' => 'U',
                'Ä' => 'A',
                'Ë' => 'E',
                'Ï' => 'I',
                'Ö' => 'O',
                'Ü' => 'U'
            );

        $resultado = strtr($texto, $array);

        echo "<div id='resultado'><h1>Quita Acentos - Resultados</h1> <p>Texto original: ".$texto."</p><p> Texto si acentos: " . $resultado . "</p></div>";
        }
    ?>
</body>
</html> 