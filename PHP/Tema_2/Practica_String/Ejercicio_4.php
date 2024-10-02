<?php
    if(isset($_POST["enviar"])){
    // comprobar si es solo números romanos
        function es_romano($palabra){
            for ($i=0; $i < strlen($palabra); $i++) {
                $todo_romano=true; 
                if($palabra[$i]!="M" && $palabra[$i]!="C" && $palabra[$i]!="D" && $palabra[$i]!="L" && $palabra[$i]!="V" && $palabra[$i]!="I" && $palabra[$i]!="X"){
                    $todo_romano=false;
                    break;
                }
            }
            return $todo_romano;
        }
    // Controlar que no se repita mas de 3 veces el mismo número
    function es_correcto($numero){
        $contador=0;
        for ($i=0; $i <strlen($numero)-1 ; $i++) { 
            $correcto = true;
            if($numero[$i]==$numero[$i+1]){
                $contador++;
                if($contador==4){
                    $correcto = false;
                    break;
                }
            }else {
                $contador=0;
            }
        }
        return $correcto;
    }
    // registramos los errores
    $texto = trim($_POST["texto"]);
    $texto_m = strtoupper($texto);
    $longitud_texto= strlen($texto_m);
    $error_texto=($texto_m=="" || !es_romano($texto_m) || !es_correcto($texto_m));
    $errores_form = $error_texto;
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
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
<form id="principal" action="Ejercicio_4.php" method="post">
        <h1>Romanos a árabes - Formulario</h1>
        <p>Dime un número en romano y los convertire en números árabes</p>
        <p>
            <label for="texto">Número: </label><input id="texto" name="texto" type="text" value="<?php if(isset($_POST["primera"])){echo $_POST["primera"];}?>">
            <?php
             if(isset($_POST["enviar"])&& $error_texto){
                if($texto==""){
                    echo "<span class='rojo'> Campo vacío </span>";
                } else if(!es_romano($texto_m)){
                    echo "<span class='rojo'> Debes teclear solo números romanos </span>";
                } else if(!es_correcto($texto_m)){
                    echo "<span class='rojo'> Solo se acepta hasta 3 letras iguales seguidas </span>";
                }  
                }?>
        </p>
        <button name="enviar">Convertir</button>
    </form>
    <?php
        if(isset($_POST["enviar"]) && !$errores_form){
            $array = array(
                'M' => 1000,
                'D' => 500,
                'C' => 100,
                'L' => 50,
                'X' => 10,
                'V' => 5,
                'I' => 1,
            );
        
        // Recorremos el numero
        $sumatorio=0;
        for ($i=0; $i < $longitud_texto; $i++) { 
            // Si la letra anterior es menor que la actual, resta, si es mayor suma
            if($i+1 < $longitud_texto && $array[$texto_m[$i]]<$array[$texto[$i+1]]){
                $sumatorio -= $array[$texto_m[$i]];
            }else {
                $sumatorio+=$array[$texto_m[$i]];
            }
        }

        $resultado = $sumatorio;
        echo "<div id='resultado'><h1>Romanos a árabes - Resultados</h1><p>El número romano ".$texto_m." se escribe en cifras arabes ".$resultado."</p></div>";
        }
    ?>
</body>
</html>