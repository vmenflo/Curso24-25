<?php
session_start();

// Datos para conectarnos a la base de datos
const SERVIDOR_BD = "localhost";
const USUARIO_BD = "jose";
const CLAVE_BD = "josefa";
const NOMBRE_BD = "bd_cv";

function error_page($title, $body)
{
    return '<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>' . $title . '</title>
    </head>
    <body>' . $body . '</body></html>';
}

// Nos conectamos a la BD
try {
    @$conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
    mysqli_set_charset($conexion, "utf8");
} catch (Exception $e) {
    die(error_page("Pŕactica 8", "<p>No se ha podido conectar a la BD: " . $e->getMessage() . "</p>"));
}



///Por último hago la consulta para listar los usuarios de la tabla principal
try {
    $consulta = "select * from usuarios";
    $datos_usuarios = mysqli_query($conexion, $consulta);
} catch (Exception $e) {
    mysqli_close($conexion);
    die(error_page("Primer CRUD", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
}

// Cerramos la BD
mysqli_close($conexion);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 8</title>
    <style>
        td,
        th,
        table {
            border: 1px solid black;
            padding: 0.5rem;
        }

        table {
            border-collapse: collapse;
            text-align: center;
        }

        .btn_img {
            border: none;
            background: none;
            cursor: pointer;
            color: blue;
            text-decoration: underline;
        }

        img {
            width: 4.5rem;
        }
    </style>
</head>

<body>
    <h1>Práctica 8</h1>
    <p>Listado de los usuarios</p>

    <?php
    // Tabla del listado de usuarios
    echo "<table>";
    echo "<tr>";
    echo "<th>#</th>";
    echo "<th>Foto</th>";
    echo "<th>Nombre</th>";
    echo "<th><form action='index.php' method='post' > <button type='submit' class='btn_img' name='ntonAgregar'>Usuario+</button></form></th>";
    echo "</tr>";
    while ($tupla = mysqli_fetch_assoc($datos_usuarios)) {
        echo "<tr>";
        echo "<td>" . $tupla["id_usuario"] . "</td>";
        echo "<td><img src='Img/" . $tupla["foto"] . "'></td>";
        echo "<td><form action='index.php' method='post'><button class='btn_img' name='btnDetalles' value='' type='submit'>" . $tupla["nombre"] . "</button></form></td>";
        echo "<td><form action='index.php' method='post'><button class='btn_img' name='btnBorrar' value='' type='submit'>Borrar</button> - <button class='btn_img' name='btnEditar' value='' type='submit'>Editar</button> </form></td>";
        echo "</tr>";
    }
    echo "</table>";
    ?>
</body>

</html>