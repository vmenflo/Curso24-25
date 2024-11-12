<?php
    echo "<h2>Borrado del usuario id=".$_POST["id_usuario"]." </h2>";
    echo "<p>¿Estas seguro que quieres borrar a ".$detalles_usuario["nombre"]."</p>";
    echo "<form action='index.php' method='post'><button type='submit' name='btnContBorrar' value='".$detalles_usuario["id_usuario"]."'>Continuar</button><button type='submit'>Volver</button></form>"
?>