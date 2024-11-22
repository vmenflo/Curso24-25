<?php
    if(isset($_POST["enviar"])){
    // Controlar que es un número
    function es_numero($palabra){
        for ($i=0; $i < strlen($palabra); $i++) {
            if(!is_numeric($palabra[$i])){
                return false;
            }
        }
        return true;
    }
    // registramos los errores
    $texto = trim($_POST["texto"]);
    $error_texto=($texto=="" || $texto > 4999 || !es_numero($texto));
    $errores_form = $error_texto;
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5</title>
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
<form id="principal" action="Ejercicio_5.php" method="post">
        <h1>Árabes a romanos - Formulario</h1>
        <p>Dime un número y los convertire en números romano</p>
        <p>
            <label for="texto">Número: </label><input id="texto" name="texto" type="text" value="<?php if(isset($_POST["primera"])){echo $_POST["primera"];}?>">
            <?php
             if(isset($_POST["enviar"])&& $error_texto){
                if($texto==""){
                    echo "<span class='rojo'> Campo vacío </span>";
                } else if(!es_numero($texto)){
                    echo "<span class='rojo'> Debes teclear solo números </span>";
                }else if($texto>4999){
                    echo "<span class='rojo'> No puede expresarse números tan grandes en Romano </span>";
                }    
                }?>
        </p>
        <button name="enviar">Convertir</button>
    </form>
    <?php
        if(isset($_POST["enviar"]) && !$errores_form){
            $array = array(
                1000 => 'M',
                 900 => 'CM',
                 500 => 'D',
                 400 => 'CD',
                 100 => 'C',
                 90 => 'XC',
                 50 => 'L',
                 40 => 'XL',
                 10 => 'X',
                  9 => 'IX',
                  5 => 'V',
                  4 => 'IV',
                  1 => 'I',
            );
        
        // Recorremos el numero
        $arabe = $texto;
        $romano="";
        while ($texto > 0) {
            if($texto>=1000){
                $texto-=1000;
                $romano.= $array[1000];
            }else if($texto>=900){
                $texto-=900;
                $romano.= $array[900];
            }else if($texto>=500){
                $texto-=500;
                $romano.= $array[500];
            }else if($texto>=400){
                $texto-=400;
                $romano.= $array[400];
            }else if($texto>=100){
                $texto-=100;
                $romano.= $array[100];
            }else if($texto>=90){
                $texto-=90;
                $romano.= $array[90];
            }else if($texto>=50){
                $texto-=50;
                $romano.= $array[50];
            }else if($texto>=40){
                $texto-=40;
                $romano.= $array[40];
            }else if($texto>=10){
                $texto-=10;
                $romano.= $array[10];
            }else if($texto>=9){
                $texto-=9;
                $romano.= $array[9];
            }else if($texto>=5){
                $texto-=5;
                $romano.= $array[5];
            }else if($texto>=4){
                $texto-=4;
                $romano.= $array[4];
            }else if($texto>=1){
                $texto-=1;
                $romano.= $array[1];
            }
        }

        echo "<div id='resultado'><h1>Árabes a romanos - Resultados</h1><p> El número ".$arabe." Se escribe en números romanos ".$romano." </p></div>";
        }
    ?>
</body>
</html>