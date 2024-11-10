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

//Accion borrado
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

    // Vista general
    require "vistas/vista_tabla.php";

    // Vista borrado
    if(isset($_POST["btnBorrar"])){
        require "vistas/vista_borrar.php";
    }

    ?>
</body>

</html>