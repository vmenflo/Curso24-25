<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practicar para el examen</title>
</head>
<body>
    <h2>Vista normal</h2>
    <p>Bienvenido <?php echo $_SESSION["usuario"] ?>
        <form action="index.php" method="post">
            <button type="submit" name="btnSalir">Salir</button>
        </form>
    </p>
    <?php 
        require "vistas/vista_detalle_normal.php"
    ?>
</body>
</html>