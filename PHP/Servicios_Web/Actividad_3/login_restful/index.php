<?php

require __DIR__ . '/Slim/autoload.php';
require "src/funciones_CTES_servicios.php";


$app= new \Slim\App;

$app->get('/usuarios',function(){
    $test=validateToken();
    if(is_array($test))
        if(isset($test["usuario"]))
            if($test["usuario"]["tipo"]=="admin")
                echo json_encode(obtener_usuarios());
            else
                echo json_encode(array("no_auth"=>"No tienes permisos para usar este servicio"));
        else
            echo json_encode($test);
    else
        echo json_encode(array("no_auth"=>"No tienes permisos para usar este servicio"));
});

$app->post('/crearUsuario', function($request){
    $test=validateToken();
    if(is_array($test))
        if(isset($test["usuario"]))
            if($test["usuario"]["tipo"]=="admin"){
                $datos[] = $request->getParam("nombre");
                $datos[] = $request->getParam("usuario");
                $datos[] = $request->getParam("clave");
                $datos[] = $request->getParam("email");
                echo json_encode(crear_usuario($datos));
            }else
                echo json_encode(array("no_auth"=>"No tienes permisos para usar este servicio"));
        else
            echo json_encode($test);
    else
        echo json_encode(array("no_auth"=>"No tienes permisos para usar este servicio"));
});

$app->post('/login',function($request){

    $datos[]=$request->getParam("usuario");
    $datos[]=$request->getParam("clave");
    echo json_encode(login($datos));
            
});

$app->put('/actualizarUsuario/{id_usuario}',function($request){
    $test=validateToken();
    if(is_array($test))
        if(isset($test["usuario"]))
            if($test["usuario"]["tipo"]=="admin"){
                $datos[] = $request->getParam("nombre");
                $datos[] = $request->getParam("usuario");
                $datos[] = $request->getParam("clave");
                $datos[] = $request->getParam("email");
                $datos[] = $request->getAttribute("id_usuario");
                echo json_encode(actualizar_usuario($datos));
            }else
                echo json_encode(array("no_auth"=>"No tienes permisos para usar este servicio"));
        else
            echo json_encode($test);
    else
        echo json_encode(array("no_auth"=>"No tienes permisos para usar este servicio"));
});

$app->delete('/borrarUsuario/{id_usuario}', function($request){
    $test=validateToken();
    if(is_array($test))
        if(isset($test["usuario"]))
            if($test["usuario"]["tipo"]=="admin"){
                $id_usuario = $request->getAttribute("id_usuario");
                echo json_encode(borrar_usuario($id_usuario));
            }else
                echo json_encode(array("no_auth"=>"No tienes permisos para usar este servicio"));
        else
            echo json_encode($test);
    else
        echo json_encode(array("no_auth"=>"No tienes permisos para usar este servicio"));
});

$app->get('/logueado',function(){
    $test=validateToken();
    if(is_array($test))
        echo json_encode($test);
    else
        echo json_encode(array("no_auth"=>"No tienes permisos para usar este servicio"));
});

$app->run();

?>
