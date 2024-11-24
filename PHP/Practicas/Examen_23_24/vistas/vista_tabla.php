<?php
echo "<h3>Horario del Profesor: ".$nombre_profesor."</h3>";
$dias[]="";
$dias[]="Lunes";
$dias[]="Martes";
$dias[]="Miércoles";
$dias[]="Jueves";
$dias[]="Viernes";

$horas=["8:15-9:15","9:15-10:15","10:15-11:15","11:15-11:45","11:45-12:45","12:45-13:45","13:45-14:45"];

echo "<table>";
    echo "<tr>";
        for ($i=0; $i < count($dias); $i++) { 
            echo "<th>".$dias[$i]."</th>";
        }
    echo "</tr>";
    for ($i=0; $i <count($horas); $i++) { 
        echo "<tr>";
            echo "<th>".$horas[$i]."</th>";
            if($i===3){
                echo "<td colspan='5'> Descanso</td>";
            }else{
            for ($j=1; $j < count($dias); $j++) {
                echo "<td>";
                    if(isset($horario[$j][$i+1])){
                        echo "<span>".$horario[$j][$i+1]."</span>";
                    }
                    echo "<form action='index.php' method='post'><button type='submit' name='btnEditar'>Editar</button></form>";
                echo "</td>";
                }
            }
        echo "</tr>";
    }
echo "</table>";
?>