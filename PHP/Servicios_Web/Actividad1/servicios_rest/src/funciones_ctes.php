<?php
define("SERVIDOR_BD", "localhost");
define("USUARIO_BD", "jose");
define("CLAVE_BD", "josefa");
define("NOMBRE_BD", "bd_tienda");

function obtener_productos()
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
        $consulta = "select * from producto";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute(); // Siempre un array con tantas parametros necesite la consulta
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        $respuesta["error"] = "No he podido conectar a la base de datos: " . $e->getMessage();
        return $respuesta;
    }
    // Recogemos la respuesta de la consulta
    $respuesta["productos"]=$sentencia->fetchAll(PDO::FETCH_ASSOC);
    $sentencia = null;
    $conexion = null;
    return $respuesta; // Una vez montado el array lo devolvemos
}

function obtener_producto($cod)
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
        $consulta = "select * from producto where cod=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$cod]); // Siempre un array con tantas parametros necesite la consulta
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        $respuesta["error"] = "No he podido conectar a la base de datos: " . $e->getMessage();
        return $respuesta;
    }
    // Recogemos la respuesta de la consulta

    if($sentencia->rowCount()<=0){
        return $respuesta["mensaje"]="El producto con el código: ".$cod." no se encuentra en la BD";
    }else{
        $respuesta["productos"]=$sentencia->fetchAll(PDO::FETCH_ASSOC);
        $sentencia = null;
        $conexion = null;
        return $respuesta; // Una vez montado el array lo devolvemos
    }
   
}

function insertar_producto($cod,$nombre,$nombre_corto,$descripcion,$pvp,$familia){
    // Conectarnos con PDO
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "No he podido conectar a la base de datos: " . $e->getMessage();
        return $respuesta; // Siempre usaremos un return porque un servicio no puede morir siempre devolverá algo
    }
    // Hacemos la insercción
    try {
        $consulta = "insert into producto (cod,nombre, nombre_corto,descripcion, pvp, familia) values (?,?,?,?,?,?)";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$cod,$nombre,$nombre_corto,$descripcion,$pvp,$familia]); // Siempre un array con tantas parametros necesite la consulta
        $respuesta["mensaje"]="El producto ".$nombre_corto." se ha insertado con éxito";
        $sentencia = null;
        $conexion = null;
        return $respuesta;
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        $respuesta["error"] = "No se ha podido realizar la insercción: " . $e->getMessage();
        return $respuesta;
    }

}

function actualizar_producto($cod,$nombre,$nombre_corto,$descripcion,$pvp,$familia){
    // Conectarnos con PDO
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "No he podido conectar a la base de datos: " . $e->getMessage();
        return $respuesta; // Siempre usaremos un return porque un servicio no puede morir siempre devolverá algo
    }

    // Hacemos la actualización del producto enconcreto
    try {
        $consulta = "update producto set nombre=?, nombre_corto=?,descripcion=?, pvp=?, familia=? where cod=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$nombre,$nombre_corto,$descripcion,$pvp,$familia,$cod]); // Siempre un array con tantas parametros necesite la consulta
        $respuesta["mensaje"]="El producto ".$nombre_corto." se ha actualizado con éxito";
        $sentencia = null;
        $conexion = null;
        return $respuesta;
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        $respuesta["error"] = "No se ha podido realizar la actualización: " . $e->getMessage();
        return $respuesta;
    }
}

// BORRADO

function borrar_producto($cod){
    // Conectarnos con PDO
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "No he podido conectar a la base de datos: " . $e->getMessage();
        return $respuesta; // Siempre usaremos un return porque un servicio no puede morir siempre devolverá algo
    }

    // Hacemos la actualización del producto enconcreto
    try {
        $consulta = "delete from producto where cod=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$cod]); // Siempre un array con tantas parametros necesite la consulta
        $respuesta["mensaje"]="El producto ".$cod." se ha borrado con éxito";
        $sentencia = null;
        $conexion = null;
        return $respuesta;
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        $respuesta["error"] = "No se ha podido realizar el borrado: " . $e->getMessage();
        return $respuesta;
    }
}

function obtener_familias(){
    // Conectarnos con PDO
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "No he podido conectar a la base de datos: " . $e->getMessage();
        return $respuesta; // Siempre usaremos un return porque un servicio no puede morir siempre devolverá algo
    }

    // Hacemos la actualización del producto enconcreto
    try {
        $consulta = "select * from familia";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute(); // Siempre un array con tantas parametros necesite la consulta
       
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        $respuesta["error"] = "No se ha podido realizar la consulta: " . $e->getMessage();
        return $respuesta;
    }
    // Recogemos la respuesta de la consulta
    $respuesta["familia"]=$sentencia->fetchAll(PDO::FETCH_ASSOC);
    $sentencia = null;
    $conexion = null;
    return $respuesta; // Una vez montado el array lo devolvemos
}

function es_repetido($tabla,$columna,$valor){
    // Conectarnos con PDO
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "No he podido conectar a la base de datos: " . $e->getMessage();
        return $respuesta; // Siempre usaremos un return porque un servicio no puede morir siempre devolverá algo
    }

    // Hacemos la actualización del producto enconcreto
    try {
        $consulta = "select * from ".$tabla." where ".$columna."=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$valor]); // Siempre un array con tantas parametros necesite la consulta
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        $respuesta["error"] = "No se ha podido realizar la consulta: " . $e->getMessage();
        return $respuesta;
    }
    // Recogemos la respuesta de la consulta
    if($sentencia->rowCount()<=0){
        $respuesta["mensaje"]="El valor (".$valor.") que usted busca en la columna (".$columna.") de la tabla (".$tabla."): no se encuentra en la BD";
        return $respuesta;
    }else{
        $respuesta["mensaje"]="El valor (".$valor.") que usted busca se encuentra en la columna (".$columna.") de la tabla (".$tabla.")";
        $sentencia = null;
        $conexion = null;
        return $respuesta; // Una vez montado el array lo devolvemos
    }
}

function es_repetido_editar($tabla,$columna,$valor,$id_columna,$id_valor){
    // Conectarnos con PDO
    try {
        $conexion = new PDO("mysql:host=" . SERVIDOR_BD . ";dbname=" . NOMBRE_BD, USUARIO_BD, CLAVE_BD, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    } catch (PDOException $e) {
        $respuesta["error"] = "No he podido conectar a la base de datos: " . $e->getMessage();
        return $respuesta; // Siempre usaremos un return porque un servicio no puede morir siempre devolverá algo
    }
    
    try {
        $consulta = "select ".$columna." from ".$tabla." where ".$id_columna." = ?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([$id_valor]);
    } catch (PDOException $e) {
        $sentencia = null;
        $conexion = null;
        $respuesta["error"] = "No se ha podido realizar la consulta: " . $e->getMessage();
        return $respuesta;
    }
    // Recogemos la respuesta de la consulta
    if ($sentencia->rowCount() == 0) {
        $respuesta["error"] = "El id que intentas buscar no se encuentra";
        return $respuesta;
    }

    $valor_obtenido = $sentencia->fetch(PDO::FETCH_ASSOC);
    if($valor_obtenido[$columna]==$valor){
        $respuesta["mensaje"]="Esta repetido";
        return $respuesta;
    }else{
        $respuesta["mensaje"]="No está repetido";
    }

}
?>