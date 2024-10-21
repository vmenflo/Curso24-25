<?php
function extension($texto){
    $ext = explode(".", $texto);
    if(end($ext) === "txt"){
        return end($ext);
    }else{
        return false;
    }
}
    if(isset($_POST["enviar"])){
        // Controlar los errores
        $error_fichero = !extension($_FILES["fichero"]["name"]) || $_FILES["fichero"]["size"]> 1*1024*1024|| $_FILES["fichero"]["error"];
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
</head>
<body>
    <h2>Ejercicio 2</h2>
    <form action="Ejer2.php" method="post" enctype="multipart/form-data">
        <label for="fichero">Elija un archivo de texto (.txt) no superior a 1MB</label>
        <input type="file" name="fichero" id="fichero">
        <?php
            if(isset($_POST["enviar"]) && $error_fichero){
                if($_FILES["fichero"]["name"]===""){
                    echo "<span> Debes de subir un archivo</span>";
                }elseif($_FILES["fichero"]["error"]){
                    echo "<span>No se ha subido el archivo seleccionado </span>"; 
                }elseif(!extension($_FILES["fichero"]["name"])){
                    echo "<span> Debes de subir un archivo txt </span>";
                }else{
                    echo "<span> El archivo supera 1MB</span>";
                }
            }
        ?>
        <p><button type="submit" name="enviar">Subir</button></p>
    </form>
    <?php
        if(isset($_POST["enviar"])&& !$error_fichero){
            $numero_unico=md5(uniqid(uniqid(),true));
            $extension = extension($_FILES["fichero"]["name"]);
            $nombre= $numero_unico.".".$extension;

            @$var = move_uploaded_file($_FILES["fichero"]["tmp_name"],"Ficheros/".$nombre);

            // Controlar los errores
            if(!$var){
                echo "<p> No se ha podido mover el archivo </p>";
            }else{
                echo "<p>El archivo ".$_FILES["fichero"]["name"]." se ha movido a Ficheros</p>";
            }
        }
    ?>
</body>
</html>