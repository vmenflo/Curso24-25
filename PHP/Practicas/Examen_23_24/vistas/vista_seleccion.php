<h1>Examen2 PHP</h1>
<h2>Horario de los Profesores</h2>
<form action="index.php" method="post">
    <label for="horario">Horario del Profesor: </label>
    <select id="horario" name="horario">
        <?php
            while($tupla_datos_usuario=mysqli_fetch_assoc($result_datos_usuarios)){
                if(isset($_POST["horario"]) && $_POST["horario"]==$tupla_datos_usuario["id_usuario"]){
                    $nombre_profesor = $tupla_datos_usuario["nombre"];
                    echo "<option value='".$tupla_datos_usuario["id_usuario"]."' selected >".$tupla_datos_usuario["nombre"]."</option>";
                }else{
                    echo "<option value='".$tupla_datos_usuario["id_usuario"]."'>".$tupla_datos_usuario["nombre"]."</option>";
                }
            }
        ?>
    </select>
    <button type="submit" name="btnMostrarHorario">Ver Horario</button>
</form>