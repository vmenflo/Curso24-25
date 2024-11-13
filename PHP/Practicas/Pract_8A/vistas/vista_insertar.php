<h2>Agregar nuevo usuario</h2>
<form action="index.php" method="post" enctype="multipart/form-data">
    <p>
        <label for="nombre">Nombre:</label>
        <?php
            if(isset($_POST["btnContAgregar"])&& $error_nombre){
                echo "<span>*Campo Vacío*</span>";
            }
        ?>
    </br>
        <input type="text" name="nombre" id="nombre" value='<?php if(isset($_POST["nombre"])){echo $_POST["nombre"];} ?>'>
    </p>
    <p>
        <label for="usuario">Usuario:</label>
        <?php
            if(isset($_POST["btnContAgregar"])&& $error_usuario){
                if($_POST["usuario"]==""){
                    echo "<span>*Campo Vacío*</span>";
                }else{
                    echo "<span> *Usuario ya registrado*</span>";
                }
            }
        ?>
    </br>
        <input type="text" name="usuario" id="usuario" value='<?php if(isset($_POST["usuario"])){echo $_POST["usuario"];} ?>' >
    </p>
    <p>
        <label for="clave">Contraseña:</label>
        <?php
            if(isset($_POST["btnContAgregar"])&& $error_clave){
                echo "<span>*Campo Vacío*</span>";
            }
        ?>
        </br>
        <input type="text" name="clave" id="clave">
    </p>
    <p>
        <label for="dni">DNI:</label>
        <?php
            if(isset($_POST["btnContAgregar"])&& $error_dni){
                if($_POST["dni"]==""){
                    echo "<span>*Campo Vacío*</span>";
                }else{
                    echo "<span> *DNI ya registrado*</span>";
                }
            }
        ?>
    </br>
        <input type="text" name="dni" id="dni" value='<?php if(isset($_POST["dni"])){echo $_POST["dni"];} ?>' >
    </p>
    <p>
        <label for="sexo">Sexo:</label></br>
        <input type="radio" name="sexo" id="hombre" <?php if(!isset($_POST["sexo"]) || $_POST["sexo"]=="hombre"){echo "checked";} ?> value='hombre'><label for="hombre">Hombre</label></br>
        <input type="radio" name="sexo" id="mujer" <?php if(isset($_POST["sexo"]) && $_POST["sexo"]=="mujer"){echo "checked";} ?> value='mujer'><label for="mujer">Mujer</label>
    </p>
    <p>
        <label for="foto">Incluir mi foto (MAX 500KB): </label><input type="file" name="foto" id="foto">
        <?php
            if(isset($_POST["btnContAgregar"])&& $error_foto){
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
    <p><button type="submit" name="btnContAgregar">Agregar</button> <button type="submit">Atrás</button></p>
</form>