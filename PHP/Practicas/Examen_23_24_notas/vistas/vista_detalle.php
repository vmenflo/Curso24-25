<?php
    echo "<p> Estas son las notas del alumno ".$nombre_alumno."</p>";
    echo "<table>";
        echo "<tr>";
            echo "<th>Asignaturas</th>";
            echo "<th>Notas</th>";
            echo "<th>Acción</th>";
        echo "</tr>";
        while($tupla=mysqli_fetch_assoc($result_detalle_alumno)){
            echo "<tr>";
                echo "<td>".$tupla["denominacion"]."</td>";
                echo "<td>".$tupla["nota"]."</td>";
                echo "<td><form action='index.php' method='post'><input type='hidden' name='cod_alu' value='".$_POST["alumno"]."'><input type='hidden' name='cod_asig' value='".$tupla["cod_asig"]."'><button type ='submit' name='btnBorrar'>Borrar<button></form></td>";
            echo "</tr>";
        }
    echo "</table>";

    if(mysqli_num_rows($result_asignaturas_faltan)==0){
        echo "<p> A ".$nombre_alumno." No le queda asignaturas por calificar </p>";
    }else{
        ?>
        <form action="index.php" method="post">
            <p>
                <label for="asignatura">Asignaturas que a <?php echo $nombre_alumno; ?> le falta por calificar: </label>
                <?php
                echo "<input name='cod_alumno' value='".$_POST["alumno"]."' type='hidden'>";
                echo "<select name='asignatura' id='asignatura'>";
                
                    while($tupla=mysqli_fetch_assoc($result_asignaturas_faltan))
                    {
                        if(isset($_POST["asignatura"]) && $_POST["asignatura"]==$tupla["cod_asig"])
                        {
                            echo "<option selected value='".$tupla["cod_asig"]."'>".$tupla["denominacion"]."</option>";
                        }
                        else
                            echo "<option value='".$tupla["cod_asig"]."'>".$tupla["denominacion"]."</option>";
                            
                    }
                    mysqli_free_result($result_asignaturas_faltan);
                ?>
                </select>
                <button type="submit" name="btnCalificar">Calificar</button>
            </p>
</form>
<?php
    }

?>