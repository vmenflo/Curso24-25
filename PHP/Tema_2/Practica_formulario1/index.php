        <?php
            if(isset($_POST["enviar"])){
                require_once "funciones.php";

                // Comprobamos errores del formulario
                $error_nombre=($_POST["nombre"]=="");
                $error_apellidos=($_POST["apellidos"]=="");
                $error_contrasenia=($_POST["contrasenia"]=="");
                $error_sexo=!isset($_POST["sexo"]);
                $error_comentarios=($_POST["comentarios"]=="");
                $error_dni=($_POST["dni"]=="" || !formato_dni($_POST["dni"]) || !es_valido($_POST["dni"]));
                $error_foto = $_FILES["foto"]["name"]!= "" && ($_FILES["foto"]["error"] || !tiene_extension($_FILES["foto"]["name"]) || !getimagesize($_FILES["foto"]["tmp_name"]) || $_FILES["foto"]["size"] > 500*1024);
                $errores_form = $error_nombre||$error_apellidos||$error_contrasenia||$error_dni||$error_sexo||$error_comentarios || $error_foto;             
            }
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Práctica 1B</title>
            <style>
                .rojo{color:red;}
            </style>
        </head>
        <body>
            <!-- Si entro y no esta el campo enviar, sigue leyendo el html SINO entonces muestra los resultados-->
            <?php
                if(!isset($_POST["enviar"]) || $errores_form){
                    require "vistas/vistas_formulario.php";
            }else{
                    require "vistas/vistas_recogida.php";
                        
            }
        ?>
        </body>
        </html>

