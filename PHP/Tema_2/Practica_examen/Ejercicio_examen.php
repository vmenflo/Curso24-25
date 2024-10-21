<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fechas</title>
    <style>
        table,td,th,tr {
            border:1px solid black;
            padding:0.2rem;
        }
        table, td, tr {
            border-collapse:collapse;
        }
    </style>
</head>
<body>
<form id="principal" action="Ejercicio_examen.php" method="post">
        <h1>Reserva de aulas</h1>
        <?php
        // Días de la semana
        $dias[0] = "Domingo";
        $dias[] = "Lunes";
        $dias[] = "Martes";
        $dias[] = "Miércoles";
        $dias[] = "Jueves";
        $dias[] = "Viernes";
        $dias[] = "Sábado";

        // Conseguir dfecha para el value del input date
        $dia_num = date("w");
        $semana_num = date("W");
        $dia_actual = $dias[$dia_num];
        $valor_dia = date('d');
        $valor_mes = date('m');
        $valor_anyo = date('Y');
        $valor_fecha = $valor_anyo . "-" . $valor_mes . "-" . $valor_dia;
        ?>
        <p>
            <?php
            if (isset($_POST["enviar"])) {
                $d = $dias[date("w", strtotime($_POST["fecha1"]))];
                echo "<label>$d</label>";
            } else {
                echo "<label>$dia_actual</label>";
            }
            ?>
            <input name='fecha1' type='date' value="<?php if (isset($_POST["enviar"])) {echo $_POST["fecha1"];} else {echo $valor_fecha;} ?>">
            <button name='enviar'>Cambiar</button>
            <?php 
                if(isset($_POST["enviar"])){
                    $fecha = strtotime($_POST["fecha1"]);
                    // Obtener número de la semana de la fecha seleccionada
                    $num_dia_recogido = date("w",$fecha);
                    $empieza_num = date("W",$fecha);
                    // Calcular el lunes y domingo de esa semana
                    $empieza_semana = date("Y-m-d", strtotime("monday this week", $fecha));
                    $termina_semana = date("Y-m-d", strtotime("sunday this week", $fecha));
                    echo "<p> Semana: ".$empieza_num." . Comienza la semana el ".$empieza_semana." y termina el ".$termina_semana."</p>";
                }else{
                    $empieza_sem = date("Y-m-d",strtotime("monday this week", time()));
                    $termina_sem = date("Y-m-d",strtotime("sunday this week", time()));
                    echo "<p> Semana: ".$semana_num.". Comineza la semana el ".$empieza_sem." y termina el ".$termina_sem."</p>";
                }
            ?>
        </p>
        <?php
// Supongamos que ya tienes el array de días definido
$dia_horario = ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"];

// Horarios
$arr_horarios[] = "8:15-9:15";
$arr_horarios[] = "9:15-10:15";
$arr_horarios[] = "11:15-12:15";
$arr_horarios[] = "12:45-13:45";
$arr_horarios[] = "13:45-14:45";
$arr_horarios[] = "14:45-15:45";

// Tabla del horario
    echo "<table>";
        echo "<tr>";
                echo "<th>Horarios</th>";
                for ($i=0; $i <count($dia_horario) ; $i++) { 
                    echo "<th>".$dia_horario[$i]."</th>";
                }
        echo "</tr>";
        for ($j=0; $j < count($arr_horarios); $j++) { 
            echo "<tr>";
                echo "<td>".$arr_horarios[$j]."</td>";
                for ($i=0; $i < count($dia_horario) ; $i++) { 
                    echo "<th> </th>";
                }
            echo "</tr>";
        }
    echo "</table>";
?>
    </form>
</body>
</html>
