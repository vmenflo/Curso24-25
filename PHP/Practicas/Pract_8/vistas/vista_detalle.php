<?php
echo "<h2>Detalles del usuario ".$_POST["btnDetalles"]."</h2>";
if(mysqli_num_rows($detalle_usuario)>0)
{
    $tupla = mysqli_fetch_assoc($detalle_usuario);
    echo "<p>Nombre: ".$tupla["nombre"]."</p>";
    echo "<p>Usuario: ".$tupla["usuario"]."</p>";
    echo "<p>sexo: ".$tupla["sexo"]."</p>";
    echo "<p>Foto:</p> <img src='Img/". $tupla["foto"]."'>";
}
else
{
    echo "<p>El usuario ya no se encuentra registrado en la BD</p>";
}
mysqli_free_result($detalle_usuario);
?>