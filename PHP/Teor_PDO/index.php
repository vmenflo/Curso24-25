<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoria PDO</title>
</head>
<body>
    <h1>Teoría PDO</h1>
    <?php
        define("SERVIDOR_BD","localhost");
        define("USUARIO_BD","jose");
        define("CLAVE_BD","josefa");
        define("NOMBRE_BD","bd_foro");

        // Conectarnos con PDO
        try{
            $conexion = new PDO("mysql:host=".SERVIDOR_BD.";dbname=".NOMBRE_BD,USUARIO_BD,CLAVE_BD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        }catch(PDOException $e){
            die("<p>No se ha podido conectar a la BD: ".$e->getMessage()."</p>");
        }
        echo "<p>Conectado</p>";

        $usuario="vic";
        $clave=md5("123");

        // Como LOGUEAMOS con PDO
        /*
        try{
            $consulta = "select * from usuarios where usuario=? and clave=?";
            $sentencia=$conexion->prepare($consulta);
            $sentencia->execute([$usuario,$clave]); // Siempre un array con tantas parametros necesite la consulta
        }catch(PDOException $e){
            $sentencia=null;
            $conexion=null;
            die("<p>No se ha podido conectar a la BD: ".$e->getMessage()."</p>");
        }        

        if($sentencia->rowCount()<=0){
            echo "<p>No hay usuarios con esas credenciales en la BD</p>";
        }else{
            $tupla=$sentencia->fetch(PDO::FETCH_ASSOC);
            echo "<p>El nombre del usuario es ".$tupla["nombre"]."</p>";
        }
        */

        try{
            $consulta = "select * from usuarios";
            $sentencia=$conexion->prepare($consulta);
            $sentencia->execute(); // Siempre un array con tantas parametros necesite la consulta
        }catch(PDOException $e){
            $sentencia=null;
            $conexion=null;
            die("<p>No se ha podido conectar a la BD: ".$e->getMessage()."</p>");
        }        

        if($sentencia->rowCount()<=0){
            echo "<p>No hay usuarios en la BD</p>";
        }else{
            $usuarios=$sentencia->fetchAll(PDO::FETCH_ASSOC);
            echo "<h3>Listado de los usuarios</h3>";
            echo "<ol>";
            foreach($usuarios as $tupla){
                echo "<li>".$tupla['nombre']."</li>";
            }
            echo "</ol>";
            
        }
        // Cerramos sentencia
        $sentencia=null;
        // Cerramos la conexión
        $conexion=null;
    ?>
</body>
</html>