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

$app->run();
