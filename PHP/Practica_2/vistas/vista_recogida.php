<?php
echo "<h1> Estos son los datos enviados </h1>";
echo "<p><strong>Nombre enviado: </strong>".$_POST["nombre"]." </p>";
echo "<p><strong>Nacido en: </strong>:".$_POST["nacido"]." </p>";

if(isset($_POST["aficiones"])){
    echo "<p> Las aficiones seleccinadas han sido: </p>";
    echo "<ol>";
    for ($i=0; $i < count($_POST["aficiones"]) ;$i++) { 
        echo "<li>".$_POST["aficiones"]."</li>";
    }
    echo "</ol>";
} else {
    echo "<p><strong> No has seleccionado ninguna afición</strong></p>";
}

?>