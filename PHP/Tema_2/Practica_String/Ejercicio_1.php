<?php
    if(isset($_POST["enviar"])){
        // Comprobamos errores del formulario
        // Función para comprobar si es todo letras
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
        // registramos los errores
        $palabra_primera = trim($_POST["primera"]);
        $palabra_segunda = trim($_POST["segunda"]);
        $longitud_primera= strlen($palabra_primera);
        $longitud_segunda= strlen($palabra_segunda);
        $error_primera=($palabra_primera=="" || $longitud_primera<3 || !todo_letras($palabra_primera));
        $error_segunda=($palabra_segunda=="" || $longitud_segunda<3 || !todo_letras($palabra_segunda));
        $errores_form = $error_primera||$error_segunda;

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
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
    <form id="principal" action="Ejercicio_1.php" method="post">
        <h1>Ripios - Formulario</h1>
        <p>Dime dos palabaras y te diré si riman o no</p>
        <p>
            <label for="primera">Primera palabra: </label><input id="primera" name="primera" type="text" value="<?php if(isset($_POST["primera"])){echo $_POST["primera"];}?>">
            <?php
             if(isset($_POST["enviar"])&& $error_primera){
                if($palabra_primera==""){
                    echo "<span class='rojo'> Campo vacío </span>";
                }else if($longitud_primera<3){
                    echo "<span class='rojo'> Debes teclear al menos tres letras </span>";
                } else{
                    echo "<span class='rojo'> No has tecleado solo letras </span>";
                }
                }?>
        </p>
        <p>
            <label for="segunda">Segunda palabra: </label><input id="segunda" type="text" name="segunda" value="<?php if(isset($_POST["segunda"])){echo $_POST["segunda"];}?>">
            <?php 
            if(isset($_POST["enviar"])&& $error_segunda){
                if($palabra_segunda==""){
                    echo "<span class='rojo'> Campo vacío </span>";
                }else if($longitud_segunda<3){
                    echo "<span class='rojo'> Debes teclear al menos tres letras </span>";
                } else{
                    echo "<span class='rojo'> No has tecleado solo letras </span>";
                } 
            }?>
        </p>
        <button name="enviar">Comparar</button>
    </form>
    <?php
        if(isset($_POST["enviar"]) && !$errores_form){
            $palabra_primera_m = strtoupper($palabra_primera);
            $palabra_segunda_m = strtoupper($palabra_segunda);
    ?>
        <div id="resultado">
        <h1>Ripios - Resultado</h1>
    <?php
        
        if($palabra_primera_m[$longitud_primera-1]==$palabra_segunda_m[$longitud_segunda-1] && $palabra_primera_m[$longitud_primera-2]==$palabra_segunda_m[$longitud_segunda-2] && $palabra_primera_m[$longitud_primera-3]==$palabra_segunda_m[$longitud_segunda-3]){
            echo "<p><b>".$palabra_primera."</b>"." y "."<b>".$palabra_segunda."</b> riman mucho</p>";
        }else if ($palabra_primera_m[$longitud_primera-1]==$palabra_segunda_m[$longitud_segunda-1] && $palabra_primera_m[$longitud_primera-2]==$palabra_segunda_m[$longitud_segunda-2]){
            echo "<p> <b>".$palabra_primera."</b> y <b> ".$palabra_segunda." </b> riman poco</p>";
        }else{
            echo "<p> Estas palabras <b>no</b> riman </p>";
        }

    ?>
    </div> 
    <?php
        }
    ?>
</body>
</html> 