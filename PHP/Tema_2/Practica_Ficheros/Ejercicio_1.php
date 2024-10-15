<?php
if(isset($_POST["Enviar"])){
    // Comprobamos los errores
    $error_vacio = $_POST["numero"]=="";
    $error_entre = $_POST["numero"]>=1 || $_POST["numero"]<=10;
    $error_letra = !is_numeric($_POST["numero"]);
    $error_numero = $error_vacio || $error_entre || $error_letra;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>
<body>
    <h1>Ejercicio 1</h1>
    <form action="Ejercicio_1.php" method="post">
        <label for="numero">Elija un número entre el 1 y el 10</label>
        <input type="text" name="numero" id="numero">
        <?php
            if(isset($_POST["Enviar"]) && $error_vacio){
                echo "<span> *Campo vacío * </span>";
            }elseif (isset($_POST["Enviar"]) && !$error_entre) {
                echo "<span> *Error: el número debe estar entre 1 y 10 (incluidos) * </span>";
            }
        ?>
        </br>
        <input type="button" value="Enviar">
    </form>
</body>
</html>