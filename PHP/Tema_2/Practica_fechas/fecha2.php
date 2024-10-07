<?php
    if(isset($_POST["enviar"])){
        //Funcion validar fechas
        function validar($mes,$dia,$anyo){
            return checkdate($mes,$dia, $anyo);
        }
        //Comprobar errores
        $error_fecha1=!validar($_POST["mes1"],$_POST["dia1"],$_POST["anyo1"]);
        $error_fecha2=!validar($_POST["mes2"],$_POST["dia2"],$_POST["anyo2"]);
        $errores_form = $error_fecha1 || $error_fecha2;
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fechas 2</title>
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
<form id="principal" action="fecha2.php" method="post">
        <h1>Fechas - Formulario</h1>
        <p>
            <label for="fecha1">Introduzca una fecha:</label>
        </p>
        <?php
            //FECHA 1
            echo "<p id='fecha1'>";
            // dia
            echo "<label for='dia1'>Día: </label>";
            echo "<select id='dia1' name='dia1'>";
            for ($i=1; $i <=31 ; $i++) {
                if(isset($_POST["dia1"]) && $_POST["dia1"] == $i){
                    echo "<option selected  value='$i'>".sprintf('%02d',$i)."</option>";  
                }else{
                    echo "<option value='$i'>".sprintf('%02d',$i)."</option>";
                }
            }
            echo "</select>";

            // mes
            echo "<label for='mes1'>Mes: </label>";
            echo "<select name='mes1' id='mes1'>";
            $arr_meses[1]="Enero";
            $arr_meses[]="Febrero";
            $arr_meses[]="Marzo";
            $arr_meses[]="Abril";
            $arr_meses[]="Mayo";
            $arr_meses[]="Junio";
            $arr_meses[]="Julio";
            $arr_meses[]="Agosto";
            $arr_meses[]="Septiembre";
            $arr_meses[]="Octubre";
            $arr_meses[]="Noviembre";
            $arr_meses[]="Diciembre";
            for ($i=1; $i <=12 ; $i++) { 
                if(isset($_POST["mes1"]) && $_POST["mes1"]==$i){
                    echo "<option selected  value='$i'>".$arr_meses[$i]."</option>";

                }else{
                    echo "<option  value='$i'>".$arr_meses[$i]."</option>";
                }
            }
            echo "</select>";
            // Año
            echo "<label for='anyo1'>Año: </label>";
            echo "<select id='anyo1' name='anyo1'>";
            const ANYOS = 50;
            $actual = date("Y");
            for ($i=$actual-(ANYOS/2); $i <=$actual+(ANYOS/2) ; $i++) {
                if(isset($_POST["anyo1"]) && $_POST["anyo1"]==$i){
                    echo "<option selected value='$i'>".$i."</option>";
                }else{
                    echo "<option value='$i'>".$i."</option>";
                }
            }
            echo "</select>";
            if(isset($_POST["enviar"]) && !validar($_POST["mes1"], $_POST["dia1"], $_POST["anyo1"])){
                echo "<label class='rojo'> Fecha inválida</label>";
            }
            echo "</p>";
            
            //FECHA 2
            echo "<p><label> Introduzca otra fecha</label></p>";
            echo "<p id='fecha2'>";
            // dia
            echo "<label for='dia2'>Día: </label>";
            echo "<select id='dia2' name='dia2'>";
            for ($i=1; $i <=31 ; $i++) { 
                if(isset($_POST["dia2"]) && $_POST["dia2"]==$i){
                    echo "<option selected value='$i'>".sprintf('%02d',$i)."</option>";
                }else{
                    echo "<option value='$i'>".sprintf('%02d',$i)."</option>";
                }
            }
            echo "</select>";

            // mes
            echo "<label for='mes2'>Mes: </label>";
            echo "<select id='mes2' name='mes2'>";
            $arr_meses[1]="Enero";
            $arr_meses[]="Febrero";
            $arr_meses[]="Marzo";
            $arr_meses[]="Abril";
            $arr_meses[]="Mayo";
            $arr_meses[]="Junio";
            $arr_meses[]="Julio";
            $arr_meses[]="Agosto";
            $arr_meses[]="Septiembre";
            $arr_meses[]="Octubre";
            $arr_meses[]="Noviembre";
            $arr_meses[]="Diciembre";
            for ($i=1; $i <=12 ; $i++) { 
                if(isset($_POST["mes2"]) && $_POST["mes2"]==$i){
                    echo "<option selected value='$i'>".$arr_meses[$i]."</option>";
                }else{
                    echo "<option value='$i'>".$arr_meses[$i]."</option>";
                }
            }
            echo "</select>";
            // Año
            echo "<label for='anyo2'>Año: </label>";
            echo "<select id='anyo2' name='anyo2'>";
            const ANYOS = 50;
            $actual = date("Y");
            for ($i=$actual-(ANYOS/2); $i <=$actual+(ANYOS/2) ; $i++) { 
                if(isset($_POST["anyo2"]) && $_POST["anyo2"]==$i){
                    echo "<option selected value='$i'>".$i."</option>";
                }else{
                    echo "<option value='$i'>".$i."</option>";
                }
            }
            echo "</select>";
            if(isset($_POST["enviar"]) && !validar($_POST["mes2"], $_POST["dia2"], $_POST["anyo2"])){
                echo "<label class='rojo'> Fecha inválida</label>";
            }
            echo "</p>"; 
        ?>
        <button name="enviar">Calcular</button>
    </form>
    <?php

    // Verificar la diferencia entre ambas fechas

    if(isset($_POST["enviar"]) && !$errores_form){
    $fecha1 = mktime(0,0,0,$_POST["mes1"],$_POST["dia1"],$_POST["anyo1"]);
    $fecha2 = mktime(0,0,0,$_POST["mes2"],$_POST["dia2"],$_POST["anyo2"]);
    $diferencia = abs($fecha1-$fecha2);
    $resultado= $diferencia/86400;
    echo "<div id='resultado'><h1>Fechas - Respuesta</h1><p> La diferencia en días entre las dos fechas introducidas es de  ".$resultado." días. </p></div>";
    }
    ?>
</body>
</html>