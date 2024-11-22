<h1>Esta es mi super página</h1>
    <form action="index.php" method="post">
        <p>
            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre" id="nombre" value="<?php if(isset($_POST["nombre"])) echo $_POST["nombre"];?>">
            <?php
            if(isset($_POST["btnEnviar"]) && $error_nombre){
                echo "<span class='error'>*Campo obligatorio * </span>";
            }
            ?>
        </p>
        <p>
            <label for="nacido">Nacido en: </label>
            <select name="nacido" id="nacido">
                <option value="Málaga"  <?php if(isset($_POST["nacido"]) && $_POST["nacido"] == "Málaga") echo "selected" ;?>>Málaga</option>
                <option value="Granada"  <?php if(isset($_POST["nacido"]) && $_POST["nacido"] == "Granada") echo "selected" ;?>>Granada</option>
                <option value="Almería"  <?php if(isset($_POST["nacido"]) && $_POST["nacido"] == "Almería") echo "selected" ;?>>Almería</option>
            </select>
        </p>
        <p>
            Sexo: <label for="hombre">Hombre</label>
            <input type="radio" name="sexo" id="hombre" value="hombre" <?php if(isset($_POST["sexo"]) && $_POST["sexo"] == "hombre") echo "checked" ;?>>
            <label for="mujer">Mujer</label>
            <input type="radio" name="sexo" id="mujer" value="mujer"  <?php if(isset($_POST["sexo"]) && $_POST["sexo"] == "mujer") echo "checked" ;?>>
            <?php
            if(isset($_POST["btnEnviar"]) && $error_sexo){
                echo "<span class='error'>*Campo obligatorio * </span>";
            }
            ?>
        </p>

        <p>
            Aficiones: <label for="deportes">Deportes</label>
            <input type="checkbox" name="aficiones[]" id="deportes" value="Deportes" <?php if(isset($_POST["aficiones"])&& mi_in_array("Deportes", $_POST["aficiones"])) echo "checked";?>>
            <label for="lectura">Lectura</label>
            <input type="checkbox" name="aficiones[]" id="lectura" value="Lectura" <?php if(isset($_POST["aficiones"])&& mi_in_array("Lectura", $_POST["aficiones"])) echo "checked";?>>
            <label for="deportes">Otros</label>
            <input type="checkbox" name="aficiones[]" id="otros" value="Otros" <?php if(isset($_POST["aficiones"])&& mi_in_array("Otros", $_POST["aficiones"])) echo "checked";?>>
        </p>

        <p>
            <label for="comentarios">Comentarios: </label>
            <textarea name="comentarios" id="comentarios"><?php if(isset($_POST["comentarios"])) echo $_POST["comentarios"];?></textarea>
        </p>
        <p>
            <button type="submit" name="btnEnviar">Enviar</button>
        </p>
    </form>