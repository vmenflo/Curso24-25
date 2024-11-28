<h2>Hola </h2>
<?php
    echo "<table>";
        echo "<tr>";
            echo "<th>Asignaturas</th>";
            echo "<th>Notas</th>";
            echo "<th>Acción</th>";
        echo "</tr>";
        while($tupla=mysqli_fetch_assoc($result_detalle_alumno)){
            echo "<tr>";
                echo "<td>".$tupla["cod_asig"]."</td>";
                echo "<td>".$tupla["nota"]."</td>";
                echo "<td>nada</td>";
            echo "</tr>";
        }
    echo "</table>";
?>