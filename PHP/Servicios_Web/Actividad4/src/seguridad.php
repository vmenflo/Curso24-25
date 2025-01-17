<?php
// Inserto y salgo con mensaje
$url = DIR_SERV . "/login";
$datos[] =$_SESSION["usuario"];
$datos[] = $_SESSION["clave"];
echo "<p>".$datos[0]."".$datos[1]."</p>";
$respuesta = consumir_servicios_REST($url, "POST", $datos);
$json_login = json_decode($respuesta, true);
if (!$json_login) {
    session_destroy();
    die("<p> Error consumiendo servicio web <strong>" . $url . "</strong></p></body></html>");
}

if (isset($json_login["error"])) {
    session_destroy();
    die(error_page("Actividad4", "<p>Error consumiendo el servicio rest: " . $url . "</p>"));
}

if (isset($json_login["mensaje"])) {
    session_destroy();
    die(error_page("Actividad4", "<p>" . $json_login["mensaje"] . "</p>"));
}

$_SESSION["usuario"] = $json_login["usuario"];
$_SESSION["clave"] = $json_login["clave"];
$_SESSION["ultm_accion"] = time();
header("Location:index.php");
exit;


// He pasado el control de baneo
// Dejo la conexión abierta y aprovecho para coger datos del usuario logueado

$datos_usuario_log=mysqli_fetch_assoc($result_select);
mysqli_free_result($result_select);



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