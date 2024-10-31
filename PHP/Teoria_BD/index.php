<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teoría BD</title>
    <style>
        table,td,th,tr{
            border:1px solid black;
            padding:0.5rem;
        }
        th{
            background-color: lightblue;
        }
        table{
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <h1>Teoría BD</h1>
    <?php

    // En una base de datos haremos 3 cosas: conectarnos, consulta y cerrar

    // 1- CONEXIÓN A LA BASE DE DATOS
    // Cómo conectar a una Base de Datos:
    // Creamos las CONSTANTES que usaremos en mysql_connect
    const SERVIDOR_BD = "localhost";
    const USUARIO_BD = "jose";
    const CLAVE_BD = "josefa";
    const NOMBRE_BD = "bd_teoria";

    // Como puede fallar lo controlaremos con un try_catch

    try {
        @$conexion = mysqli_connect(SERVIDOR_BD, USUARIO_BD, CLAVE_BD, NOMBRE_BD); // Tiene 4 argumentos: host, user, password, BD
        // Hay que indicarle que los datos de la conexion tenga el juego de caracteres formato UTF-8
        mysqli_set_charset($conexion, "utf8");
    } catch (Exception $e) {
        die("<p> No se ha podido conectar a la BD: " . $e->getMessage() . "</p></body></html>"); // Para cuando muera completamos el html
    }

    echo "<h2> Conexión bien </h2>";

    // 2- REALIZAR LA CONSULTA
    // Como hacer una consulta

    try {
        $consulta = "select * from t_alumnos"; // sentencia de búsqueda
        $resultado = mysqli_query($conexion, $consulta);
    } catch (Exception $e) {
        mysqli_close($conexion); // No olvidemos de cerrar
        die("<p> No se ha podido realizar la consulta: " . $e->getMessage() . "</p></body></html>"); // Para cuando muera completamos el html
    }

    // ACCESO Y MANEJO DE LOS DATOS
    // Para saber cuantas tuplas tiene
    $n_tuplas = mysqli_num_rows($resultado);
    echo "<p>El número de alumnos en la tabla T_alumnos es ahora mismo de: " . $n_tuplas . "</p>";

    // Acceder a las tuplas
    echo "<h3>Mostrando las tuplas</h3>";
    $tupla = mysqli_fetch_assoc($resultado); // Esta es la que mas usaremos, creará un array asociativo
    echo "<p> El nombre del primer alumno obtenido es: " . $tupla["nombre"] . "</p>";

    // Otra forma con el row, te devuelve un array escalar
    $tupla = mysqli_fetch_row($resultado);
    echo "<p> El teléfono del segundo alumno obtenido es: " . $tupla[2] . "</p>";

    // Tercera forma para recoger los datos, es el segundo más usado
    $tupla = mysqli_fetch_object($resultado);
    echo "<p> El Código Postal del tercer alumno es: " . $tupla->cp . "</p>";
    // Como solo hay 3 alumnos y vamos a realizar otra consulta de un alumno que no existe, nos devolverá NULL. Para evitarlo volvemos al inicio
    // Funcion puntero para volver al inicio de las tuplas
    mysqli_data_seek($resultado, 0);
    //Otro tipo de fetch
    $tupla = mysqli_fetch_array($resultado);
    echo "<p>El nombre del siguiente alumno es: " . $tupla[1] . " y el teléfono es: " . $tupla["telefono"] . "</p>";

    // Vamos a mostrar los datos de los alumnos en una tabla
    mysqli_data_seek($resultado, 0);
    echo "<h3> Información de todos los alumnos </h3>";
    echo "<table>";
    echo "<tr>";
        echo "<th>Código</th>";
        echo "<th>Nombre</th>";
        echo "<th>Teléfono</th>";
        echo "<th>CP</th>";
    echo "</tr>";
    while($tupla = mysqli_fetch_assoc($resultado)){
        echo "<tr>";
            echo "<td>".$tupla["cod_alu"]."</td>";
            echo "<td>".$tupla["nombre"]."</td>";
            echo "<td>".$tupla["telefono"]."</td>";
            echo "<td>".$tupla["cp"]."</td>";
        echo "</tr>";
    }
    echo "</table>";

    
    mysqli_free_result($resultado); // Siempre hay que liberarlo una vez que no vayamos a usar más los datos del select

    // 3- CIERRE DE LA CONEXIÓN
    // Siempre que se abra una conexión tenemos que cerrarla
    mysqli_close($conexion); // De esta forma cerramos la conexion
    echo "<h2>Cierro conexion</h2>"
    ?>
</body>

</html>