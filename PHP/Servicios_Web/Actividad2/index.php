<?php
function consumir_servicios_REST($url, $metodo, $datos = null)
{
    $llamada = curl_init();
    curl_setopt($llamada, CURLOPT_URL, $url);
    curl_setopt($llamada, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($llamada, CURLOPT_CUSTOMREQUEST, $metodo);
    if (isset($datos))
        curl_setopt($llamada, CURLOPT_POSTFIELDS, http_build_query($datos));
    $respuesta = curl_exec($llamada);
    curl_close($llamada);
    return $respuesta;
}

define("DIR_SERV", "http://localhost/Proyectos/Curso24-25/PHP/Servicios_Web/Actividad1/servicios_rest");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba de los Servicios Actividad</title>
    <style>
        table,td,th{border:1px solid black;padding:0.5rem;}
        table{border-collapse:collapse;text-align: center;}
        .enlace{color:blue; text-decoration: underline; cursor: pointer;background-color: white;border:none}
    </style>
</head>

<body>
    <h1>Listado de los productos</h1>
    <?php

    if(isset($_POST["btnDetalles"])){
        $url = DIR_SERV . "/producto/".$_POST["btnDetalles"]."";
        $respuesta = consumir_servicios_REST($url, "GET");
        $obj = json_decode($respuesta, true);
        if (!$obj)
            die("<p> Error consumiendo servicio web <strong>" . $url . "</strong></p></body></html>");

        if (isset($obj["error"]))
            die("<p> " . $obj["error"] . "</p></body></html>");
        
        if (isset($obj["mensaje"]))
            die("<p> " . $obj["mensaje"] . "</p></body></html>");
        
        echo "<p> El producto con el código ".$obj["productos"][0]["cod"]." es:</p>";
        echo "<p><b>Nombre_corto:</b> ".$obj["productos"][0]["nombre_corto"]."</p>";
        echo "<p><b>Precio:</b> ".$obj["productos"][0]["PVP"]."</p>";
        echo "<p><b>Descripción:</b> ".$obj["productos"][0]["descripcion"]."</p>";
        echo "<p><b>Familia:</b> ".$obj["productos"][0]["familia"]."</p>";
        echo "<p><form action='index.php'><button type='submit'>Volver</button></form></p>";
    }

    $url = DIR_SERV . "/productos";
    $respuesta = consumir_servicios_REST($url, "GET");
    $obj = json_decode($respuesta, true);
    if (!$obj)
        die("<p> Error consumiendo servicio web <strong>" . $url . "</strong></p></body></html>");

    if (isset($obj["error"]))
        die("<p> " . $obj["error"] . "</p></body></html>");

    // Tabla de cod, nombre corto y pvp
    echo "<table>";
    echo "<tr><th>Código</th><th>Nombre</th><th>PVP</th><th><form action='index.php' method='post'><button type='submit' name='btnAgregar' class='enlace'>Usuario+</button></form></th></tr>";
    foreach ($obj["productos"] as $tupla) {
        echo "<tr>";
        echo "<td><form action='index.php' method='post'><button title='Pulse para ver detalles' class='enlace' name='btnDetalles' value='".$tupla["cod"]."' type='submit' >".$tupla["cod"]."</button></form></td>";
        echo "<td>".$tupla["nombre_corto"]."</td>";
        echo "<td>".$tupla["PVP"]."</td>";
        echo "<td><form action='index.php' method='post'><input name='id_usuario' type='hidden' value='".$tupla["cod"]."'/><button class='enlace' type='submit' name='btnBorrar'>Borrar</button> - <button class='enlace' type='submit' name='btnEditar'>Editar</button></form></td>";
        echo "</tr>";
    }
    echo "</table>";

  
    ?>
</body>

</html>