<?php
if(isset($_POST["Enviar"])){
    // Comprobamos los errores
    $error_vacio_1 = $_POST["numero1"]=="";
    $error_entre_1 = $_POST["numero1"]<1 || $_POST["numero1"]>10;
    $error_numero_1 = $error_vacio_1 || $error_entre_1;

    $error_vacio_2 = $_POST["numero2"]=="";
    $error_entre_2 = $_POST["numero2"]<1 || $_POST["numero2"]>10;
    $error_numero_2 = $error_vacio_2 || $error_entre_2;

    $error_form = $error_numero_1 || $error_numero_2;
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
    <h1>Ejercicio 3</h1>
    <form action="Ejercicio_3.php" method="post">
        <label for="numero1">Elija qué archivo deseas abrir del 1 al 10: </label>
        <input type="text" name="numero1" id="numero1">
        <?php
            if(isset($_POST["Enviar"]) && $error_vacio_1){
                echo "<span> * Campo vacío * </span>";
            } elseif (isset($_POST["Enviar"]) && $error_entre_1) {
                echo "<span> * Error: el número debe estar entre 1 y 10 (incluidos) * </span>";
            }
        ?>
        </br>
        <label for="numero2">Elija que linea desea de la tabla de multiplicar (1-10): </label>
        <input type="text" name="numero2" id="numero2">
        <?php
            if(isset($_POST["Enviar"]) && $error_vacio_2){
                echo "<span> * Campo vacío * </span>";
            } elseif (isset($_POST["Enviar"]) && $error_entre_2) {
                echo "<span> * Error: el número debe estar entre 1 y 10 (incluidos) * </span>";
            }
        ?>
        </br>
        </br>
        <button type="submit" name="Enviar">Crear</button>
    </form>
    <?php 
        if(isset($_POST["Enviar"]) && !$error_form){ // Si existe la enseña
            $ruta = "./Tablas/tabla_" . $_POST["numero1"] . ".txt";
            @$file = fopen($ruta, "r");
            if($file){
                $indice = $_POST["numero2"]-0;
                for ($i=0; $i <= $indice; $i++) { 
                    $linea = fgets($file);
                    if($i===$indice){
                        echo "<p> El número ".$_POST["numero2"]." en la tabla del ".$_POST["numero1"]." corresponde con : ".$linea."</p>";
                        fseek($file,0);
                        break;
                    }elseif($linea===false){
                        echo "<p> No existe esa línea </p>";
                    }
                }
                 
               fclose($file); // Siempre cerramos
            } else { // Sino indica de que no existe
                echo "<p> El fichero que has introducido (tabla_".$_POST["numero1"].".txt) NO existe. </p>";
            }
        }
    ?>
</body>
</html>
