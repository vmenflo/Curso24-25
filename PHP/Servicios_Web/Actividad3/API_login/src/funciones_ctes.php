<?php
define("SERVIDOR_BD", "localhost");
define("USUARIO_BD", "jose");
define("CLAVE_BD", "josefa");
define("NOMBRE_BD", "bd_tienda");

function login($usuario, $clave)
{
    // Conectarnos con PDO
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "No he podido conectar a la base de datos: " . $e->getMessage();
        return $respuesta; // Siempre usaremos un return porque un servicio no puede morir siempre devolverá algo
    }

    // Hacemos la consulta
    try {
        $consulta = "select * from usuarios where usuario=? AND clave=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$usuario, $clave]); // Siempre un array con tantas parametros necesite la consulta
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        $respuesta["error"] = "No he podido conectar a la base de datos: " . $e->getMessage();
        return $respuesta;
    }

    if ($sentencia->rowCount() > 0) {
        $respuesta["usuario"] = $sentencia->fetch(PDO::FETCH_ASSOC);
    } else {
        $respuesta["mensaje"] = "El usuario no se encuentra en la BD";
    }

    $sentencia = null;
    $conexion = null;
    return $respuesta; // Una vez montado el array lo devolvemos
}
