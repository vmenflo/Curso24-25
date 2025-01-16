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
$app->post('/producto/insertar',function($request){
    $datos[]=$request->getParam("cod");
    $datos[]=$request->getParam("nombre");
    $datos[]=$request->getParam("nombre_corto");
    $datos[]=$request->getParam("descripcion");
    $datos[]=$request->getParam("pvp");
    $datos[]=$request->getParam("familia");

    echo json_encode(insertar_producto($datos));
});

// Ejercicio 4
$app->put('/producto/actualizar/{codido}',function($request){
    $datos[]=$request->getParam("nombre");
    $datos[]=$request->getParam("nombre_corto");
    $datos[]=$request->getParam("descripcion");
    $datos[]=$request->getParam("pvp");
    $datos[]=$request->getParam("familia");
    $datos[]=$request->getAttribute("codigo");

    echo json_encode(actualizar_producto($datos));
});

// Ejercicio 5

$app->delete('/producto/borrar/{codigo}',function($request){
    $cod=$request->getAttribute("codigo");

    echo json_encode(borrar_producto($cod));
});

// Ejercicio 6
$app->get('/familias',function($request){

    echo json_encode(obtener_familias());
});

// Ejercicio 7
$app->get('/repetido/{tabla}/{columna}/{valor}',function($request){

    $tabla=$request->getAttribute("tabla");
    $columna=$request->getAttribute("columna");
    $valor=$request->getAttribute("valor");
    echo json_encode(es_repetido($tabla, $columna,$valor));
});

$app->get('/repetido/{tabla}/{columna}/{valor}/{id_columna}/{id_valor}',function($request){
    $tabla=$request->getAttribute("tabla");
    $columna=$request->getAttribute("columna");
    $valor=$request->getAttribute("valor");
    $columna_id=$request->getAttribute("id_columna");
    $valor_id=$request->getAttribute("id_valor");

    echo json_encode(es_repetido_editar($tabla,$columna,$valor,$columna_id,$valor_id));
});

$app->run();
