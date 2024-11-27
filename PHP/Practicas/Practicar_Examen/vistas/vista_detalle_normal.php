<?php
try
{
    $consulta="select dia,hora,nombre from horario_lectivo, grupos where horario_lectivo.grupo=grupos.id_grupo AND horario_lectivo.usuario='".$datos_usuario_log["id_usuario"]."'";
    $result_horario_profe=mysqli_query($conexion,$consulta);
    
}
catch(Exception $e)
{
    session_destroy();
    mysqli_close($conexion);
    die(error_page("Examen2 PHP","<p>No se ha podido realizar la consulta: ".$e->getMessage()."</p>"));
}


while($tupla=mysqli_fetch_assoc($result_horario_profe))
{
    if(isset($horario[$tupla["dia"]][$tupla["hora"]]))
        $horario[$tupla["dia"]][$tupla["hora"]].="/".$tupla["nombre"];
    else
        $horario[$tupla["dia"]][$tupla["hora"]]=$tupla["nombre"];
}
mysqli_free_result($result_horario_profe);

echo "<h3 class='centrado'>Horario del Profesor:".$_SESSION["usuario"]."</h3>";
echo "<table class='centrado'>";
echo "<tr>";
echo "<th></th>";
for($i=1; $i<=count(DIAS);$i++)
    echo "<th>".DIAS[$i]."</th>";
echo "</tr>";

for($hora=1;$hora<=count(HORAS);$hora++)
{
    echo "<tr>";
    echo "<th>".HORAS[$hora]."</th>";
    if($hora==4)
    {
        echo "<td colspan='5'>RECREO</td>";
    }
    else
    {
        for($dia=1;$dia<=count(DIAS);$dia++)
        {
            echo "<td>";
            if(isset($horario[$dia][$hora]))
            {
                echo $horario[$dia][$hora];
            }
            echo "</td>";
            
        }
    }
    
    echo "</tr>";
}
echo "</table>";
?>