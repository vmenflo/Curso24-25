<?php
const SERVIDOR_BD = "localhost";
const USUARIO_BD = "jose";
const CLAVE_BD = "josefa";
const NOMBRE_BD = "bd_foro";

function error_page($title, $body)
{
    return '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>' . $title . '</title>
                </head>
                <body>' . $body . '</body>
                </html>';
}

// Hacemos conexión
try {
    @$conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
    mysqli_set_charset($conexion, "utf8");
} catch (Exception $e) {
    die(error_page("Primer_CRUD", "<p> No se ha podido conectar a la BD: " . $e->getMessage() . "</p>"));
}

if (isset($_POST["btnDetalles"])) {
    try {
        $consulta = "select * from usuarios where id_usuario='" . $_POST["btnDetalles"] . "'"; // sentencia de búsqueda
        $detalle_usuario = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        mysqli_close($conexion); // No olvidemos de cerrar
        die(error_page("Primer_CRUD", "<p> No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
    }
}

if (isset($_POST["btnBorrar"])) {
    try {
        $consulta = "select * from usuarios where id_usuario='" . $_POST["btnBorrar"] . "'"; // sentencia de búsqueda
        $detalle_borrar = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        mysqli_close($conexion); // No olvidemos de cerrar
        die(error_page("Primer_CRUD", "<p> No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
    }
}

if (isset($_POST["btnContinuar"])) {
    try {
        @$conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
        mysqli_set_charset($conexion, "utf8");
    } catch (Exception $e) {
        die(error_page("Primer_CRUD", "<p> No se ha podido conectar a la BD: " . $e->getMessage() . "</p>"));
    }

    $consulta = "DELETE FROM usuarios WHERE id_usuario=".$_POST["btnContinuar"];
    $datos_usuarios = mysqli_query($conexion, $consulta);

    mysqli_close($conexion);
}

// Realizamos la consulta
try {
    $consulta = "select * from usuarios"; // sentencia de búsqueda
    $datos_usuarios = mysqli_query($conexion, $consulta);
} catch (Exception $e) {
    mysqli_close($conexion); // No olvidemos de cerrar
    die(error_page("Primer_CRUD", "<p> No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
}


mysqli_close($conexion);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primer CRUD</title>
    <style>
        table,
        td,
        th {
            border: 1px solid black;
        }

        table {
            border-collapse: collapse;
            text-align: center;
        }

        img {
            width: 50px;
        }

        .enlace {
            border: none;
            background: none;
            color: blue;
            text-decoration: underline;
            cursor: pointer;
        }

        .btn_img {
            border: none;
            background: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h1>Listado de los Usuarios</h1>
    <?php

    echo "<table>";
    echo "<tr>";
    echo "<th>Nombre de Usuario</th>";
    echo "<th>Borrar</th>";
    echo "<th>Editar</th>";
    echo "</tr>";
    while ($tupla = mysqli_fetch_assoc($datos_usuarios)) {
        echo "<tr>";
        echo "<td><form action='index.php' method='post'><button title='Ver Detalles' class='enlace' type='submit' name='btnDetalles' value='" . $tupla["id_usuario"] . "'>" . $tupla["nombre"] . "</button></td>";
        echo "<td><form action='index.php' method='post'><button class='btn_img' type='submit' name='btnBorrar' title='Borrar' value='" . $tupla["id_usuario"] . "'><img src='images/borrar.png'></button></form></td>";
        echo "<td><img src='images/editar.jpg'></td>";
        echo "</tr>";
    }
    echo "</table>";
    mysqli_free_result($datos_usuarios);

    if (isset($_POST["btnDetalles"])) {
        if (mysqli_num_rows($detalle_usuario) > 0) {
            echo "<h2>Detalles del usuario " . $_POST["btnDetalles"] . "</h2>";
            $tupla_detalles =  mysqli_fetch_assoc($detalle_usuario);
            echo "<p>";
            echo "<strong>Nombre: </strong>" . $tupla_detalles["nombre"] . "<br/>";
            echo "<strong>Usuario: </strong>" . $tupla_detalles["usuario"] . "<br/>";
            echo "<strong>Clave: </strong><br/>";
            echo "<strong>Email: </strong>" . $tupla_detalles["email"] . "<br/>";
            echo "</p>";
        } else {
            echo "<p> El Usuario ya no se encuentra registrado en la Base de Datos</p>";
        }
        mysqli_free_result($detalle_usuario);
    }

    if (isset($_POST["btnBorrar"])) {
        $tupla_borrar =  mysqli_fetch_assoc($detalle_borrar);
        echo "<p> Se dispone usted a borrar: " . $tupla_borrar["nombre"] . " </p>";
        echo "<form action='index.php' method='post'>";
        echo "<button type='submit' name='btnContinuar' value='".$tupla_borrar['id_usuario']."'>Continuar</button>";
        echo "<button type='submit' name='btnAtras'>Atrás</button>";
        echo "</form>";
    }

    ?>
</body>

</html>