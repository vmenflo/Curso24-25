<?php
const SERVIDOR_BD="localhost";
const USUARIO_BD="jose";
const CLAVE_BD="josefa";
const NOMBRE_BD="bd_exam_colegio2";

function error_page($titulo, $body)
{
    return '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>'.$titulo.'</title>
</head>
<body>'.$body.'
    
</body>
</html>';
}