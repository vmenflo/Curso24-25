<?php

require __DIR__ . '/Slim/autoload.php';

$app = new \Slim\App;

// usuario, clave (ya viene en md5)
// error, mensaje, usuario
$app->post("/login", function ($request) {
    
    $usuario = $request->getParam("usuario");
    $clave = $request->getParam("clave");

    echo json_encode(login($usuario, $clave));
});

$app->run();
