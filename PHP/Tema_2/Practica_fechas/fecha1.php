<?php
    if(isset($_POST["enviar"])){

    // Comprobar que tiene el formato correcto
    function f_correcto($fecha){
        if(strlen($fecha)===10){
            if(substr($fecha,2,1)=="/" && substr($fecha,5,1)=="/"){
                return true;
            }
        }
        return false;
    }
    // registramos los errores
    $fecha1 = trim($_POST["fecha1"]);
    $fecha2 = trim($_POST["fecha2"]);
    $error_fecha1=($fecha1=="" || !f_correcto($fecha1));
    $error_fecha2=($fecha2=="" || !f_correcto($fecha2));
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
                } else if(!f_correcto($fecha1)){
                    echo "<span class='rojo'> El formato introducido no es valido, recuerda DD/MM/YYYY </span>";
                }  
                }?>
        </p>
        <p>
            <label for="fecha2">Introduzca una fecha: (DD/MM/YYYY) </label><input id="fecha2" name="fecha2" type="text" value="<?php if(isset($_POST["fecha2"])){echo $_POST["fecha2"];}?>">
            <?php
             if(isset($_POST["enviar"])&& $error_fecha2){
                if($fecha2==""){
                    echo "<span class='rojo'> Campo vacío </span>";
                } else if(!f_correcto($fecha2)){
                    echo "<span class='rojo'> El formato introducido no es valido, recuerda DD/MM/YYYY </span>";
                } 
                }?>
        </p>
        <button name="enviar">Calcular</button>
    </form>
    <?php
        if(isset($_POST["enviar"]) && !$errores_form){
            
        echo "<div id='resultado'><h1>Fechas - Respuesta</h1><p> La diferencia en días entre las dos fechas introducidas es de  "." </p></div>";
        }
    ?>
</body>
</html>