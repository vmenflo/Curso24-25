<?php
function valido($texto){
    $valido=true;
    $palabras = explode(" ", trim($texto));
    for ($i=0; $i < count($palabras); $i++) { 
       for ($j=0; $j < strlen($palabras[$i]); $j++) { 
            if(($palabras[$i][$j] <= ord("A") || $palabras[$i][$j] >= ord("Z")) && $palabras[$i][$j]==="ñ" && $palabras[$i][$j]==="Ñ"){
                $valido = false;
                break;
            }
       }
    }
    return $valido;
}

if(isset($_POST["enviar"])){
    $error1 = $_POST["texto"]==="" || !valido($_POST["texto"]);
    $error2= $_POST["desp"]==="" || !is_numeric($_POST["desp"]) || $_POST["desp"]<0 || $_POST["desp"]>27;
    $error_files = $_FILES["archivo"]["error"] || $_FILES["archivo"]["size"]>1.25*1024*1024 || $_FILES["archivo"]["type"]!="text/plain";
    $error_form = $error1 || $error2 || $error_files;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
</head>
<body>
    <h1>Ejercicio 3</h1>
    <form action="Ejer3.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="texto">Introduzca un texto: </label>
            <input type="text" name="texto" id="texto" value="<?php if(isset($_POST["texto"])){echo $_POST["texto"];}?>">
            <?php
                if(isset($_POST["enviar"]) && $error1){
                    if($_POST["texto"]===""){
                        echo "<span> Campo vacío </span>";
                    }else{
                        echo "<span> Solo letras de la A a la Z </span>";
                    }
                }
            ?>
        </p>
        <p>
            <label for="desp">Desplazamiento</label>
            <input type="text" name="desp" id="desp"  value="<?php if(isset($_POST["desp"])){echo $_POST["desp"];}?>">
            <?php
                if(isset($_POST["enviar"]) && $error2){
                    if($_POST["desp"]===""){
                        echo "<span> Campo vacío </span>";
                    }elseif($_POST["desp"]<0 || $_POST["desp"]>27){
                        echo "<span> 1-26 </span>";
                    }else{
                        echo "<span> Solo números </span>";
                    }
                }
            ?>
        </p>
        <p>
            <label for="archivo">Seleccione el archivo de claves (menor de 1.25MB y .txt)</label>
            <input type="file" name="archivo" id="archivo">
            <?php 
                if(isset($_POST["enviar"]) && $error_files){
                    if($_FILES["archivo"]["name"]===""){
                        echo "<span> Error debes subir un archivo </span>";
                    }elseif($_FILES["archivo"]["type"]!=="text/plain"){
                        echo "<span> Solo puedes subir extension txt </span>";
                    }else{
                        echo "<span> Error archivo demasiado pesado </span>";
                    }
                }
            ?>
        </p>
        <button type="submit" name="enviar">Codificar</button>
    </form>
    <?php
        if(isset($_POST["enviar"]) && !$error_form){
           @$file = fopen($_FILES["archivo"]["tmp_name"],"r");

           if(!$file){
            die("<p> No se ha podido abrir el fichero</p>");
           }else{
                $linea= fgets($file);
                $i=0; 
                while($linea=fgets($file)){
                    $letras=explode(";", trim($linea));
                       for ($j=0; $j < count($letras) ; $j++) { 
                        $matriz[$i][$j]=$letras[$j];
                       }
                    $i++;
                }
                // la frase
                $frase = $_POST["texto"];
                $texto_codificado="";

                for ($i=0; $i < strlen($frase) ; $i++) { 
                    if($frase[$i]>= "A" && $frase[$i] <= "Z"){
                        $texto_codificado .= $matriz[ord($frase[$i])-ord("A")][$_POST["desp"]];
                    }else{
                        $texto_codificado.=$frase[$i];
                    }
                    
                }

                echo "<p>".$texto_codificado."</p>";
                fclose($file);
           }
        }
    ?>
</body>
</html>