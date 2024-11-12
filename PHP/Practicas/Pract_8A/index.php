<?php
// iniciar sesion
session_start();
// recoger las funciones y constantes
require "src/funciones.php";

//Hacer la conexion a la base de datos
try{
    @$conexion = mysqli_connect(SERVIDOR_BD,USUARIO_BD,CLAVE_BD,NOMBRE_BD);
    mysqli_set_charset($conexion,"utf8");
}catch(Exception $e){
    die(error_page("Práctica 8A", "<p> No se ha podido acceder a la Base de datos".$e->getMessage()."</p>"));
}

// ACCION CUANDO PULSAMOS CONTINUAR BORRAR
if(isset($_POST["btnContBorrar"])){
    try{
        $consulta="delete from usuarios where id_usuario='".$_POST["btnContBorrar"]."'";
        mysqli_query($conexion,$consulta);
        $_SESSION["mensaje_accion"]="Usuario borrado con éxito";
        header("Location:index.php");
        exit;
    }catch(Exception $e){
        mysqli_close($conexion);
        session_destroy();
        die(error_page("Práctica 8","<p>No se ha podido realizar el borrado: ".$e->getMessage()."</p>"));
    }
}

// HACEMOS CONSULTA DE LOS DATOS PARA RELLENAR EN BORRAR Y DETALLES
if(isset($_POST["btnDetalles"]) || isset($_POST["btnBorrar"]))
{
    if(isset($_POST["btnDetalles"]))
        $id_usuario=$_POST["btnDetalles"];
    else
        $id_usuario=$_POST["id_usuario"];

    try
    {
        $consulta="select * from usuarios where id_usuario='".$id_usuario."'";
        $result_detalle_usuario=mysqli_query($conexion,$consulta);
        $detalles_usuario=mysqli_fetch_assoc($result_detalle_usuario);
        mysqli_free_result($result_detalle_usuario);
    }
    catch(Exception $e)
    {
        mysqli_close($conexion);
        session_destroy();
        die(error_page("Práctica 8","<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p>"));
    }
}

//OBTENEMOS LOS DATOS DE LA BD PARA LA TABLA PRINCIPAL
try{
    $consulta = "select * from usuarios";
    $datos_usuario = mysqli_query($conexion,$consulta);
}catch(Exception $e){
    mysqli_close($conexion);
    session_destroy();
    die(error_page("Práctica 8A", "<p> No se ha podido realizar la consulta a la Base de datos".$e->getMessage()."</p>"));
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 8</title>
    <style>
        img{
            width:4rem;
        }
        table{
            border-collapse:collapse;
            width:90%;
            text-align:center;
        }
        td,table,tr,th{
            border:1px solid black;
            padding:1rem;
        }
        .enlace{
            cursor: pointer;
            color:blue;
            border:none;
            background:none;
            text-decoration:underline;
            
        }
    </style>
</head>
<body>
<h1>Práctica 8</h1>
<h2>Listado de los Usuarios</h2>
<?php
//  Vista Borrado
if(isset($_POST["btnBorrar"]))
require "vistas/vista_borrar.php";
// Mensaje de éxito
if(isset($_SESSION["mensaje_accion"]))
{
    echo "<p class='mensaje'>¡¡ ".$_SESSION["mensaje_accion"]." !!</p>";
    session_destroy();
}
// Vista principal
require "vistas/vista_tabla.php";
?>
</body>
</html>