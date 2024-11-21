<?php
    if(isset($_POST["btnContRegistro"]))
    {
        $error_nombre=$_POST["nombre"]=="";
        $error_usuario=$_POST["usuario"]=="";
        ////////////////
        try
        {
            @$conexion=mysqli_connect(SERVIDOR_BD,USUARIO_BD,CLAVE_BD,NOMBRE_BD);
            mysqli_set_charset($conexion,"utf8");
        }
        catch(Exception $e)
        {
            die(error_page("Práctica 8","<p>No se ha podido conectar a la BD: ".$e->getMessage()."</p>"));
        }
        //////////////////
        if(!$error_usuario)
        {
            $error_usuario=repetido($conexion,"usuarios","usuario",$_POST["usuario"]);
            if(is_string($error_usuario))
            {
                mysqli_close($conexion);
                die(error_page("Práctica 8","<p>".$error_usuario."</p>"));
            }
        
        }
        $error_clave=$_POST["clave"]=="";
        $error_dni=$_POST["dni"]=="" || !dni_bien_escrito($_POST["dni"]) || ! dni_valido($_POST["dni"]) ;
        if(!$error_dni)
        {
            $error_dni=repetido($conexion,"usuarios","dni",strtoupper($_POST["dni"]));
            if(is_string($error_dni))
            {
                mysqli_close($conexion);
                die(error_page("Práctica 8","<p>".$error_dni."</p>"));
            }
        
        }
    
        $error_foto=$_FILES["foto"]["name"]!="" && ($_FILES["foto"]["error"] || !tiene_extension($_FILES["foto"]["name"]) || !getimagesize($_FILES["foto"]["tmp_name"]) ||  $_FILES["foto"]["size"]>500*1024);
        $error_form_agregar=$error_nombre||$error_usuario||$error_clave||$error_dni||$error_foto;
        if(!$error_form_agregar)
        {
            //Inserto con imagen por defecto.
            //Y si he subido foto, muevo la foto y actualizo el nombre de la foto en la BD (img_id.extension)
    
            try
            {
                $consulta="insert into usuarios (nombre, usuario, clave, dni, sexo) values ('".$_POST["nombre"]."','".$_POST["usuario"]."','".md5($_POST["clave"])."','".strtoupper($_POST["dni"])."','".$_POST["sexo"]."')";
                mysqli_query($conexion,$consulta);
                $_SESSION["usuario"]=$_POST["usuario"];
                $_SESSION["clave"]=md5($_POST["clave"]);
                $_SESSION["ultm_accion"]=time();

            }
            catch(Exception $e)
            {
                mysqli_close($conexion);
                die(error_page("Práctica 8","<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p>"));
            }
            
            $_SESSION["mensaje_accion"]="Usuario agregado con éxito.";
            if($_FILES["foto"]["name"]!="")
            {
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
            exit();
        }
        mysqli_close($conexion);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista Registro</title>
</head>
<body>
<h1>Bienvenido</h1>
<h2>Rellena los campos para registrarte</h2>
<form action="index.php" method="post" enctype="multipart/form-data">
    <p>
        <label for="nombre">Nombre:</label><br/>
        <input type="text" name="nombre" id="nombre" placeholder="Nombre..." value="<?php if(isset($_POST["nombre"])) echo $_POST["nombre"];?>"/>
        <?php
        if(isset($_POST["btnContRegistro"]) && $error_nombre)
        {
            echo "<span class='error'>* Campo vacío *</span>";
        }
        ?>
    </p>
    <p>
        <label for="usuario">Usuario:</label><br/>
        <input type="text" name="usuario" id="usuario" placeholder="Usuario..."  value="<?php if(isset($_POST["usuario"])) echo $_POST["usuario"];?>"/>
        <?php
        if(isset($_POST["btnContRegistro"]) && $error_usuario)
        {
            if($_POST["usuario"]=="")
                echo "<span class='error'>* Campo vacío *</span>";
            else
                echo "<span class='error'>* Usuario repetido *</span>";
        }
        ?>
    </p>  
    <p>
        <label for="clave">Contraseña:</label><br/>
        <input type="password" name="clave" id="clave" value="" placeholder="Contraseña..." />
        <?php
        if(isset($_POST["btnContRegistro"]) && $error_clave)
        {
            echo "<span class='error'>* Campo vacío *</span>";
        }
        ?>
    </p>
    <p>
        <label for="email">DNI:</label><br/>
        <input type="text" name="dni" id="dni" placeholder="DNI: 12345678Z" value="<?php if(isset($_POST["dni"])) echo $_POST["dni"];?>"/>
        <?php
            if(isset($_POST["btnContRegistro"])&& $error_dni)
            {
                if($_POST["dni"]=="")
                    echo "<span class='error'> * Campo Vacío *</span>";
                elseif(!dni_bien_escrito($_POST["dni"]))
                    echo "<span class='error'> * DNI no está bien escrito *</span>";
                elseif(! dni_valido($_POST["dni"]))
                    echo "<span class='error'> * DNI no válido *</span>";
                else
                    echo "<span class='error'> * DNI repetido *</span>";
            }
               
            ?>
    </p>
    <p>
        <label>Sexo:</label><br/>
        <input type="radio" name="sexo" <?php if(!isset($_POST["sexo"]) || $_POST["sexo"]=="hombre") echo "checked";?> value="hombre" id="hombre"> <label for="hombre"> Hombre</label><br/>
        <input type="radio" name="sexo" <?php if(isset($_POST["sexo"]) && $_POST["sexo"]=="mujer") echo "checked";?> value="mujer" id="mujer"> <label for="mujer"> Mujer</label><br/>
    </p>
    <p>
        <label for="foto">Incluir mi foto (Archivo imagen con extensión, Máx. 500KB): </label>
        <input type="file" name="foto" accept="image/*"/>
        <?php
            if(isset($_POST["btnContRegistro"]) && $error_foto)
            {
                
                if($_FILES["foto"]["error"])
                    echo "<span class='error'>* No se ha subido el archivo seleccionado al servidor *</span>";
                elseif(!tiene_extension($_FILES["foto"]["name"]))
                    echo "<span class='error'>* Has seleccionado un fichero sin extensión *</span>";
                elseif(!getimagesize($_FILES["foto"]["tmp_name"]))
                    echo "<span class='error'>* No has seleccionado un fichero imagen *</span>";
                else
                    echo "<span class='error'>* El fichero seleccionado es mayor de 500KB *</span>";
            }
            ?>
    </p>
    <p>
        <button type="submit" name="btnContRegistro">Guardar cambios</button> 
        <button type="submit">Atrás</button>
    </p>    
</form>
</body>
</html>