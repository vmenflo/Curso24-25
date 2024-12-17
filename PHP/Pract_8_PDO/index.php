<?php
session_start();
require "src/funciones_ctes.php";

try {
    $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
} catch (PDOException $e) {
    session_destroy();
    die(error_page("Práctica 8 PDO", "<p>No se ha podido conectar a la BD: " . $e->getMessage() . "</p>"));
}


//A partir de aquí tengo conexión con mi BD

if (isset($_POST["btnContBorrar"])) {
    try {
        $consulta = "delete from usuarios where id_usuario=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$_POST["btnContBorrar"]]);
        if ($_POST["foto_bd"] != NOMBRE_IMAGEN_DEFECTO_BD)
            unlink("Img/" . $_POST["foto_bd"]);

        $_SESSION["mensaje_accion"] = "Usuario borrado con éxito";
        header("Location:index.php");
        exit;
    } catch (PDOException $e) {
        $conexion = null;
        session_destroy();
        die(error_page("Práctica 8", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
    }
}


if (isset($_POST["btnDetalles"]) || isset($_POST["btnBorrar"]) || isset($_POST["btnEditar"])) {
    if (isset($_POST["btnDetalles"]))
        $id_usuario = $_POST["btnDetalles"];
    else
        $id_usuario = $_POST["id_usuario"];

    try {
        $consulta = "select * from usuarios where id_usuario=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$id_usuario]);
        $detalles_usuario=$sentencia->fetch(PDO::FETCH_ASSOC);
        $sentencia = null;
    } catch (PDOException $e) {
        $conexion = null;
        session_destroy();
        die(error_page("Práctica 8", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
    }
}

if (isset($_POST["btnContBorrarFoto"])) {
    try {
        $consulta = "update usuarios set foto=? where id_usuario=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([NOMBRE_IMAGEN_DEFECTO_BD, $_POST["btnContBorrarFoto"]]);
        unlink("Img/" . $_POST["foto_bd"]);
        $_SESSION["mensaje_accion"] = "Foto de perfil borrada con éxito";
        header("Location:index.php");
        exit;
    } catch (PDOException $e) {
        $conexion = null;
        session_destroy();
        die(error_page("Práctica 8", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
    }
}

if (isset($_POST["btnContEditar"])) {
    $error_nombre = $_POST["nombre"] == "";
    $error_usuario = $_POST["usuario"] == "";
    if (!$error_usuario) {
        $error_usuario = repetido($conexion, "usuarios", "usuario", $_POST["usuario"], "id_usuario", $_POST["btnContEditar"]);
        if (is_string($error_usuario)) {
            $conexion = null;
            session_destroy();
            die(error_page("Práctica 8", "<p>" . $error_usuario . "</p>"));
        }
    }

    $error_dni = $_POST["dni"] == "" || !dni_bien_escrito($_POST["dni"]) || ! dni_valido($_POST["dni"]);
    if (!$error_dni) {
        $error_dni = repetido($conexion, "usuarios", "dni", strtoupper($_POST["dni"]), "id_usuario", $_POST["btnContEditar"]);
        if (is_string($error_dni)) {
            $conexion = null;
            session_destroy();
            die(error_page("Práctica 8", "<p>" . $error_dni . "</p>"));
        }
    }

    $error_foto = $_FILES["foto"]["name"] != "" && ($_FILES["foto"]["error"] || !tiene_extension($_FILES["foto"]["name"]) || !getimagesize($_FILES["foto"]["tmp_name"]) ||  $_FILES["foto"]["size"] > 500 * 1024);
    $error_form_editar = $error_nombre || $error_usuario || $error_dni || $error_foto;
    if (!$error_form_editar) {
        //Si no hay errores actualizo
        //
        try {
            if ($_POST["clave"] == "") {
                $consulta = "update usuarios set nombre=?, usuario=?, dni=?, sexo=? where id_usuario=?";
                $sentencia = $conexion->prepare($consulta);
                $sentencia->execute([$_POST["nombre"], $_POST["usuario"], strtoupper($_POST["dni"]), $_POST["sexo"], $_POST["btnContEditar"]]);
            } else {
                $consulta = "update usuarios set nombre=?, usuario=?, clave=?, dni=?, sexo=? where id_usuario=?";
                $sentencia = $conexion->prepare($consulta);
                $sentencia->execute([$_POST["nombre"], $_POST["usuario"], md5($_POST["clave"]), strtoupper($_POST["dni"]), $_POST["sexo"], $_POST["btnContEditar"]]);
            }
        } catch (Exception $e) {
            $conexion = null;
            session_destroy();
            die(error_page("Práctica 8", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
        }
        $_SESSION["mensaje_accion"] = "Usuario editado con éxito";

        if ($_FILES["foto"]["name"] != "") {
            $array_nombre = explode(".", $_FILES["foto"]["name"]);
            $ext = end($array_nombre);
            $nombre_nuevo = "img_" . $_POST["btnContEditar"] . "." . $ext;
            @$var = move_uploaded_file($_FILES["foto"]["tmp_name"], "Img/" . $nombre_nuevo);
            if ($var) {
                if ($nombre_nuevo != $_POST["foto_bd"]) {
                    try {
                        $consulta = "update usuarios set foto=? where id_usuario=?";
                        $sentencia = $conexion->prepare($consulta);
                        $sentencia->execute([$nombre_nuevo, $_POST["btnContEditar"]]);;
                        if ($_POST["foto_bd"] != NOMBRE_IMAGEN_DEFECTO_BD)
                            unlink("Img/" . $_POST["foto_bd"]);
                    } catch (Exception $e) {
                        unlink("Img/" . $nombre_nuevo);
                        $_SESSION["mensaje_accion"] = "Usuario insertado con éxito, pero con la imagen por defecto.";
                    }
                }
            } else
                $_SESSION["mensaje_accion"] = "Usuario editado con éxito, pero con la imagen por defecto";
        }

        header("Location:index.php");
        exit;
    }
}





if (isset($_POST["btnContAgregar"])) {
    $error_nombre = $_POST["nombre"] == "";
    $error_usuario = $_POST["usuario"] == "";
    if (!$error_usuario) {
        $error_usuario = repetido($conexion, "usuarios", "usuario", $_POST["usuario"]);
        if (is_string($error_usuario)) {
            $conexion = null;
            session_destroy();
            die(error_page("Práctica 8", "<p>" . $error_usuario . "</p>"));
        }
    }
    $error_clave = $_POST["clave"] == "";
    $error_dni = $_POST["dni"] == "" || !dni_bien_escrito($_POST["dni"]) || ! dni_valido($_POST["dni"]);
    if (!$error_dni) {
        $error_dni = repetido($conexion, "usuarios", "dni", strtoupper($_POST["dni"]));
        if (is_string($error_dni)) {
            $conexion = null;
            session_destroy();
            die(error_page("Práctica 8", "<p>" . $error_dni . "</p>"));
        }
    }

    $error_foto = $_FILES["foto"]["name"] != "" && ($_FILES["foto"]["error"] || !tiene_extension($_FILES["foto"]["name"]) || !getimagesize($_FILES["foto"]["tmp_name"]) ||  $_FILES["foto"]["size"] > 500 * 1024);
    $error_form_agregar = $error_nombre || $error_usuario || $error_clave || $error_dni || $error_foto;
    if (!$error_form_agregar) {
        //Inserto con imagen por defecto.
        //Y si he subido foto, muevo la foto y actualizo el nombre de la foto en la BD (img_id.extension)

        try {
            $consulta = "insert into usuarios (nombre, usuario, clave, dni, sexo) values (?,?,?,?,?)";
            $sentencia = $conexion->prepare($consulta);
            $sentencia->execute([$_POST["nombre"], $_POST["usuario"], md5($_POST["clave"]), strtoupper($_POST["dni"]), $_POST["sexo"]]);
        } catch (Exception $e) {
            $conexion = null;
            session_destroy();
            die(error_page("Práctica 8", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
        }

        $_SESSION["mensaje_accion"] = "Usuario insertado con éxito.";
        if ($_FILES["foto"]["name"] != "") {
            $ultm_id = $conexion->lastInsertId();
            $array_nombre = explode(".", $_FILES["foto"]["name"]);
            $ext = end($array_nombre);
            $nombre_nuevo = "img_" . $ultm_id . "." . $ext;
            @$var = move_uploaded_file($_FILES["foto"]["tmp_name"], "Img/" . $nombre_nuevo);
            if ($var) {
                try {
                    $consulta = "update usuarios set foto=? where id_usuario=?";
                    $sentencia = $conexion->prepare($consulta);
                    $sentencia->execute([$nombre_nuevo, $ultm_id]);
                } catch (Exception $e) {
                    unlink("Img/" . $nombre_nuevo);
                    $_SESSION["mensaje_accion"] = "Usuario insertado con éxito, pero con la imagen por defecto.";
                }
            } else {
                $_SESSION["mensaje_accion"] = "Usuario insertado con éxito, pero con la imagen por defecto.";
            }
        }

        header("Location:index.php");
        exit();
    }
}


///Por último hago la consulta para listar los usuarios de la tabla principal
try {
    $consulta = "select * from usuarios";
    $sentencia = $conexion->prepare($consulta);
    $sentencia->execute(); 
} catch (Exception $e) {
    $conexion = null;
    session_destroy();
    die(error_page("Práctica 8", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
}

$conexion = null;
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 8</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black
        }

        table {
            border-collapse: collapse;
            width: 90%;
            margin: 0 auto;
            text-align: center
        }

        img {
            height: 100px
        }

        .enlace {
            background: none;
            border: none;
            color: blue;
            text-decoration: underline;
            cursor: pointer;
        }

        .mensaje {
            font-size: 1.25rem;
            color: blue
        }

        .error {
            color: red
        }
    </style>
</head>

<body>
    <h1>Práctica 8</h1>
    <?php
    if (isset($_POST["btnDetalles"]))
        require "vistas/vista_detalles.php";

    if (isset($_POST["btnBorrar"]))
        require "vistas/vista_borrar.php";

    if (isset($_POST["btnAgregar"]) || (isset($_POST["btnContAgregar"]) && $error_form_agregar))
        require "vistas/vista_agregar.php";


    if (isset($_POST["btnEditar"]) || (isset($_POST["btnContEditar"]) && $error_form_editar))
        require "vistas/vista_editar.php";

    if (isset($_POST["btnBorrarFoto"]))
        require "vistas/vista_borrar_foto.php";

    if (isset($_SESSION["mensaje_accion"])) {
        echo "<p class='mensaje'>¡¡ " . $_SESSION["mensaje_accion"] . " !!</p>";
        session_destroy();
    }

    require "vistas/vista_tabla_principal.php";
    ?>
</body>

</html>