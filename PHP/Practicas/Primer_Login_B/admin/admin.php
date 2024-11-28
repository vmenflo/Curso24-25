<?php
session_name("Primer_login_24_25_B");
session_start();
require "../src/funciones_ctes.php";

if(isset($_SESSION["usuario"])){
    try
{
    @$conexion=mysqli_connect(SERVIDOR_BD,USUARIO_BD,CLAVE_BD,NOMBRE_BD);
    mysqli_set_charset($conexion,"utf8");
}
catch(Exception $e)
{
    session_destroy();
    die(error_page("Primer Login B ","<p>No se ha podido conectar a la BD: ".$e->getMessage()."</p>"));
}
// Me he conectado y ahora hago la consulta para el baneo
try
{
    $consulta="select * from usuarios where usuario='".$_SESSION["usuario"]."' AND clave='".$_SESSION["clave"]."'";
    $result_select=mysqli_query($conexion,$consulta);
}
catch(Exception $e)
{
    mysqli_close($conexion);
    session_destroy();
    die(error_page("Primer Login","<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p>"));
}


if(mysqli_num_rows($result_select)<=0)
{
    mysqli_free_result($result_select);
    session_unset();//Me deslogueo
    $_SESSION["mensaje_seguridad"]="Usted ya no se encuentra registrado en la BD";
    header("Location:../index.php");
    exit;
}


// He pasado el control de baneo
// Dejo la conexión abierta y aprovecho para coger datos del usuario logueado

$datos_usuario_log=mysqli_fetch_assoc($result_select);
mysqli_free_result($result_select);



// Ahora controlo el tiempo de inactividad

if(time()-$_SESSION["ultm_accion"]>INACTIVIDAD*60)
{
    session_unset();//Me deslogueo
    $_SESSION["mensaje_seguridad"]="Su tiempo de sesión ha expirado. Por favor, vuelva a loguearse";
    header("Location:../index.php");
    exit;
}

$_SESSION["ultm_accion"]=time();

if($datos_usuario_log["tipo"]=="admin"){
    require "admin/admin.php";
}else{
    header("Loctation:../index.php");
}
}else{
    header("Location:../index.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primer Login B</title>
    <style>
        .enlinea{display:inline}
        .enlace{background:none;border:none;color:blue;text-decoration: underline;cursor: pointer;}
    </style>
</head>
<body>
    <h1>Primer Login B</h1>
    <div>
        Bienvenido <strong><?php echo $datos_usuario_log["usuario"];?></strong> - <form class="enlinea" action="index.php" method="post"><button class="enlace" type="submit" name="btnCerrarSession">Salir</button></form>
    </div>
    <h3>Eres Admin</h3>
</body>
</html>