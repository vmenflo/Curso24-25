<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoria subir Ficheros</title>
</head>
<body>
    <h1>Teoría subir ficheros</h1>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="foto">Seleccione un archivo imagen (Máx 500KB): </label>
            <input type="file" name="foto" id="foto" accept="image/*">
        </p>
        <p>
            <button type="submit" name="btnEnviar">Enviar</button>
        </p>
    </form>
    <?php
    // Cuando enviamos un file se genera una variable nueva $_FILES
    if(isset($_FILES["foto"])){
        if(!$_FILES["foto"]["error"]){
            echo "Se ha subido con éxito un archivo";
        }else{
            echo "No se ha subido con éxito el archivo";
        }
    }

?>
</body>
</html>