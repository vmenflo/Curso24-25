<form action="index.php" method="post" enctype="multipart/form-data">
            <h2>Rellena tu CV (PRACTICA 1B)</h2>
                <p>
                    <label for="nombre">Nombre</label>
                    <input id="nombre" name="nombre" value="<?php if(isset($_POST["nombre"])) echo $_POST["nombre"]; ?>" type="text">
                    <?php
                        if(isset($_POST["enviar"])&& $error_nombre){
                            echo "<span class='rojo'> necesario</span>";
                        }
                    ?>
                </p>
                <p>
                    <label for="apellidos">Apellidos</label>
                    <input type="text" id="apellidos" name="apellidos">
                </p>
                <p>
                    <label for="contrasenia">contraseña</label>
                    <input type="password" name="contrasenia" id="contrasenia">
                </p>
                <p>
                    <label for="dni">DNI</label>
                    <input type="text" id="dni" name="dni">
                    <?php
                        if(isset($_POST["enviar"]) && $_POST["dni"] == ""){
                            echo "<span> Debes añadir un dni </span>";    
                        }
                    ?>
                </p>
            <!--En los radio es importante usar el value para saber que datos mando. Un tipo texto se manda siempre, el radio solo si está marcado-->
                <p>
                    <label for="sexo">Sexo</label></br>
                    <input type="radio" name="sexo" value="hombre" id="sexo_hombre"><label for="sexo_hombre">Hombre</label>
                    <input type="radio" name="sexo" value="mujer" id="sexo_mujer"><label for="sexo_mujer">Mujer</label>
                </p>
            <!--Para indicar que solo se suba archivos imagenes accept="image/* (file/pdf, jpg)" -->
                <p>
                    <Label for="foto">Incluir mi foto: </label>
                    <input type="file" name="foto" id="foto" accept="image/">
                </p>
                <p>
                    <label for="nacimiento">Nació en: </label>
                    <select id="nacimiento" name="nacimiento">
                        <option value="malaga">Málaga</option>
                        <option value="madrid">Madrid</option>
                        <option value="barcelona">Barcelona</option>
                    </select>
                </p>
                <p>
                    <label for="comentarios">Comentarios</label> <?php if(isset($_POST["comentarios"])) echo $_POST["comentarios"]; ?> <textarea placeholder="Escriba su comentario" rows="5" name="comentarios" id="comentarios"></textarea>
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