<h2>Listado de los libros</h2>
<div class="contenedor_libros">
<?php
while($tupla=$sentencia->fetch(PDO::FETCH_ASSOC))
{
    echo "<div>";
    echo "<img src='Images/".$tupla["portada"]."' alt='Portada' title='Portada'/><br/>";
    echo $tupla["titulo"]." - ".$tupla["precio"]."€";
    echo "</div>";
}
$sentencia=null;
?>
</div>