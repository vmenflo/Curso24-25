<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require 'Firebase/autoload.php';

define("SERVIDOR_BD","localhost");
define("USUARIO_BD","jose");
define("CLAVE_BD","josefa");
define("NOMBRE_BD","bd_foro");
define("PASSWORD_API","PASSWORD_DE_MI_APLICACION");



function validateToken()
{
    
    $headers = apache_request_headers();
    if(!isset($headers["Authorization"]))
        return false;//Sin autorizacion
    else
    {
        $authorization = $headers["Authorization"];
        $authorizationArray=explode(" ",$authorization);
        $token=$authorizationArray[1];
        try{
            $info=JWT::decode($token,new Key(PASSWORD_API,'HS256'));
        }
        catch(\Throwable $th){
            return false;//Expirado
        }

        try{
            $conexion= new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));
        }
        catch(PDOException $e){
            
            $respuesta["error"]="Imposible conectar:".$e->getMessage();
            return $respuesta;
        }

        try{
            $consulta="select * from usuarios where id_usuario=?";
            $sentencia=$conexion->prepare($consulta);
            $sentencia->execute([$info->data]);
        }
        catch(PDOException $e){
            $respuesta["error"]="Imposible realizar la consulta:".$e->getMessage();
            $sentencia=null;
            $conexion=null;
            return $respuesta;
        }
        if($sentencia->rowCount()>0)
        {
            $respuesta["usuario"]=$sentencia->fetch(PDO::FETCH_ASSOC);
         
            $payload['exp']=time()+3600;
            $payload['data']= $respuesta["usuario"]["id_usuario"];
            $jwt = JWT::encode($payload,PASSWORD_API,'HS256');
            $respuesta["token"]=$jwt;
        }
            
        else
            $respuesta["mensaje_baneo"]="El usuario no se encuentra registrado en la BD";

        $sentencia=null;
        $conexion=null;
        return $respuesta;
    }
    
}

// Funcion USUARIOS
function obtener_usuarios(){
    try{
        $conexion= new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));
    }
    catch(PDOException $e){
        
        $respuesta["error"]="Imposible conectar:".$e->getMessage();
        return $respuesta;
    }

    try{
        $consulta = "select * from usuarios";
        $sentencia = $conexion->prepare($consulta);
        $sentencia-> execute();

    }catch(PDOException $e){
        $sentencia=null;
        $conexion=null;
        $respuesta["error"]="Error al hacer la consulta: ".$e->getMessage();
        return $respuesta;
    }

    $respuesta["usuarios"] = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    $sentencia=null;
    $conexion=null;
    return $respuesta;
}

// Crear Usuario
function crear_usuario($datos){
    try{
        $conexion= new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));
    }
    catch(PDOException $e){
        
        $respuesta["error"]="Imposible conectar:".$e->getMessage();
        return $respuesta;
    }

    try{
        $consulta = "insert into usuarios (nombre,usuario,clave,email) values (?,?,?,?)";
        $sentencia = $conexion->prepare($consulta);
        $sentencia-> execute($datos);

    }catch(PDOException $e){
        $sentencia=null;
        $conexion=null;
        $respuesta["error"]="Error al hacer la consulta: ".$e->getMessage();
        return $respuesta;
    } 

    $respuesta["ult_id"] = $conexion->lastInsertId();
    $sentencia=null;
    $conexion=null;
    return $respuesta;
}

function login($datos){
    try{
        $conexion= new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));
    }
    catch(PDOException $e){
        
        $respuesta["error"]="Imposible conectar:".$e->getMessage();
        return $respuesta;
    }

    try{
        $consulta = "select * from usuarios where usuario=? and clave=? ";
        $sentencia = $conexion->prepare($consulta);
        $sentencia-> execute($datos);

    }catch(PDOException $e){
        $sentencia=null;
        $conexion=null;
        $respuesta["error"]="Error al hacer la consulta: ".$e->getMessage();
        return $respuesta;
    } 

    if($sentencia->rowCount()>0)
    {
        $respuesta["usuario"]=$sentencia->fetch(PDO::FETCH_ASSOC);
    
        $payload=['exp'=>time()+3600,'data'=> $respuesta["usuario"]["id_usuario"]];
        $jwt = JWT::encode($payload,PASSWORD_API,'HS256');
        $respuesta["token"]=$jwt;
    }else
        $respuesta["mensaje"]="El usuario no se encuentra registrado en la BD";

    $sentencia=null;
    $conexion=null;
    return $respuesta;
}

function actualizar_usuario($datos){
    try{
        $conexion= new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));
    }
    catch(PDOException $e){
        
        $respuesta["error"]="Imposible conectar:".$e->getMessage();
        return $respuesta;
    }

    try{
        $consulta = "update usuarios set nombre=?, usuario=?, clave=?, email=? where id_usuario=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia-> execute($datos);

    }catch(PDOException $e){
        $sentencia=null;
        $conexion=null;
        $respuesta["error"]="Error al hacer la consulta: ".$e->getMessage();
        return $respuesta;
    }
    
    $respuesta["mensaje"]="El usuario".$datos[4]." ha sido actualizado con éxito";
    $sentencia=null;
    $conexion=null;
    return $respuesta;
}

function borrar_usuario($id_usuario){
    try{
        $conexion= new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'utf8'"));
    }
    catch(PDOException $e){
        
        $respuesta["error"]="Imposible conectar:".$e->getMessage();
        return $respuesta;
    }

    try{
        $consulta = "delete * from usuarios where id_usuario=?";
        $sentencia = $conexion->prepare($consulta);
        $sentencia-> execute($id_usuario);

    }catch(PDOException $e){
        $sentencia=null;
        $conexion=null;
        $respuesta["error"]="Error al hacer la consulta: ".$e->getMessage();
        return $respuesta;
    }
    
    $respuesta["mensaje"]="El usuario".$id_usuario." ha sido eliminado con éxito";
    $sentencia=null;
    $conexion=null;
    return $respuesta;
}
?>