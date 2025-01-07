<?php

require __DIR__ . '/Slim/autoload.php';

$app= new \Slim\App;

$app->get('/saludo',function(){

    $respuesta["mensaje"]="Hola que tal?";
    echo json_encode($respuesta);
});

$app->get('/saludo/{nombre}',function($request){
    $nombre=$request->getAttribute("nombre");
    $respuesta["mensaje"]="Hola que tal, ".$nombre."?";
    echo json_encode($respuesta);
});

$app->post('/saludo',function($request){

    $nombre=$request->getParam("nombre");
    $respuesta["mensaje"]="Hola que tal, ".$nombre."?";
    echo json_encode($respuesta);

});

$app->delete('/borrar/{id}',function($request){
    $nombre=$request->getAttribute("id");
    $respuesta["mensaje"]="El id=".$nombre." se ha borrado con éxito.";
    echo json_encode($respuesta);
});

$app->put('/insertar',function($request){

    $id=$request->getParam("id");
    $respuesta["mensaje"]="El id= ".$id." ha sido insertado con éxito.";
    echo json_encode($respuesta);

});

$app->run();

?>