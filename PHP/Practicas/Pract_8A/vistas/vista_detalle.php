<?php
echo "<h2>Detalles del Usuario: ".$_POST["id_usuario"]."</h2>";
if(isset($detalles_usuario)){
    echo "<p><strong> Nombre: </strong> ".$detalles_usuario["nombre"]."</p>";
    echo "<p><strong> Usuario: </strong> ".$detalles_usuario["usuario"]."</p>";
    echo "<p><strong> Clave: </strong> ".$detalles_usuario["clave"]."</p>";
    echo "<p><strong> Sexo: </strong> ".$detalles_usuario["sexo"]."</p>";
    echo "<p><strong> Foto: </strong> <img src='Img/".$detalles_usuario["foto"]."'></p>";
    echo "<form action='index.php' method='post'><button type='submit'> Atrás </button></form>";
    echo "</br></br></br>";
}else{
    echo "<p> El usuario no se encuentra en nuestra BD </p>";
}
?>