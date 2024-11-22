<?php
            echo "<h1>Recogida de datos</h1>";
            echo "<p>Nombre: ".$_POST["nombre"]."</p>";
            echo "<p>Apellidos: ".$_POST["apellidos"]."</p>";
            echo "<p>Contraseña: ".$_POST["contrasenia"]."</p>";
            echo "<p>DNI: ".$_POST["dni"]."</p>";
            echo "<p>Sexo: ".$_POST["sexo"]."</p>";
            echo "<p>Nacimiento: ".$_POST["nacimiento"]."</p>";
            echo "<p>Comentario: ".$_POST["comentarios"]."</p>";
            if(isset($_POST["subcribir"])){
                echo "<p>Quiere subcribirse</p>";
            }else{
                echo "No quiere subcribirse";
            }     
            
            // Verifica si se ha subido un archivo de imagen
            if ($_FILES["foto"]["name"] != "") {
                // Genera un nombre único para la imagen
                $numero_unico = md5(uniqid(uniqid(), true));
                $ext = tiene_extension($_FILES["foto"]["name"]); 
                $nombre_imagen = "img_" . $numero_unico . "." . $ext;

                // Mueve la imagen desde el archivo temporal a la carpeta images
                if (move_uploaded_file($_FILES["foto"]["tmp_name"], "images/" . $nombre_imagen)) {
                    // Si se mueve correctamente, muestra la imagen
                    echo "<p><strong>Imagen subida:</strong></p>";
                    echo "<p><b> Nombre: </b>".$_FILES["foto"]["name"]."</p>";
                    echo "<p><img src='images/" . $nombre_imagen . "' alt='imagen subida' title='Imagen subida'></p>";
                } else {
                    echo "<p>Error al mover la imagen.</p>";
                }
            } else {
                echo "<p>No se ha subido ninguna imagen.</p>";
            }
?>