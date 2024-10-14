<?php
// Index donde subir el archivo es requerido
// Vamos a cotrolar 3 cosas: tamaño, extension y es archivo imagen 

//Función para comprobar la extensión

function tiene_extension($texto){
    $array_nombre = explode(".",$texto);
    if(count($array_nombre)<=1){
        $respuesta = false; // si no tiene devuelve falso
    }else{
        $respuesta = end($array_nombre); // si tiene devuelve la extension
    }

    return $respuesta;
}

if(isset($_POST["btnEnviar"])){

    $error_foto = $_FILES["foto"]["error"] || !tiene_extension($_FILES["foto"]["name"]) || !getimagesize($_FILES["foto"]["tmp_name"]) || $_FILES["foto"]["size"] > 500*1024;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoria subir Fichero *REQUERIDO*</title>
    <style>
        .error{color:red;}
        p img{height:200px;}
    </style>
</head>
<body>
    <h1>Teoría subir ficheros *Requerido*</h1>
    <form action="index_req.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="foto">Seleccione un archivo imagen con extensión (Máx 500KB): </label>
            <input type="file" name="foto" id="foto" accept="image/*">
            <?php
                if(isset($_POST["btnEnviar"]) && $error_foto){
                    if($_FILES["foto"]["name"]==""){
                        echo "<span class='error'> * Debes seleccionar un fichero * </span>";
                    }elseif($_FILES["foto"]["error"]){
                        echo "<span class='error'> * No se ha subido el archivo seleccionado al servidor * </span>";
                    }elseif(!tiene_extension($_FILES["foto"]["name"])){
                        echo "<span class='error'> * Has seleccinado un fichero sin extensión * </span>";
                    }elseif(!getimagesize($_FILES["foto"]["tmp_name"])){
                        echo "<span class='error'> * No has seleccionado un archivo imagen * </span>";
                    }else{
                        echo "<span class='error'> * El fichero seleccionado es mayor a 500 KB * </span>";
                    }
                }
            ?>
        </p>
        <p>
            <button type="submit" name="btnEnviar">Enviar</button>
        </p>
    </form>
    <?php
    // Vamos a almacenar está información
    if(isset($_POST["btnEnviar"]) && !$error_foto){
        $numero_unico=md5(uniqid(uniqid(),true));
        $ext = tiene_extension($_FILES["foto"]["name"]);
        $nombre_imagen = "img_".$numero_unico.".".$ext;
        echo "<h1> Información de la imagen subida</h1>";
        // movemos el archivo del temporal name a nuestra carpeta images
        // El @ evita que no salga el warning para asi controlarlos nosotros
        @$var = move_uploaded_file($_FILES["foto"]["tmp_name"], "images/".$nombre_imagen);

        if(!$var){
            echo "<p> No se ha podido mover la imagen a la carpeta destino en el servidor </p>";
        }else {
            echo "<p><strong>Nombre Original: </strong>".$_FILES["foto"]["name"]."</p>";
            echo "<p><strong>Tipo: </strong>".$_FILES["foto"]["type"]."</p>";
            echo "<p><strong>Archivo subido temporalmente en: </strong>".$_FILES["foto"]["tmp_name"]."</p>";
            echo "<p><img src='images/".$nombre_imagen."' alt='imagen subida' title='Imagen'></p>";
        }
    }

?>
</body>
</html>