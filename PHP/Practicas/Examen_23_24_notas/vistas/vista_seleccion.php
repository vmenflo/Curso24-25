<form action="index.php" method="post">
            <p>
                <label for="alumno">Seleccione un alumno: </label>
                <select name="alumno" id="alumno">
                <?php
                    while($tupla=mysqli_fetch_assoc($result_select))
                    {
                        if(isset($_POST["alumno"]) && $_POST["alumno"]==$tupla["cod_alu"])
                        {
                            echo "<option selected value='".$tupla["cod_alu"]."'>".$tupla["nombre"]."</option>";
                            $nombre_alumno=$tupla["nombre"];
                        }
                        else
                            echo "<option value='".$tupla["cod_alu"]."'>".$tupla["nombre"]."</option>";
                            
                    }
                    mysqli_free_result($result_select);
                ?>
                </select>
                <button type="submit" name="btnVerNotas">Ver Notas</button>
            </p>
</form>