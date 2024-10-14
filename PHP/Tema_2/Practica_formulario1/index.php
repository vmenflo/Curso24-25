        <?php
            if(isset($_POST["enviar"])){
                // Comprobar error del dni que este bien escrito y que sea válido
                function formato_dni($dni){
                    $tamaño = count($dni);
                    $es_numero = true;
                    for ($i=0; $i < $tamaño; $i++) { 
                        if(!is_numeric($dni[$i])){
                            $es_numero=false;
                        }
                    }

                    $letra = substr(strtoupper($dni),-1);
                    if($letra=="A-Z"){
                        $es_letra=true;
                    }else{
                        $es_letra=false;
                    }

                    if(count($dni)==9 && $es_letra && $es_numero){
                        return true;
                    }else{
                        return false;
                    }
                    

                    
                }
                // Comprobamos errores del formulario
                $error_nombre=($_POST["nombre"]=="");
                $error_nombre=($_POST["apellidos"]=="");
                $error_nombre=($_POST["contrasenia"]=="");
                // $error_nombre=($_POST["sexo"]=="");
                $error_nombre=($_POST["comentarios"]=="");
                $error_nombre=($_POST["dni"]=="" || !formato_dni($_POST["dni"]));
                $errores_form = $error_nombre||$error_apellidos||$error_contrasenia||$error_dni||$error_sexo||$error_comentarios;             
            }
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Práctica 1B</title>
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

