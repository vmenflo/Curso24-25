<?php 
    require_once "funciones.php";
?>
<form action="index.php" method="post" enctype="multipart/form-data">
            <h2>Rellena tu CV (PRACTICA 1B)</h2>
                <p>
                    <label for="nombre">Nombre</label>
                    <input id="nombre" name="nombre" value="<?php if(isset($_POST["nombre"])) echo $_POST["nombre"]; ?>" type="text">
                    <?php
                        if(isset($_POST["enviar"])&& $error_nombre){
                            echo "<span class='rojo'> * Campo necesario *</span>";
                        }
                    ?>
                </p>
                <p>
                    <label for="apellidos">Apellidos</label>
                    <input type="text" id="apellidos" name="apellidos" value="<?php if(isset($_POST["apellidos"])) echo $_POST["apellidos"]; ?>">
                    <?php
                        if(isset($_POST["enviar"])&& $error_apellidos){
                            echo "<span class='rojo'> * Campo necesario *</span>";
                        }
                    ?>
                </p>
                <p>
                    <label for="contrasenia">contraseña</label>
                    <input type="password" name="contrasenia" id="contrasenia" >
                    <?php
                        if(isset($_POST["enviar"])&& $error_contrasenia){
                            echo "<span class='rojo'> * Campo necesario *</span>";
                        }
                    ?>
                </p>
                <p>
                    <label for="dni">DNI</label>
                    <input type="text" id="dni" name="dni" value="<?php if(isset($_POST["dni"])) echo $_POST["dni"]; ?>">
                    <?php
                        if(isset($_POST["enviar"]) && $_POST["dni"] == ""){
                            echo "<span class='rojo' > * Debes añadir un DNI *</span>";    
                        }elseif(isset($_POST["enviar"]) && !formato_dni($_POST["dni"])){
                            echo "<span class='rojo' > * Formato erroneo *</span>";
                        }elseif (isset($_POST["enviar"]) && !es_valido($_POST["dni"])) {
                            echo "<span class='rojo' > * El DNI introducido no es válido *</span>";
                        }
                    ?>
                </p>
            <!--En los radio es importante usar el value para saber que datos mando. Un tipo texto se manda siempre, el radio solo si está marcado-->
                <p>
                    <label for="sexo">Sexo</label></br>
                    <input type="radio" name="sexo" value="hombre" id="sexo_hombre" <?php if(isset($_POST["sexo"]) && $_POST["sexo"]=="hombre"){echo "checked";}?>><label for="sexo_hombre">Hombre</label>
                    <input type="radio" name="sexo" value="mujer" id="sexo_mujer" <?php if(isset($_POST["sexo"]) && $_POST["sexo"]=="mujer"){echo "checked";}?>><label for="sexo_mujer">Mujer</label>
                    <?php
                        if(isset($_POST["enviar"])&& $error_sexo){
                            echo "<span class='rojo'> * Campo necesario *</span>";
                        }
                    ?>
                </p>
            <!--Para indicar que solo se suba archivos imagenes accept="image/* (file/pdf, jpg)" -->
                <p>
                    <Label for="foto">Seleccione un archivo imagen con extensión (Máx 500KB): </label>
                    <input type="file" name="foto" id="foto">
                    <?php
                if(isset($_POST["enviar"]) && $error_foto){

                    if($_FILES["foto"]["error"]){
                        echo "<span class='rojo'> * No se ha subido el archivo seleccionado al servidor * </span>";
                    }elseif(!tiene_extension($_FILES["foto"]["name"])){
                        echo "<span class='rojo'> * Has seleccinado un fichero sin extensión * </span>";
                    }elseif(!getimagesize($_FILES["foto"]["tmp_name"])){
                        echo "<span class='rojo'> * No has seleccionado un archivo imagen * </span>";
                    }else{
                        echo "<span class='rojo'> * El fichero seleccionado es mayor a 500 KB * </span>";
                    }

                }
            ?>
                </p>
                <p>
                    <label for="nacimiento">Nació en: </label>
                    <select id="nacimiento" name="nacimiento">
                        <option value="malaga" <?php if(isset($_POST["enviar"]) && $_POST["nacimiento"]=="malaga"){echo "selected";} ?>>Málaga</option>
                        <option value="madrid" <?php if(isset($_POST["enviar"]) && $_POST["nacimiento"]=="madrid"){echo "selected";} ?>>Madrid</option>
                        <option value="barcelona" <?php if(isset($_POST["enviar"]) && $_POST["nacimiento"]=="barcelona"){echo "selected";} ?>>Barcelona</option>
                    </select>
                </p>
                <p>
                    <label for="comentarios">Comentarios</label> <?php if(isset($_POST["comentarios"])) echo $_POST["comentarios"]; ?> <textarea placeholder="Escriba su comentario" rows="5" name="comentarios" id="comentarios"></textarea>
                    <?php
                        if(isset($_POST["enviar"])&& $error_comentarios){
                            echo "<span class='rojo'> * Campo necesario *</span>";
                        }
                    ?>
                </p>
                <p>
                    <input type="checkbox" name="subcribir" id="subcribir" checked>
                    <label for="subcribir">Subscribete al boletín de Novedades</label>
                </p>
                <p>
                    <input type="submit" name="enviar" value="Guardar Cambios">
                    <input type="reset" name="borrar" value="Borrar los datos introducidos">
                </p>
            </form>