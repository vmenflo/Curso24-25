<?php
    if(isset($_POST["enviar"])){
        // Comprobamos errores del formulario
        $error_primera=($_POST["primera"]=="" || strlen($_POST["primera"])<4);
        $error_segunda=($_POST["segunda"]=="" || strlen($_POST["segunda"])<4);
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
            <label for="primera">Primera palabra: </label><input id="primera" name="primera" type="text">
            <?php if(isset($_POST["enviar"])&& $error_primera){echo "<span class='rojo'> Recuerde minimo 3 letras </span>";}?>
        </p>
        <p>
            <label for="segunda">Segunda palabra: </label><input id="segunda" type="text" name="segunda">
            <?php if(isset($_POST["enviar"])&& $error_segunda){echo "<span class='rojo'> Recuerde minimo 3 letras </span>";}?>
        </p>
        <button name="enviar">Comparar</button>
    </form>
    <?php
        if(isset($_POST["enviar"]) && !$errores_form){
        $palabra_primera = $_POST["primera"];
        $palabra_segunda = $_POST["segunda"];
    ?>
        <div id="resultado">
        <h1>Ripios - Resultado</h1>
        <p></p>
    </div> 
    <?php
        }
    ?>
</body>
</html>