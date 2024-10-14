<?php
            echo "<h1>Recogida de datos</h1>";
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
?>