<div>
    <h2> Creando un producto </h2>
    <form action='index.php' method='POST'>
        <p>
            <label for='cod'>Código:</label>
            <input type='text' id='cod' name='cod'>
        </p>
        <p>
            <label for='nombre'>Nombre:</label>
            <input type='text' id='nombre' name='nombre'>
        </p>
        <p>
            <label for='nombre_corto'>Nombre corto:</label>
            <input type='text' id='nombre_corto' name='nombre_corto'>
        </p>
        <p>
            <label for='descripcion'>descripción:</label>
            <input type='text' id='descripcion' name='descripcion'>
        </p>
        <p>
            <label for='pvp'>PVP:</label>
            <input type='text' id='pvp' name='pvp'>
        </p>
        <p>
            <label for='familia'>Seleccione una familia:</label>
            <select id="familia">
                <option value=''>Hola</option>
            </select>
        </p>
        <button type='submit'>Volver</button>
        <button name='btnContAgregar' value='btnContAgregar' type='submit'>Continuar</button>
    </form>
</div>