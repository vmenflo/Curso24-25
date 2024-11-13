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
// ACCION BOTON INSERTAR
if(isset($_POST["btnContAgregar"])){
    // Errores
    $error_nombre=$_POST["nombre"]=="";
    $error_clave=$_POST["clave"]=="";
    $error_usuario=$_POST["usuario"]=="";
    if(!$error_usuario){
        $error_usuario = repetido($conexion,"usuarios","usuario",$_POST["usuario"]);
        if(is_string($error_usuario))
        {
            mysqli_close($conexion);
            session_destroy();
            die(error_page("Práctica 8","<p>".$error_usuario."</p>"));
        }
    }
    $error_dni=$_POST["dni"]=="" || !dni_bien_escrito($_POST["dni"]) || ! dni_valido($_POST["dni"]) ;
    if(!$error_dni)
    {
        $error_dni=repetido($conexion,"usuarios","dni",strtoupper($_POST["dni"]));
        if(is_string($error_dni))
        {
            mysqli_close($conexion);
            session_destroy();
            die(error_page("Práctica 8","<p>".$error_dni."</p>"));
        }
    
    }
    $error_foto = $_FILES["foto"]["name"]!="" && ($_FILES["foto"]["error"] || !tiene_extension($_FILES["foto"]["name"]) || !getimagesize($_FILES["foto"]["tmp_name"]) || $_FILES["foto"]["size"] > 500*1024);
    $error_form_agregar = $error_nombre || $error_dni || $error_usuario || $error_foto || $error_clave;

    if(!$error_form_agregar){
        // Insertamos la BD
        try{
            $consulta="insert into usuarios (nombre, usuario, clave, dni, sexo) values ('".$_POST["nombre"]."','".$_POST["usuario"]."','".md5($_POST["clave"])."','".strtoupper($_POST["dni"])."','".$_POST["sexo"]."')";
            mysqli_query($conexion,$consulta);
        }catch(Exception $e){
            mysqli_close($conexion);
            session_destroy();
            die(error_page("Practica 8", "<p>No se ha podido insertar el nuevo usuario ".$e->getMessage()."</p>"));
        }

        // Si ha llegado hasta aqui es que ha hecho la insercion
        $_SESSION["mensaje_accion"]="Usuario Insertado con éxito";

        if($_FILES["foto"]["name"]!=""){
            $ultm_id=mysqli_insert_id($conexion);
            $array_nombre=explode(".",$_FILES["foto"]["name"]);
            $ext=end($array_nombre);
            $nombre_nuevo="img_".$ultm_id.".".$ext;
            @$var=move_uploaded_file($_FILES["foto"]["tmp_name"],"Img/".$nombre_nuevo);
            if($var)
            {
                try
                {
                    $consulta="update usuarios set foto='".$nombre_nuevo."' where id_usuario='".$ultm_id."'";
                    mysqli_query($conexion,$consulta);
                }
                catch(Exception $e)
                {
                    unlink("Img/".$nombre_nuevo);
                    $_SESSION["mensaje_accion"]="Usuario insertado con éxito, pero con la imagen por defecto.";
                }
            }
            else
            {
                $_SESSION["mensaje_accion"]="Usuario insertado con éxito, pero con la imagen por defecto.";
            }
        }
 
        header("Location:index.php");
        exit;
    }
}

// ACCION CUANDO PULSAMOS CONTINUAR BORRAR
if(isset($_POST["btnContBorrar"])){
    try{
        $consulta="delete from usuarios where id_usuario='".$_POST["btnContBorrar"]."'";
        mysqli_query($conexion,$consulta);
        if($_POST["nombre_foto_bd"]!=NOMBRE_IMAGEN_DEFECTO_BD)
            unlink("Img/".$_POST["nombre_foto_bd"]);

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
if(isset($_POST["btnDetalle"]) || isset($_POST["btnBorrar"]))
{
    if(isset($_POST["btnDetalle"]))
        $id_usuario=$_POST["id_usuario"];
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
<?php
// Vista Insertar
if(isset($_POST["btnAgregar"]) || isset($_POST["btnContAgregar"])&& $error_form_agregar)
require "vistas/vista_insertar.php";

// Vista Detalles
if(isset($_POST["btnDetalle"]))
require "vistas/vista_detalle.php";
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