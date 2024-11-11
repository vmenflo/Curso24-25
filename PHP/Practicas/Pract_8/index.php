<?php
session_start();
require "src/funciones_ctes.php";

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

//Obtengo los detalles del usuario tanto al pulsar detalles cómo en el borrar cómo en Editar
if(isset($_POST["btnDetalles"]) || isset($_POST["btnBorrar"]) || isset($_POST["btnEditar"]))
{
    if(isset($_POST["btnDetalles"]))
        $id_usuario=$_POST["btnDetalles"];
    elseif(isset($_POST["btnBorrar"]))
        $id_usuario=$_POST["btnBorrar"];
    else
        $id_usuario=$_POST["btnEditar"];

    try
    {
        $consulta="select * from usuarios where id_usuario='".$id_usuario."'";
        $detalle_usuario=mysqli_query($conexion,$consulta);
    }
    catch(Exception $e)
    {
        mysqli_close($conexion);
        die(error_page("Primer CRUD","<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p>"));
    }
}

// Acción de Editar
if (isset($_POST["btnContEditar"])) {
    //Compruebo errores
    $error_nombre = $_POST["nombre"] == "";
    $error_usuario = $_POST["usuario"] == "";
    if (!$error_usuario) {
        $error_usuario = repetido($conexion, "usuarios", "usuario", $_POST["usuario"]);
        if (is_string($error_usuario)) {
            mysqli_close($conexion);
            die(error_page("Primer CRUD", "<p>" . $error_usuario . "</p>"));
        }

    }
    $error_clave = $_POST["clave"] == "";
    $numeroDNI = substr($_POST["dni"], 0, -1); // Extraer los números 
    $letraDNI = strtoupper(substr($_POST["dni"], -1));     // Extraer la letra 
    $error_dni = $_POST["dni"] == "" || LetraNIF($numeroDNI) != substr($letraDNI, -1);
    $error_sexo = !isset($_POST["sexo"]);
    $error_foto = $_FILES["foto"]["name"] != "" && ($_FILES["foto"]["error"] || !tiene_extension($_FILES["foto"]["name"]) || !getimagesize($_FILES["foto"]["tmp_name"]) || $_FILES["foto"]["size"] > 500 * 1024);

    $error_form_editar = $error_nombre || $error_usuario || $error_clave || $error_dni || $error_sexo || $error_foto;

    //Si no hay errores inserto en la tabla e informo de la acción
    if (!$error_formulario_editar) {
        try {
            // Actualizar datos del usuario sin la foto inicialmente
            if ($_POST["clave"] == "") {
                $consulta = "UPDATE usuarios SET 
                    nombre='" . $_POST["nombre"] . "',
                    usuario='" . $_POST["usuario"] . "',
                    dni='" . $_POST["dni"] . "',
                    sexo='" . $_POST["sexo"] . "'
                    WHERE id_usuario='" . $_POST["id_usuario"] . "'";
            } else {
                $consulta = "UPDATE usuarios SET 
                    nombre='" . $_POST["nombre"] . "',
                    usuario='" . $_POST["usuario"] . "',
                    clave='" . md5($_POST["clave"]) . "',
                    dni='" . $_POST["dni"] . "',
                    sexo='" . $_POST["sexo"] . "'
                    WHERE id_usuario='" . $_POST["id_usuario"] . "'";
            }
            mysqli_query($conexion, $consulta);

            // Procesar la imagen si se ha subido una nueva
            if ($_FILES["foto"]["name"] != "") {
                // Obtener la extensión del archivo
                $extension = tiene_extension($_FILES["foto"]["name"]);

                // Generar un nombre único para la imagen usando el id_usuario
                $nombre_foto = "img_" . $_POST["id_usuario"] . "." . $extension;

                // Mover la imagen al directorio Img/
                if (move_uploaded_file($_FILES["foto"]["tmp_name"], "Img/" . $nombre_foto)) {
                    // Actualizar el campo foto en la base de datos
                    $consulta = "UPDATE usuarios SET foto='" . $nombre_foto . "' WHERE id_usuario='" . $_POST["id_usuario"] . "'";
                    mysqli_query($conexion, $consulta);

                    // Eliminar la imagen antigua si no es 'no_imagen.jpg'
                    if ($_POST["foto_bd"] != 'no_imagen.jpg') {
                        unlink("Img/" . $_POST["foto_bd"]);
                    }
                } else {
                    echo "<p>No se pudo mover la imagen al directorio destino.</p>";
                }
            }

            $_SESSION["mensaje_accion"] = "Usuario editado con éxito";
            header("Location:index.php");
            exit;
        } catch (Exception $e) {
            mysqli_close($conexion);
            die(error_page("Primer CRUD", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
        }
    }
}
// Accion borrado
if(isset($_POST["btnContBorrar"])){
    try {
        $consulta = "delete from usuarios where id_usuario=".$_POST["btnContBorrar"]."";
        $datos_usuarios = mysqli_query($conexion, $consulta);
        $_SESSION["mensaje_accion"]="Usuario borrado con éxito";
        header("Location:index.php");
        exit;
    } catch (Exception $e) {
        mysqli_close($conexion);
        die(error_page("Primer CRUD", "<p>No se ha podido realizar la consulta: " . $e->getMessage() . "</p>"));
    }
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
            width:80%;
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
    <h2>Listado de los usuarios</h2>

    <?php
    //Mensaje de éxito
    if(isset($_SESSION["mensaje_accion"]))
    {
        echo "<p class='mensaje'>".$_SESSION["mensaje_accion"]."</p>";
        //unset($_SESSION["mensaje_accion"]);
        //session_unset();
        session_destroy();
    }

    // Agregar nuevo usuario
    if(isset($_POST["btnAgregar"]) || (isset($_POST["btnContAgregar"]) && $error_form_agregar)){
        require "vistas/vista_agregar.php";
    }

    if(isset($_POST["btnDetalles"])){
        require "vistas/vista_detalle.php";
    }

    // editar un usuario
    if(isset($_POST["btnEditar"]) || (isset($_POST["btnContEditar"])&& $error_form_editar)){
        require "vistas/vista_editar.php";
    }

    // Vista general
    require "vistas/vista_tabla.php";

    // Vista borrado
    if(isset($_POST["btnBorrar"])){
        require "vistas/vista_borrar.php";
    }

    ?>
</body>

</html>