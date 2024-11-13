<?php
echo "<h2>Listado de los Usuarios</h2>";
echo "<table>";
echo "<tr>";
echo "<th>#</th>";
echo "<th>Foto</th>";
echo "<th>Nombre</th>";
echo "<th><form action='index.php' method='post'><button class='enlace' type='submit' name='btnAgregar'>+Usuarios</button></form></th>";
echo "</tr>";
while($tupla = mysqli_fetch_assoc($datos_usuario)){
    echo "<tr>";
    echo "<td>".$tupla["id_usuario"]."</td>";
    echo "<td><img src='Img/".$tupla["foto"]."'></td>";
    echo "<td><form action='index.php' method='post'><input name='id_usuario' type='hidden' value='".$tupla["id_usuario"]."'/><button class='enlace' type='submit' name='btnDetalle'>".$tupla["nombre"]."</button></form></td>";
    echo "<td><form action='index.php' method='post'><input name='id_usuario' type='hidden' value='".$tupla["id_usuario"]."'/><button class='enlace' type='submit' name='btnBorrar'>Borrar</button> - <button class='enlace' type='submit' name='btnEditar'>Editar</button></form></td>";
    echo "</tr>";
}
echo "</table>"

?>