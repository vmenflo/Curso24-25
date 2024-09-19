<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 1</title>
</head>
<body>
    <h2>Rellena tu CV</h2>
    <!-- Action poner a que página ir despues de darle al botón enviar -->
    <!-- hay contraseña y fichero por lo tanto en el metodo usaremos post, si no hay nada entonces get -->
    <!-- enctype es obligatorio cuando en el formulario hay un input file -->

    <form action="recogida_datos.php" method="get" enctype="multipart/form-data">
    <!-- Se puede poner en los inputs required maxlenght size placeholder y otras configuraciones-->
        <p>
            <label for="nombre">Nombre</label>
            <input id="nombre" name="nombre" type="text">
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
        </p>


        <label for="sexo">Sexo</label></br>
        <input type="radio" name="sexo" id="sexo_hombre"><label for="sexo_hombre">Hombre</label></br>
        <input type="radio" name="sexo" id="sexo_mujer"><label for="sexo_mujer">Mujer</label></br></br>

        <Label name="foto">Incluir mi foto: </label>
        <input type="file" name="foto" id="foto"></br></br>

        <label for="nacimiento">Nació en: </label>
        <select id="nacimiento" name="nacimiento">
            <option value="malaga">Málaga</option>
            <option value="madrid">Madrid</option>
            <option value="barcelona">Barcelona</option>
        </select></br></br>

        <label for="comentarios">Comentarios</label><textarea placeholder="Escriba su comentario" rows="5" name="comentario" id="comentarios"></textarea></br></br>

        <input type="checkbox" name="subcribir" id="subcribir" checked>

        <label for="subcribir">Subscribete al boletín de Novedades</label></br></br>

        <input type="submit" name="enviar" value="Guardar Cambios">
        <input type="reset" name="borrar" value="Borrar los datos introducidos">

    </form>
</body>
</html>