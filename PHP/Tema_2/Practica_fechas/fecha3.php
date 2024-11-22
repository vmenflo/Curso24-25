<?php
    if(isset($_POST["enviar"])){
        //Funcion validar fechas
        function validar($mes,$dia,$anyo){
            return checkdate($mes,$dia, $anyo);
        }
        //Comprobar errores
        $error_fecha1=$_POST["fecha1"]=="";
        $error_fecha2=$_POST["fecha2"]=="";
        $errores_form = $error_fecha1 || $error_fecha2;
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fechas 3</title>
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
<form id="principal" action="fecha3.php" method="post">
        <h1>Fechas - Formulario</h1>
        <?php
            //FECHA 1
            echo "<p><label for='fecha1'> Introduzca una fecha</label>";
            echo "<input name='fecha1' type='date'>";
            if(isset($_POST["enviar"]) && $_POST["fecha1"]==""){
                echo "<label class='rojo'> *Campo Vacío </label>";
            }
            echo "</p>";
            
            //FECHA 2
            echo "<p><label> Introduzca otra fecha</label>";
            echo "<input name='fecha2' type='date'>";
            if(isset($_POST["enviar"]) && $_POST["fecha1"]==""){
                echo "<label class='rojo'> *Campo Vacío </label>";
            }
            echo "</p>";
        ?>
        <button name="enviar">Calcular</button>
    </form>
    <?php

    // Verificar la diferencia entre ambas fechas

    if(isset($_POST["enviar"]) && !$errores_form){
    $fecha1= $_POST["fecha1"];
    $fecha2= $_POST["fecha2"];
    $diferencia = abs(strtotime($fecha1)-strtotime($fecha2));
    $resultado = $diferencia/86400;
    echo "<div id='resultado'><h1>Fechas - Respuesta</h1><p> La diferencia en días entre las dos fechas introducidas es de  ".$resultado." días. </p></div>";
    }
    ?>
</body>
</html>