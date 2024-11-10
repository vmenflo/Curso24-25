<?php
// Tabla del listado de usuarios
    echo "<table>";
    echo "<tr>";
    echo "<th>#</th>";
    echo "<th>Foto</th>";
    echo "<th>Nombre</th>";
    echo "<th><form action='index.php' method='post' > <button type='submit' class='btn_img' name='btnAgregar'>Usuario+</button></form></th>";
    echo "</tr>";
    while ($tupla = mysqli_fetch_assoc($datos_usuarios)) {
        echo "<tr>";
        echo "<td>" . $tupla["id_usuario"] . "</td>";
        echo "<td><img src='Img/" . $tupla["foto"] . "'></td>";
        echo "<td><form action='index.php' method='post'><button class='btn_img' name='btnDetalles' value='".$tupla["id_usuario"]."' type='submit'>" . $tupla["nombre"] . "</button></form></td>";
        echo "<td><form action='index.php' method='post'><button class='btn_img' name='btnBorrar' value='".$tupla["id_usuario"]."' type='submit'>Borrar</button> - <button class='btn_img' name='btnEditar' value='".$tupla["id_usuario"]."' type='submit'>Editar</button> </form></td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>