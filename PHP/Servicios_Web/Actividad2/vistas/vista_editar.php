<div >
    <form class='centrado' action='index.php' method='POST'>
    <h2> Editando el producto: <?php echo $cod; ?> </h2>
        <p>
            <label for='cod'>Código:</label>
            <input type='text' id='cod' name="cod" value="<?php echo $cod;?>"/>
            <?php
                if(isset($_POST["btnContEditar"]) && $error_cod){
                    if($_POST["cod"]==""){
                        echo "<span> Campo vacio</spam>";
                    }else{
                        echo "<span> Codigo repetido </spam>";
                    }
                }
            ?>
        </p>
        <p>
            <label for='nombre'>Nombre:</label>
            <input type='text' id='nombre' name='nombre' value="<?php  echo $nombre; ?>"/>
        </p>
        <p>
            <label for='nombre_corto'>Nombre corto:</label>
            <input type='text' id='nombre_corto' name='nombre_corto' value="<?php echo $nombre_corto; ?>"/>
            <?php
                if(isset($_POST["btnContEditar"]) && $error_nombre_corto){
                    if($_POST["nombre_corto"]==""){
                        echo "<span> Campo vacio</spam>";
                    }else{
                        echo "<span> Codigo repetido </spam>";
                    }
                }
            ?>
        </p>
        <p>
            <label for='descripcion'>descripción:</label>
            <textarea id='descripcion' name='descripcion' value="<?php echo $descripcion; ?>"></textarea>
            <?php
                if(isset($_POST["descripcion"]) && $error_descripcion){
                    echo "<span> Campo Vacio </spam>";
                }
            ?>
        </p>
        <p>
            <label for='pvp'>PVP:</label>
            <input type='text' id='pvp' name='pvp' value="<?php echo $pvp; ?>">
        </p>
        <p>
            <label for='familia'>Seleccione una familia:</label>
            <select id="familia" name="familia">
                <?php
                    foreach($json_familias["familia"] as $tupla){
                        echo "<option value='".$tupla["cod"]."'>".$tupla["nombre"]."</option>";
                    }
                ?>
            </select>
        </p>
        <button type='submit'>Volver</button>
        <button name='btnContEditar' value='btnContEditar' type='submit'>Continuar</button>
        <input type="hidden" name="cod" value="<?php echo $cod; ?>">
        </br>
        </br>
    </form>
</div>