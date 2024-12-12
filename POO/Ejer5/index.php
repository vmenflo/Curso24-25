<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    require "class_empleado.php";
    $juan = new Empleado("Juan","3500");
    echo "<p>Datos del empleado: ".$juan->getNombre()."</p>";
    
    $juan->impuesto();
    ?>
</body>
</html>