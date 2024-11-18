<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primer Login</title>
    <style>
        .en-linea{
            display:inline;
        }
        .enlace{
            color:blue;
            text-decoration: underline;
            border:none;
            background-color: white;
            cursor:pointer;
        }
    </style>
</head>
<body>
    <h1>Primer Login</h1>
    <div>
        Bienvenido  <strong><?php echo $_SESSION["usuario"] ?></storng> - <form class="en-linea" action="index.php" method="post"><button class="enlace" type="submit" name="btnCerrarSession">Cerrar sesión</button></form>
    </div>
</body>
</html>