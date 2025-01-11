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
</head>

<body>
    <h1>Productos de la Tienda</h1>
    <h2>Actividad 1</h2>
    <h3>Ejercicio 1</h3>
    <?php
    $url = DIR_SERV . "/productos";
    $respuesta = consumir_servicios_REST($url, "GET");
    $obj = json_decode($respuesta, true);
    if (!$obj)
        die("<p> Error consumiendo servicio web <strong>" . $url . "</strong></p></body></html>");

    if (isset($obj["error"]))
        die("<p> " . $obj["error"] . "</p></body></html>");

    // Tabla de cod, nombre corto y pvp
    echo "<table>";
    echo "<tr><th>Código</th><th>Nombre</th><th>PVP</th></tr>";
    foreach ($obj["productos"] as $tupla) {
        echo "<tr>";
        echo "<td>".$tupla["cod"]."</td>";
        echo "<td>".$tupla["nombre_corto"]."</td>";
        echo "<td>".$tupla["PVP"]."</td>";
        echo "</tr>";
    }
    echo "</table>";

    echo "<hr/>";

    // Ejercicio 2
    echo "<h3>Ejercicio 2 </h3>";
    $url = DIR_SERV . "/producto/ACERAX3950";
    $respuesta = consumir_servicios_REST($url, "GET");
    $obj = json_decode($respuesta, true);
    if (!$obj)
        die("<p> Error consumiendo servicio web <strong>" . $url . "</strong></p></body></html>");

    if (isset($obj["error"]))
        die("<p> " . $obj["error"] . "</p></body></html>");
    
    if (isset($obj["mensaje"]))
        die("<p> " . $obj["mensaje"] . "</p></body></html>");
    
    echo "<p> El producto con el código".$obj["productos"][0]["cod"]." es:</p>";
    echo "<p><b>Nombre:</b> ".$obj["productos"][0]["nombre_corto"]."</p>";
    echo "<p><b>Precio:</b> ".$obj["productos"][0]["PVP"]."</p>";

    echo "<hr/>";

    // Ejercicio 3
    echo "<h3>Ejercicio 3 </h3>";
    
    $url = DIR_SERV . "/producto/insertar";
    $datos_env["cod"]="prueba1";
    $datos_env["nombre"]="ratón";
    $datos_env["nombre_corto"]="mouse";
    $datos_env["pvp"]="10";
    $datos_env["familia"]="hardware";
    $datos_env["descripcion"]="para mover el puntero";
    $respuesta = consumir_servicios_REST($url,"POST",$datos_env);
    $obj = json_decode($respuesta, true);

    if (!$obj)
        die("<p> Error consumiendo servicio web <strong>" . $url . "</strong></p></body></html>");

    if (isset($obj["error"]))
        die("<p> " . $obj["error"] . "</p></body></html>");
    
    if (isset($obj["mensaje"]))
        echo "<p> " . $obj["mensaje"] . "</p>";
    
    echo "<hr/>";

    // Ejercicio 4
    echo "<h3>Ejercicio 4 </h3>";
    $url = DIR_SERV . "/producto/actualizar/prueba1/teclado/teclado/para_escribir/10/hardware";
    $respuesta = consumir_servicios_REST($url,"PUT");
    $obj = json_decode($respuesta, true);

    if (!$obj)
        die("<p> Error consumiendo servicio web <strong>" . $url . "</strong></p></body></html>");

    if (isset($obj["error"]))
        die("<p> " . $obj["error"] . "</p></body></html>");
    
    if (isset($obj["mensaje"]))
        echo "<p> " . $obj["mensaje"] . "</p>";

        
    echo "<hr/>";

    // Ejercicio 5
    echo "<h3>Ejercicio 5 </h3>";
    $url = DIR_SERV . "/producto/borrar/prueba1";
    $respuesta = consumir_servicios_REST($url,"DELETE");
    $obj = json_decode($respuesta, true);

    if (!$obj)
        die("<p> Error consumiendo servicio web <strong>" . $url . "</strong></p></body></html>");

    if (isset($obj["error"]))
        die("<p> " . $obj["error"] . "</p></body></html>");
    
    if (isset($obj["mensaje"]))
        echo "<p> " . $obj["mensaje"] . "</p>";

    echo "<hr/>";

    // Ejercicio 6
    echo "<h3>Ejercicio 6 </h3>";
    $url= DIR_SERV . "/familias";
    $respuesta = consumir_servicios_REST($url,"GET");
    $obj = json_decode($respuesta, true);

    if(!$obj){
        die("<p> Error consumiendo servicio web ". $url . "</strong></p></body></html>");
    }

    if(isset($obj["error"])){
        die("<p> " . $obj["error"] . "</p></body></html>");
    }

    echo "<table>";
    echo "<tr>";
        echo "<th>COD</th><th>NOMBRE</th>";
    echo "</tr>";
        foreach($obj["familia"] as $tupla){
            echo "<tr>";
                echo "<td>".$tupla["cod"]."<td>";
                echo "<td>".$tupla["nombre"]."<td>";
            echo "</tr>";
        }
    echo "</table>";

    echo "<hr/>";
    // Ejercicio 7
    echo "<h3>Ejercicio 7 </h3>";
    echo "<p> Probamos Consolas que existe en familias </p>";
    $url = DIR_SERV . "/repetido/familia/nombre/Consolas";
    $resultado = consumir_servicios_REST($url,"GET");
    $obj = json_decode($resultado, true);

    if(!$obj){
        die("<p> Error consumiendo servicio web ". $url . "</strong></p></body></html>");
    }

    if(isset($obj["error"])){
        die("<p> " . $obj["error"] . "</p></body></html>");
    }
    if(isset($obj["mensaje"])){
        echo "<p> " . $obj["mensaje"] . "</p>";
    }

    echo "<p> Probamos bombilla que no existe..</p>";

    $url = DIR_SERV . "/repetido/familia/nombre/Bombillas";
    $resultado = consumir_servicios_REST($url,"GET");
    $obj = json_decode($resultado, true);

    if(!$obj){
        die("<p> Error consumiendo servicio web ". $url . "</strong></p></body></html>");
    }

    if(isset($obj["error"])){
        die("<p> " . $obj["error"] . "</p></body></html>");
    }
    if(isset($obj["mensaje"])){
        echo "<p> " . $obj["mensaje"] . "</p>";
    }


    echo "<hr/>";
    // Ejercicio 8
    echo "<h3>Ejercicio 8 </h3>";
    $url = DIR_SERV . "/repetido/familia/nombre/Consolas/cod/CONSOL";
    $resultado = consumir_servicios_REST($url,"GET");
    $obj = json_decode($resultado, true);

    if(!$obj){
        die("<p> Error consumiendo servicio web ". $url . "</strong></p></body></html>");
    }

    if(isset($obj["error"])){
        die("<p> " . $obj["error"] . "</p></body></html>");
    }
    if(isset($obj["mensaje"])){
        echo "<p> " . $obj["mensaje"] . "</p>";
    }

    ?>
</body>

</html>