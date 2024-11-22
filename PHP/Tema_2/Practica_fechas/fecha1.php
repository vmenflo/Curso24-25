<?php
    if(isset($_POST["enviar"])){
    // buenos_ separadores
    function buenos_separadores($texto){
        return substr($texto,2,1)=="/" && substr($texto,5,1)=="/";
    }
    //buenos_numeros
    function buenos_numeros($texto){
        return is_numeric(substr($texto,0,2)) && is_numeric(substr($texto,3,2)) && is_numeric(substr($texto,6,4));
    }
    // fecha_valida
    function fecha_valida($texto){
        return checkdate(substr($texto,3,2),substr($texto,0,2), substr($texto,6,4));
    }

    // registramos los errores
    $fecha1 = trim($_POST["fecha1"]);
    $fecha2 = trim($_POST["fecha2"]);
    $error_fecha1=($fecha1=="" || !buenos_separadores($fecha1) || !buenos_numeros($fecha1) || !fecha_valida($fecha1));
    $error_fecha2=($fecha2=="" || !buenos_separadores($fecha2) || !buenos_numeros($fecha2) || !fecha_valida($fecha2));
    $errores_form = $error_fecha1 || $error_fecha2;
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fechas 1</title>
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
<form id="principal" action="fecha1.php" method="post">
        <h1>Fechas - Formulario</h1>
        <p>
            <label for="fecha1">Introduzca una fecha: (DD/MM/YYYY) </label><input id="fecha1" name="fecha1" type="text" value="<?php if(isset($_POST["fecha1"])){echo $_POST["fecha1"];}?>">
            <?php
             if(isset($_POST["enviar"])&& $error_fecha1){
                if($fecha1==""){
                    echo "<span class='rojo'> Campo vacío </span>";
                } else if(!fecha_valida($fecha1)){
                    echo "<span class='rojo'> El formato introducido no es valido, recuerda DD/MM/YYYY </span>";
                } else if(!buenos_separadores($fecha1) && !buenos_numeros($fecha1)){
                    echo "<span class='rojo'> El formato introducido no es valido, recuerda DD/MM/YYYY </span>";
                } else if(!fecha_valida($fecha1)){
                    echo "<span class='rojo'> Esa fecha no existe </span>";
                }  
                }?>
        </p>
        <p>
            <label for="fecha2">Introduzca una fecha: (DD/MM/YYYY) </label><input id="fecha2" name="fecha2" type="text" value="<?php if(isset($_POST["fecha2"])){echo $_POST["fecha2"];}?>">
            <?php
             if(isset($_POST["enviar"])&& $error_fecha2){
                if($fecha2==""){
                    echo "<span class='rojo'> Campo vacío </span>";
                } else if(!fecha_valida($fecha2)){
                    echo "<span class='rojo'> El formato introducido no es valido, recuerda DD/MM/YYYY </span>";
                } else if(!buenos_separadores($fecha2) && !buenos_numeros($fecha2)){
                    echo "<span class='rojo'> El formato introducido no es valido, recuerda DD/MM/YYYY </span>";
                } else if(!fecha_valida($fecha2)){
                    echo "<span class='rojo'> Esa fecha no existe </span>";
                }   
                }?>
        </p>
        <button name="enviar">Calcular</button>
    </form>
    <?php

    // Verificar la diferencia entre ambas fechas

    if(isset($_POST["enviar"]) && !$errores_form){
        $arr_fecha1 = explode("/", $_POST["fecha1"]);
        $arr_fecha2 = explode("/", $_POST["fecha2"]);
        $calcular_fecha_1=mktime(0,0,0,$arr_fecha1[1],$arr_fecha1[0],$arr_fecha1[2]);
        $calcular_fecha_2=mktime(0,0,0,$arr_fecha2[1],$arr_fecha2[0],$arr_fecha2[2]);
    
        $diferencia = abs($calcular_fecha_1-$calcular_fecha_2);
        $resultado = $diferencia/86400;
    echo "<div id='resultado'><h1>Fechas - Respuesta</h1><p> La diferencia en días entre las dos fechas introducidas es de  ".$resultado." días. </p></div>";
    }
    ?>
</body>
</html>