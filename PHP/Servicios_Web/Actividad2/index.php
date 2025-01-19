<?php
session_name("Actividad2");
session_start();
require "src/funciones_ctes.php";

// Errores del formulario
if(isset($_POST["btnContAgregar"])){
    // Codigo
    $error_cod = $_POST["cod"]=="";
    if(!$error_cod){
        $url = DIR_SERV . "/repetido/producto/cod/".urlencode($_POST["cod"]);
        $respuesta = consumir_servicios_REST($url, "GET");
        $json_repetido = json_decode($respuesta, true);
        if (!$json_repetido){
            session_destroy();
            die("<p> Error consumiendo servicio web <strong>" . $url . "</strong></p></body></html>");
        }  

        if (isset($json_repetido["error"])){
            session_destroy();
            die(error_page("Actividad2", "<p>Error consumiendo el servicio rest: " . $url . "</p>"));
        }
           

        if (isset($json_repetido["mensaje"])){
            session_destroy();
            die(error_page("Actividad 2", "<p>" . $json_repetido["mensaje"] . "</p>"));
        }
            

        $error_cod = $json_repetido["repetido"];
    }
    // Nombre corto
    $error_nombre_corto = $_POST["nombre_corto"]=="";
    if(!$error_nombre_corto){
        $url = DIR_SERV . "/repetido/producto/nombre_corto/".urlencode($_POST["nombre_corto"]);
        $respuesta = consumir_servicios_REST($url, "GET");
        $json_repetido = json_decode($respuesta, true);
        if (!$json_repetido){
            session_destroy();
            die("<p> Error consumiendo servicio web <strong>" . $url . "</strong></p></body></html>");
        }
            

        if (isset($json_repetido["error"])){
            session_destroy();
            die(error_page("Actividad2", "<p>Error consumiendo el servicio rest: " . $url . "</p>"));
        }

        if (isset($json_repetido["mensaje"])){
            session_destroy();
            die(error_page("Actividad 2", "<p>" . $json_repetido["mensaje"] . "</p>"));
        }

        $error_nombre_corto = $json_repetido["repetido"];
    }
    // Nombre no controla errores

    // Error descripcion
    $error_descripcion = $_POST["descripcion"]=="";
    // PVP
    $error_pvp = $_POST["pvp"]=="" || !is_numeric($_POST["pvp"]) || $_POST["pvp"]<=0;

    $error_form=$error_cod || $error_descripcion || $error_nombre_corto || $error_pvp;

    if(!$error_form){
        // Inserto y salgo con mensaje
        $url = DIR_SERV . "/producto/insertar";
        $respuesta = consumir_servicios_REST($url, "POST",$_POST);
        $json_insertar = json_decode($respuesta, true);
        if (!$json_insertar){
            session_destroy();
            die("<p> Error consumiendo servicio web <strong>" . $url . "</strong></p></body></html>");
        }

        if (isset($json_insertar["error"])){
            session_destroy();
            die(error_page("Actividad2", "<p>Error consumiendo el servicio rest: " . $url . "</p>"));
        }

        $_SESSION["mensaje"]="Producto insertado con éxito";
        header("location:index.php");
        exit;
    }

}

// Editar
if(isset($_POST["btnContEditar"]))
{
   

    $error_nombre_corto=$_POST["nombre_corto"]=="";
    if(!$error_nombre_corto)
    {
        $url=DIR_SERV."/repetido/producto/nombre_corto/".urlencode($_POST["nombre_corto"])."/cod/".urlencode($_POST["cod"]);
        $respuesta=consumir_servicios_REST($url,"GET");
        $json_repetido=json_decode($respuesta,true);
        if(!$json_repetido)
        {
            session_destroy();
            die(error_page("Actividad 2","<p>Error consumiendo el servico rest: <strong>".$url."</strong></p>"));
        }

        if(isset($json_repetido["error"]))
        {
            session_destroy();
            die(error_page("Actividad 2","<p>".$json_repetido["error"]."</p>"));
        }

        $error_nombre_corto=$json_repetido["repetido"];
    }
    $error_descripcion=$_POST["descripcion"]=="";
    $error_PVP=$_POST["PVP"]=="" || !is_numeric($_POST["PVP"]) || $_POST["PVP"]<=0;

    $error_form=$error_nombre_corto || $error_descripcion || $error_PVP;

    if(!$error_form)
    {
        //edito y salto con mensaje

        $url=DIR_SERV."/producto/actualizar/".urlencode($_POST["cod"]);
        unset($_POST["btnContEditar"]);
        unset($_POST["cod"]);
        $respuesta=consumir_servicios_REST($url,"PUT",$_POST);
        $json_actualizar=json_decode($respuesta,true);
        if(!$json_actualizar)
        {
            session_destroy();
            die(error_page("Actividad 2","<p>Error consumiendo el servico rest: <strong>".$url."</strong></p>"));
        }

        if(isset($json_actualizar["error"]))
        {
            session_destroy();
            die(error_page("Actividad 2","<p>".$json_actualizar["error"]."</p>"));
        }

        $_SESSION["mensaje"]="¡¡ Producto actualizado con éxito !!";
        header("Location:index.php");
        exit;

    }

}

// un producto en concreto
if(isset($_POST["btnDetalles"]) || isset($_POST["btnEditar"])){
    
    $cod = $_POST["id_usuario"];

    $url = DIR_SERV . "/producto/".urlencode($cod);
    $respuesta = consumir_servicios_REST($url, "GET");
    $json_detalles = json_decode($respuesta, true);
    if (!$json_detalles){
        session_destroy();
        die("<p> Error consumiendo servicio web <strong>" . $url . "</strong></p></body></html>");
    }

    if (isset($json_detalles["error"])){
        session_destroy();
        die(error_page("Actividad2", "<p>Error consumiendo el servicio rest: " . $url . "</p>"));
    }

    if (isset($json_detalles["mensaje"])){
        session_destroy();
        die(error_page("Actividad 2", "<p>" . $json_detalles["mensaje"] . "</p>"));
    }
}

// Si pulsamos continuar borrado
if (isset($_POST["btnContBorrar"])) {
    $url = DIR_SERV . "/producto/borrar/" . $_POST["btnContBorrar"] . "";
    $respuesta = consumir_servicios_REST($url, "DELETE");
    $json_borrar = json_decode($respuesta, true);
    if (!$json_borrar){
        session_destroy();
        die(error_page("Actividad2", "<p>Error consumiendo el servicio rest: " . $url . "</p>"));
    }

    if (isset($json_borrar["error"])){
        session_destroy();
        die(error_page("Actividad 2", "<p>" . $json_borrar["error"] . "</p>"));
    }

    $_SESSION["mensaje"] = "Se ha eliminado el producto: " . $_POST["btnContBorrar"];
    header("Location:index.php");
    exit;
}

// Pulsamos boton agregar
if(isset($_POST["btnNuevo"])||isset($_POST["btnContNuevo"])||isset($_POST["btnEditar"])||isset($_POST["btnContEditar"]))
{
    $url = DIR_SERV . "/familias";
    $respuesta = consumir_servicios_REST($url, "GET");
    $json_familias = json_decode($respuesta, true);
    if (!$json_familias){
        session_destroy();
        die("<p> Error consumiendo servicio web <strong>" . $url . "</strong></p></body></html>");
    }

    if (isset($json_familias["error"])){
        session_destroy();
        die(error_page("Actividad2", "<p>" . $json_familias["error"] . "</p>"));
    }

    if (isset($json_familias["mensaje"])){
        session_destroy();
        die(error_page("Actividad 2", "<p>" . $json_familias["mensaje"] . "</p>"));
    }
}


// Listar los productos nada mas iniciar
$url = DIR_SERV . "/productos";
$respuesta = consumir_servicios_REST($url, "GET");
$json_productos = json_decode($respuesta, true);
if (!$json_productos)
    die(error_page("Actividad 2", "<p> Error consumiendo el servicio rest:" . $url . "</p>"));

if (isset($json_productos["error"]))
    die(error_page("Actividad 2", "<p>" . $json_productos["error"] . "</p>"));


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actividad 2</title>
    <style>
        .centrado {
            width: 85%;
            margin: 0 auto;
        }

        .txt_centrado {
            text-align: center;
        }

        table,
        td,
        th {
            border: 1px solid black;
            padding: 0.5rem;
        }

        th {
            background-color: #CCC;
        }

        table {
            border-collapse: collapse;
            text-align: center;
        }

        .enlace {
            color: blue;
            text-decoration: underline;
            cursor: pointer;
            background: none;
            border: none
        }
    </style>
</head>

<body>
    <h1 class="centrado txt_centrado">Listado de los productos</h1>
    <?php

    // Si existe botón editar
    if(isset($_POST["btnEditar"]) || (isset($_POST["btnContEditar"]) && $error_form)){
        if(isset($json_detalles)){
            if(isset($json_detalles["producto"])){
                $cod=$json_detalles["producto"]["cod"];
                $nombre=$json_detalles["producto"]["nombre"];
                $nombre_corto=$json_detalles["producto"]["nombre_corto"];
                $descripcion=$json_detalles["producto"]["descripcion"];
                $pvp=$json_detalles["producto"]["PVP"];
                $familia=$json_detalles["producto"]["familia"];

            }else{
                session_destroy();
                die("<p> El producto ya no se encuentra en la BD</p></body></html>");
            }
        }else{
                $cod=$_POST["cod"];
                $nombre=$_POST["nombre"];
                $nombre_corto=$_POST["nombre_corto"];
                $descripcion=$_POST["descripcion"];
                $pvp=$_POST["pvp"];
                $familia=$_POST["familia"];
        }

        require "vistas/vista_editar.php";

    }

    // Si existe el botón agregar
    if(isset($_POST["btnAgregar"]) || (isset($_POST["btnContAgregar"]) && $error_form)){
        require "vistas/vista_agregar.php";
    }

    // Si existe botón detalles 
    if (isset($_POST["btnDetalles"])) {
        require "vistas/vista_detalles.php";
    }

    // Si existe botón borrar
    if (isset($_POST["btnBorrar"])) {
        require "vistas/vista_borrar.php";
    }

    if (isset($_SESSION["mensaje"])) {
        echo "<p class='txt_centrado centrado'>" . $_SESSION["mensaje"] . "</p>";
        session_destroy();
    }

    require "vistas/vista_tabla.php";

    ?>
</body>

</html>