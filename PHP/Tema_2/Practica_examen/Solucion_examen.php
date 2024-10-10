<?php
    $fecha = date("Y-m-d"); // día de hoy
    // Array constante de los días de la semana
    const DIAS_SEMANA=array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
    //Segundos de un día
    const SEGUNDOS_DIA = 60*60*24;
    // CLAVE PARA HACER EL EXAMEN
    if(isset($_POST["fecha"]) && $_POST["fecha"]!=""){ // Si existe este campo coge estos datos
        $fecha=$_POST["fecha"];
       
    }else{ // Sino el actual
        $fecha=date("Y-m-d");
    }

    $segundos_fecha=strtotime($fecha);
    $dia_semana = date("w", $segundos_fecha); // día de la semana
    // días pasado
    $dias_pasados = $dia_semana-1;
    if($dias_pasados==-1){
        $dias_pasados=6;
    }
    $primer_dia=$segundos_fecha-($dias_pasados*SEGUNDOS_DIA);
    $ultimo_dia=$primer_dia+(6*SEGUNDOS_DIA);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solucion Examen</title>
    <style>
        table,th,td{
            border:1px black solid;
        }
        table{
            width:80%; margin:0 auto; border-collapse:collapse;margin-top:2rem;
        }
    </style>
</head>
<body>
    <!--Funciones que hemos visto de fecha:
    date() -> hace un string de un numero, te formatea al año actual
    date("Y", 3561234); te formatea a ese año

    time() -> te dice la fecha de hoy en el momento que se ejecuta
    checkdate(mes,dia,año) - > para comprobar que una fecha es válida y devuelve true or false
    Te doy una fecha y quiero saber cuantos segundos han pasado:
    -mktime(h,m,s,mes,dia,añoñ) - > y te dice los segundos pasados desde 1970
    -strtotime("Y-m-d")
    -->
    <h1>Reserva de aulas</h1>
    <form id="form_fecha" action="Solucion_examen.php" method="post">
    <p>
        <label for="fecha"><?php echo DIAS_SEMANA[$dia_semana];?></label>
        <input type="date" name="fecha" onchange="document.getElementById('form_fecha').submit();" id="fecha" value="<?php echo $fecha; ?>">
    </p>
    <p>
        Semana del <?php echo date("d/m/Y",$primer_dia);?>  al <?php echo date("d/m/Y",$ultimo_dia);?>
    </p>
    </form>

    <?php 
    $horas[1]="8:15-9:15";
    $horas[] ="9:15-10:15";
    $horas[] = "10:15-11:15";
    $horas[] = "11:15-11:45";
    $horas[]="11:45-12:45";
    $horas[] ="12:45-13:45";
    $horas[] = "13:45-14:45";

        echo "<table>";
            echo "<tr>";
                echo "<th></th>";
                for ($i=1; $i <=5 ; $i++) { 
                    echo "<th>".DIAS_SEMANA[$i]."</th>";
                }
            echo "</tr>";
            for ($j=1; $j <=7 ; $j++) { 
                echo "<tr>";
                    echo "<th>".$horas[$j]."</th>";
                    if($j==4){
                        echo "<td colspan='5'>Recreo</td>";
                    }else{
                        for ($i=1; $i<=5 ; $i++) { 
                            echo "<td></td>";
                        }
                    }
                echo "</tr>";    
            }
        echo "</table>";
    ?>
    
</body>
</html>