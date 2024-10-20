<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejer1</title>
</head>
<body>
    <?php
        function mi_strlen($texto){
            $cont=0;
            while (isset($texto[$cont])) {
                $cont++;
            }
            return $cont;
        }
    ?>
    <form action="Ejer1.php" method="post">
        <label for="texto">Contador de caracteres</label>
        <input type="text" placeholder="Introduce la palabra" name="texto" id="texto" value="<?php if(isset($_POST["texto"])){echo $_POST["texto"];}?>">
        <button type="submit" name="enviar">Contar</button>
    </form>
    <?php
        if(isset($_POST["enviar"])){
            $cantidad = mi_strlen($_POST["texto"]);
            echo "<p> La palabra tiene: ".$cantidad." </p>";
        }
    ?>
</body>
</html>