<?php
// Inserto y salgo con mensaje
$url = DIR_SERV . "/login";
$datos["usuario"] = $SESSION["usuario"];
$datos["clave"] = md5($SESSION["clave"]);
$respuesta = consumir_servicios_REST($url, "POST", $datos);
$json_login = json_decode($respuesta, true);
if (!$json_login) {
    session_destroy();
    die(error_page("Login","<p> Error consumiendo servicio web <strong>" . $url . "</strong></p>"));
}

if (isset($json_login["error"])) {
    session_destroy();
    die(error_page("Login","<p>".$json_login["error"]."</p>"));
}

if (isset($json_login["mensaje"])) {
    session_unset();
    $SESSION["mensaje_seguridad"]="";
    header("Location:index.php");
    exit;
}


// He pasado el control de baneo
// Dejo la conexión abierta y aprovecho para coger datos del usuario logueado

$datos_usuario_log=$json_login["usuario"];

// Ahora controlo el tiempo de inactividad

if(time()-$_SESSION["ultm_accion"]>INACTIVIDAD*60)
{
    session_unset();//Me deslogueo
    $_SESSION["mensaje_seguridad"]="Su tiempo de sesión ha expirado. Por favor, vuelva a loguearse";
    header("Location:index.php");
    exit;
}

$_SESSION["ultm_accion"]=time();


?>