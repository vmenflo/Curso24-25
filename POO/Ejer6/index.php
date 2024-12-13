<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    require "class_menu.php";
        $menu = new Menu();
        $menu->cargar("Htttps/:", "Marca");
        $menu->cargar("Htttps/:", "Sport");
        $menu->cargar("Htttps/:", "Deportivo");
        $menu->cargar("Htttps/:", "Mundo Deportivo");
        $menu->vertical();
        $menu->horizontal();
    ?>
</body>
</html>