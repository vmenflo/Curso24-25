<?php
if (isset($_POST["btnLogin"])) {
    //compruebo errores
    $error_usuario = $_POST["usuario"] == "";
    $error_clave = $_POST["clave"] == "";
    $error_form_login = $error_usuario || $error_clave;
    if (!$error_form_login) {
        // Inserto y salgo con mensaje
        $url = DIR_SERV . "/login";
        $datos["usuario"] = $_POST["usuario"];
        $datos["clave"] = md5($_POST["clave"]);
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
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Primer Login</title>
    <style>
        .error {
            color: red
        }

        .mensaje {
            color: blue;
            font-size: 1.25rem
        }
    </style>
</head>

<body>
    <h1>Primer Login</h1>
    <form action="index.php" method="post">
        <p>
            <label for="usuario">Usuario: </label>
            <input type="text" id="usuario" name="usuario" value="<?php if (isset($_POST["usuario"])) echo $_POST["usuario"]; ?>" />
            <?php
            if (isset($_POST["btnLogin"]) && $error_usuario) {
                if ($_POST["usuario"] == "")
                    echo "<span class='error'>* Campo vacío *</span>";
                else
                    echo "<span class='error'>* Usuario y/o contraseña incorrectos  *</span>";
            }
            ?>
        </p>
        <p>
            <label for="clave">Contraseña: </label>
            <input type="password" name="clave" id="clave" />
            <?php
            if (isset($_POST["btnLogin"]) && $error_clave) {
                echo "<span class='error'>* Campo vacío *</span>";
            }
            ?>
        </p>
        <p><button name="btnLogin" type="submit">Login</button></p>
    </form>
    <?php
    if (isset($_SESSION["mensaje_seguridad"])) {
        echo "<p class='mensaje'>" . $_SESSION["mensaje_seguridad"] . "</p>";
        session_destroy();
    }
    ?>
</body>

</html>