<?php
    if(isset($_POST["btnLogin"])){
        // Controlar errores
        $error_nombre = $_POST["nombre"]=="";
        $error_clave = $_POST["clave"]=="";

        $error_form_login = $error_nombre || $error_clave;

        if(!$error_form_login){
            try{
                @$conexion = mysqli_connect(SERVIDOR_BD,USUARIO_BD,CLAVE_BD, NOMBRE_BD);
                mysqli_set_charset($conexion,"utf8");
            }catch(Exception $e){
                session_destroy();
                die(error_page("Práctica 10","<p>No se ha podido conectar a la BD: ".$e->getMessage()."</p>"));
            }

            try
            {
                $consulta="select usuario from usuarios where usuario='".$_POST["nombre"]."' AND clave='".md5($_POST["clave"])."'";
                $result_select=mysqli_query($conexion,$consulta);
                $n_tuplas=mysqli_num_rows($result_select);
                mysqli_free_result(($result_select));
                if($n_tuplas>0)
                {
                    //El usuario se encuentra registrado y tengo que iniciar session
                    mysqli_close($conexion);
                    $_SESSION["usuario"]=$_POST["nombre"];
                    $_SESSION["clave"]=md5($_POST["clave"]);
                    $_SESSION["ultm_accion"]=time();
                    header("Location:index.php");
                    exit;
    
                }else{
                    mysqli_close($conexion);
                    $error_usuario=true;
                }
            }
            catch(Exception $e)
            {
                mysqli_close($conexion);
                session_destroy();
                die(error_page("Práctica 10","<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p>"));
            }
        }

    }
?>
<form action="index.php" method="post">
        <h3>Login</h3>
        <p>
            <label for="nombre">Nombre: </label><input value="<?php if(isset($_POST["nombre"])){echo $_POST['nombre'];} ?>" type="text" name="nombre" id="nombre">
            <?php
                if(isset($_POST["btnLogin"]) && $error_nombre){
                    echo "<span>*Campo Vacío*</span>";
                }
            ?>
        </p>
        <p>
            <label for="clave">Contraseña: </label><input type="password" name="clave" id="clave">
            <?php
                if(isset($_POST["btnLogin"]) && $error_clave){
                    echo "<span>*Campo Vacío*</span>";
                }
            ?>
        </p>
        <p>
            <button type="submit" name="btnLogin">Login</button>
        </p>
    </form>