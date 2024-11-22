<?php
// Array de nombres de ciudades
$usuario = "admin";
$clave = "1234";

$user = $_REQUEST["param1"];
$key = $_REQUEST["param2"];
$respuesta = "";

if($usuario==$user && $clave == $key){
    $respuesta="El usuario ".$user." es Válido";
}else{
    $respuesta="El usuario ".$user." NO es válido";
}

echo $respuesta

?>