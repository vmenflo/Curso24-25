<?php

require __DIR__ . '/Slim/autoload.php';

$app = new \Slim\App;

// Vamos a necesitar conectarnos a una BD: Tienda.

require "src/funciones_ctes.php";

// Ejercicio 1
// Usaremos el método GET 
$app->get('/productos', function () {

    echo json_encode(obtener_productos()); //Obtener productos es una función que nos devuelve un array de los productos
});

// Ejercicio 2
$app->get('/producto/{codigo}', function($request){
    $cod=$request->getAttribute("codigo");
    echo json_encode(obtener_producto($cod));
});

// Ejercicio 3
$app->put('/producto/insertar',function($request){
    $cod=$request->getParam("cod");
    $nombre=$request->getParam("nombre");
    $nombre_corto=$request->getParam("nombre_corto");
    $descripcion=$request->getParam("descripcion");
    $pvp=$request->getParam("pvp");
    $familia=$request->getParam("familia");

    echo json_encode(insertar_producto($cod,$nombre,$nombre_corto,$descripcion,$pvp,$familia));
});

// Ejercicio 4
$app->put('/producto/actualizar/{cod}/{nombre}/{nombre_corto}/{descripcion}/{pvp}/{familia}',function($request){
    $cod=$request->getAttribute("cod");
    $nombre=$request->getAttribute("nombre");
    $nombre_corto=$request->getAttribute("nombre_corto");
    $descripcion=$request->getAttribute("descripcion");
    $pvp=$request->getAttribute("pvp");
    $familia=$request->getAttribute("familia");

    echo json_encode(actualizar_producto($cod,$nombre,$nombre_corto,$descripcion,$pvp,$familia));
});

// Ejercicio 5

$app->delete('/producto/borrar/{cod}',function($request){
    $cod=$request->getAttribute("cod");

    echo json_encode(borrar_producto($cod));
});

$app->run();
