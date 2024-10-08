<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fechas</title>
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

        // Conseguir número para el value al empezar
        $dia_num = date("w");
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
        </p>
    </form>
    <?php
    // Mostrar semanas
    if (isset($_POST["enviar"])) {
        $fecha = $_POST["fecha1"];
        $timestamp = strtotime($fecha);
        
        // Obtener número de la semana de la fecha seleccionada
        $empieza_num = date("W", $timestamp);
        
        // Calcular el lunes y domingo de esa semana
        $empieza_semana = date("Y-m-d", strtotime("last monday", $timestamp));
        $termina_semana = date("Y-m-d", strtotime("sunday", $timestamp));

        echo "<div id='resultado'><p> Semana $empieza_num : del $empieza_semana al $termina_semana </p></div>";
    }
    ?>
</body>
</html>
