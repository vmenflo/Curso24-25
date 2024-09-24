<?php

echo "<h1> Estos son los datos enviados </h1>";
echo "<p><strong>Nombre enviado: </strong>".$_POST["nombre"]." </p>";
echo "<p><strong>Nacido en: </strong>:".$_POST["nacido"]." </p>";
echo "<p><strong>Sexo: </strong>".$_POST["sexo"]."</p>";

if(isset($_POST["aficiones"])){

    if(count($_POST["aficiones"])==1){
        echo "<p><strong>La afición seleccionada es: </strong></p>";
        echo "<ol>";
        echo "<li>".$_POST["aficiones"][0]." </li>";
        echo "</ol>";
    } else {
        echo "<p> <strong>Las aficiones seleccinadas han sido:</strong> </p>";
        echo "<ol>";
        for ($i=0; $i < count($_POST["aficiones"]) ;$i++) { 
            echo "<li>".$_POST["aficiones"][$i]."</li>";
        }
        echo "</ol>";
    }

} else {
    echo "<p><strong> No has seleccionado ninguna afición</strong></p>";
}

if($_POST["comentarios"]==""){
    echo "<p><strong> No has hecho ningún comentario</strong> </p>";
} else {
    echo "<p><strong> El comentario enviado ha sido: </strong>".$_POST["comentarios"]." </p>";
}

?>