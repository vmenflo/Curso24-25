<?php
// Función para comprobar el formato
function formato_dni($dni){
    $tamaño = strlen($dni); 
    $es_numero = true;

    // Comprobar que los primeros 8 caracteres sean números
    for ($i = 0; $i < $tamaño - 1; $i++) { 
        if (!is_numeric($dni[$i])) {
            $es_numero = false;
        }
    }

    // Comprobar que el último carácter sea una letra
    $letra = strtoupper($dni[$tamaño - 1]); // Obtener la última letra
    $es_letra = ctype_alpha($letra);

    // Validar que tiene 9 caracteres, que tiene una letra al final y números al principio
    if ($tamaño == 9 && $es_letra && $es_numero) {
        return true;
    } else {
        return false;
    }
}
// Función validar dni
function es_valido($dni){
    $solo_numeros = substr($dni,0,8);
    $calcular_letra=LetraNIF($solo_numeros);
    $dni_valido = $solo_numeros.$calcular_letra;

    if($dni == $dni_valido){
        return true;
    }else {
        return false;
    }
}
// Función que calcula la letra del dni
function LetraNIF($dni){
     return substr("TRWAGMYFPDXBNJZSQVHLCKEO", $dni % 23, 1);
}

//Función para comprobar la extensión
function tiene_extension($texto){
    $array_nombre = explode(".",$texto);
    if(count($array_nombre)<=1){
        $respuesta = false; // si no tiene devuelve falso
    }else{
        $respuesta = end($array_nombre); // si tiene devuelve la extension
    }

    return $respuesta;
}

?>