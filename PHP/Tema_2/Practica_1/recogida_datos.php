<?php
    if(!isset($_POST["enviar"])){
        header("Location:index.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recogida de datos</title>
</head>
<body>
    <h1>Recogida de datos realizada</h1>
    <?php
        if(isset($_POST["enviar"]))
        {
            echo "<p>Nombre: ".$_POST["nombre"]."</p>";
            echo "<p>Apellidos: ".$_POST["apellidos"]."</p>";
            echo "<p>Contraseña: ".$_POST["contrasenia"]."</p>";
            echo "<p>DNI: ".$_POST["dni"]."</p>";
            if(isset($_POST["sexo"])){
                echo "<p>Sexo: ".$_POST["sexo"]."</p>";
            }else{
                echo "N/S";
            }
            echo "<p>Nacimiento: ".$_POST["nacimiento"]."</p>";
            echo "<p>Comentario: ".$_POST["comentarios"]."</p>";
            if(isset($_POST["subcribir"])){
                echo "<p>Quiere subcribirse</p>";
            }else{
                echo "No quiere subcribirse";
            }
        }
    ?>
</body>
</html>