<?php
const SERVIDOR_BD = "localhost";
const USUARIO_BD = "jose";
const CLAVE_BD = "josefa";
const NOMBRE_BD = "bd_foro";

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

try {
    @$conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD);
    mysqli_set_charset($conexion, "utf8");
} catch (Exception $e) {
    die(error_page("Primer CRUD", "<p>No se ha podido conectar a la BD: " . $e->getMessage() . "</p>"));
}

// Boton editar

if (isset($_POST["btnContEditar"])) {

    //Compruebo errores
    $error_nombre = $_POST["nombre"] == "";
    $error_clave = $_POST["clave"] == "";
    $error_usuario = $_POST["usuario"] == "";
    if (!$error_usuario) {
        try {
            $consulta = "select usuario from usuarios where usuario='" . $_POST["usuario"] . "'";
            $usuario_repetido = mysqli_query($conexion, $consulta);
            $error_usuario = mysqli_num_rows($usuario_repetido) > 0;
        } catch (Exception $e) {
            mysqli_close($conexion);
            die(error_page("Primer CRUD", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
        }
    }
    $error_email = $_POST["email"] == "" || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    if (!$error_email) {
        try {
            $consulta = "select email from usuarios where email='" . $_POST["email"] . "'";
            $email_repetido = mysqli_query($conexion, $consulta);
            $error_email = mysqli_num_rows($email_repetido) > 0;
        } catch (Exception $e) {
            mysqli_close($conexion);
            die(error_page("Primer CRUD", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
        }
    }
    $error_form_editar = $error_nombre || $error_usuario || $error_clave || $error_email;
    //Si no los hay inserto en la tabla e informo de la acción
    if (!$error_form_editar) {
    }
}


// Boton agregar

if (isset($_POST["btnContAgregar"])) {

    //Compruebo errores
    $error_nombre = $_POST["nombre"] == "";
    $error_clave = $_POST["clave"] == "";
    $error_usuario = $_POST["usuario"] == "";
    if (!$error_usuario) {
        try {
            $consulta = "select usuario from usuarios where usuario='" . $_POST["usuario"] . "'";
            $usuario_repetido = mysqli_query($conexion, $consulta);
            $error_usuario = mysqli_num_rows($usuario_repetido) > 0;
        } catch (Exception $e) {
            mysqli_close($conexion);
            die(error_page("Primer CRUD", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
        }
    }
    $error_email = $_POST["email"] == "" || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    if (!$error_email) {
        try {
            $consulta = "select email from usuarios where email='" . $_POST["email"] . "'";
            $email_repetido = mysqli_query($conexion, $consulta);
            $error_email = mysqli_num_rows($email_repetido) > 0;
        } catch (Exception $e) {
            mysqli_close($conexion);
            die(error_page("Primer CRUD", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
        }
    }
    $error_form = $error_nombre || $error_usuario || $error_clave || $error_email;
    //Si no los hay inserto en la tabla e informo de la acción
    if (!$error_form) {
        //Insert BD y mensaje de accion
        try {
            $consulta = "insert into usuarios (nombre,usuario,clave,email) values('" . $_POST["nombre"] . "','" . $_POST["usuario"] . "','" . md5($_POST["clave"]) . "','" . $_POST["email"] . "')";
            $resultado_agregar = mysqli_query($conexion, $consulta);
            $mensaje_accion = "Usuario insertado con éxito";
        } catch (Exception $e) {
            mysqli_close($conexion);
            die(error_page("Primer CRUD", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
        }
    }
}


if (isset($_POST["btnDetalles"]) || isset($_POST["btnBorrar"]) || isset($_POST["btnEditar"])) {
    if (isset($_POST["btnDetalles"]))
        $id_usuario = $_POST["btnDetalles"];
    elseif (isset($_POST["btnBorrar"]))
        $id_usuario = $_POST["btnBorrar"];
    else
        $id_usuario = $_POST["btnEditar"];

    try {
        $consulta = "select * from usuarios where id_usuario='" . $id_usuario . "'";
        $detalle_usuario = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        mysqli_close($conexion);
        die(error_page("Primer CRUD", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
    }
}


if (isset($_POST["btnContBorrar"])) {
    try {
        $consulta = "delete from usuarios where id_usuario='" . $_POST["btnContBorrar"] . "'";
        mysqli_query($conexion, $consulta);
        $mensaje_accion = "Usuario borrado con éxito";
    } catch (Exception $e) {
        mysqli_close($conexion);
        die(error_page("Primer CRUD", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
    }
}


try {
    $consulta = "select * from usuarios";
    $datos_usuarios = mysqli_query($conexion, $consulta);
} catch (Exception $e) {
    mysqli_close($conexion);
    die(error_page("Primer CRUD", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
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
            border: 1px solid black
        }

        table {
            border-collapse: collapse;
            text-align: center;
        }

        .enlace {
            border: none;
            background: none;
            color: blue;
            text-decoration: underline;
            cursor: pointer
        }

        .btn_img {
            border: none;
            background: none;
            cursor: pointer
        }

        .mensaje {
            font-size: 1.25rem;
            color: blue
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <h1>Listado de los Usuarios</h1>
    <?php

    require "vistas/vista_tabla_principal.php";

    if (isset($mensaje_accion))
        echo "<p class='mensaje'>" . $mensaje_accion . "</p>";

    if (isset($_POST["btnBorrar"]))
        require "vistas/vista_borrar.php";

    if (isset($_POST["btnDetalles"]))
        require "vistas/vista_detalles.php";

    if (isset($_POST["btnAgregar"]) || (isset($_POST["btnContAgregar"]) && $error_form)) {
        require "vistas/vista_agregar.php";
    }

    if (isset($_POST["btnEditar"]) || isset($_POST["btnContEditar"]) && $error_form_editar) {
        if(isset($_POST["editar"])){
            if (mysqli_num_rows($detalle_usuario) > 0) {
                $tupla_detalles = mysqli_fetch_assoc($detalle_usuario);
                $nombre = $tupla_detalles["nombre"];
                $usuario = $tupla_detalles["usuario"];
                $email = $tupla_detalles["email"];
        }else{
            echo "<p>El usuario ya no se encuentra registrado en la BD</p>";
            mysqli_free_result($detalle_usuario);
        }
        

            echo "<h2>Editando el usuario " . $id_usuario . "</h2>";
    ?>
            <h2>Editando al usuario <?php echo $id_usuario; ?></h2>
            <form action="index.php" method="post">
                <p>
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" value="<?php echo $nombre; ?>" />
                    <?php
                    if (isset($_POST["btnContAgregar"]) && $error_nombre) {
                        echo "<span class='error' > Campo vacío </span>";
                    }
                    ?>
                </p>
                <p>
                    <label for="usuario">Usuario:</label>
                    <input type="text" name="usuario" id="usuario" value="<?php echo $usuario; ?>" />
                    <?php
                    if (isset($_POST["btnContAgregar"]) && $error_usuario) {
                        if ($_POST["usuario"] == "") {
                            echo "<span class='error' > Campo vacío </span>";
                        } else {
                            echo "<span class='error' > Usuario Repetido </span>";
                        }
                    }
                    ?>
                </p>
                <p>
                    <label for="clave">Contraseña:</label>
                    <input type="password" name="clave" id="clave" value="" placeholder="Cambiar clave" />
                    <?php
                    if (isset($_POST["btnContAgregar"]) && $error_clave) {
                        echo "<span class='error' > Campo vacío </span>";
                    }
                    ?>
                </p>
                <p>
                    <label for="email">Email:</label>
                    <input type="text" name="email" id="email" value="<?php echo $email; ?>" />
                    <?php
                    if (isset($_POST["btnContAgregar"]) && $error_email) {
                        if ($_POST["email"] == "") {
                            echo "<span class='error' > Campo vacío </span>";
                        } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                            echo "<span class='error' > Formato Erroneo </span>";
                        } else {
                            echo "<span class='error' > Email Repetido </span>";
                        }
                    }
                    ?>
                </p>
                <p>
                    <button type="submit" name="btnContEditar" value="<?php echo $id_usuario; ?>">Continuar</button>
                    <button type="submit">Atrás</button>
                </p>
            </form>

    <?php
        } else {
            echo "<p>El usuario ya no se encuentra registrado en la BD</p>";
        }
        mysqli_free_result($detalle_usuario);
    }

    ?>
</body>

</html>