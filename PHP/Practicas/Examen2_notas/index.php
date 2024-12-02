<?php
session_name("Examen2_22_23");
session_start();

require "src/funciones_ctes.php";

try{
    @$conexion=mysqli_connect(SERVIDOR_BD,USUARIO_BD,CLAVE_BD,NOMBRE_BD);
    mysqli_set_charset($conexion,"utf8");
}
catch(Exception $e)
{
    session_destroy();
    die(error_page("Examen2 22_23","<p>Imposible realizar la conexión a la BD: ".$e->getMessage()."</p>"));
}

if(isset($_POST["btnBorrar"]))
{
    try{
        $consulta="delete from notas where cod_alu='".$_POST["alumno"]."' and cod_asig='".$_POST["asignatura"]."'";
       mysqli_query($conexion,$consulta);
    }
    catch(Exception $e)
    {
        session_destroy();
        mysqli_close($conexion);
        die(error_page("Examen2 22_23","<p>Imposible realizar la consulta: ".$e->getMessage()."</p>"));
    }

    $_SESSION["mensaje_accion"]="Asignatura descalificada con éxito";
    $_SESSION["alumno"]=$_POST["alumno"];
    header("Location:index.php");
    exit;

}

if(isset($_SESSION["alumno"]))
{
    $_POST["alumno"]=$_SESSION["alumno"];
}

if(isset($_POST["btnCambiar"]))
{
    $error_form=$_POST["nota"]==""|| !is_numeric($_POST["nota"])|| $_POST["nota"]<0 || $_POST["nota"]>10;
    if(!$error_form)
    {
        try{
            $consulta="update notas set nota='".$_POST["nota"]."' where cod_alu='".$_POST["alumno"]."' and cod_asig='".$_POST["asignatura"]."'";
           mysqli_query($conexion,$consulta);
        }
        catch(Exception $e)
        {
            session_destroy();
            mysqli_close($conexion);
            die(error_page("Examen2 22_23","<p>Imposible realizar la consulta: ".$e->getMessage()."</p>"));
        }
    
        $_SESSION["mensaje_accion"]="Nota cambiada con éxito";
        $_SESSION["alumno"]=$_POST["alumno"];
        header("Location:index.php");
        exit;
    }
}

if(isset($_POST["btnCalificar"]))
{
    try{
        $consulta="insert into notas (cod_alu, cod_asig, nota) values ('".$_POST["alumno"]."','".$_POST["asignatura"]."','0.00')";
       mysqli_query($conexion,$consulta);
    }
    catch(Exception $e)
    {
        session_destroy();
        mysqli_close($conexion);
        die(error_page("Examen2 22_23","<p>Imposible realizar la consulta: ".$e->getMessage()."</p>"));
    }

    $_SESSION["mensaje_accion"]="Asignatura calificada con un cero. Cambie la nota si lo estima necesario";
    $_SESSION["asignatura"]=$_POST["asignatura"];
    $_SESSION["alumno"]=$_POST["alumno"];
    header("Location:index.php");
    exit;
}


try{
    $consulta="select * from alumnos";
    $result_alumnos=mysqli_query($conexion,$consulta);
}
catch(Exception $e)
{
    session_destroy();
    mysqli_close($conexion);
    die(error_page("Examen2 22_23","<p>Imposible realizar la consulta: ".$e->getMessage()."</p>"));
}

if(isset($_POST["alumno"]))
{
    try{
        $consulta="select notas.cod_asig, denominacion,nota from notas, asignaturas where notas.cod_asig=asignaturas.cod_asig and cod_alu='".$_POST["alumno"]."'";
        $result_notas_alumno=mysqli_query($conexion,$consulta);
    }
    catch(Exception $e)
    {
        session_destroy();
        mysqli_close($conexion);
        die(error_page("Examen2 22_23","<p>Imposible realizar la consulta: ".$e->getMessage()."</p>"));
    }


    try{
        $consulta="select asignaturas.* from asignaturas where cod_asig not in (select cod_asig from notas where cod_alu='".$_POST["alumno"]."')";
        $result_asig_no_alumno=mysqli_query($conexion,$consulta);
    }
    catch(Exception $e)
    {
        session_destroy();
        mysqli_close($conexion);
        die(error_page("Examen2 22_23","<p>Imposible realizar la consulta: ".$e->getMessage()."</p>"));
    }

    


}


mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen2 22_23</title>
    <style>
        .enlace{background: none;border:none;text-decoration:underline;color:blue;cursor:pointer}
        table, th, td{border:1px solid black;}
        th{background-color:#CCC}
        table{text-align: center;border-collapse:collapse}
        .mensaje{font-size:1.25em;color:blue}
        .error{color:red}
    </style>
</head>
<body>
    <h1>Nota de los Alumnos</h1>
    <?php
    if(mysqli_num_rows($result_alumnos)<=0)
        echo "<p>En estos momentos no tenemos ningún alumno registrado en la BD</p>";
    else
    {
    ?>
        <form action="index.php" method="post">
            <p>
                <label for="alumno">Seleccione un Alumno: </label>
                <select name="alumno" id="alumno">
                <?php
                while($tupla=mysqli_fetch_assoc($result_alumnos))
                {
                    if(isset($_POST["alumno"]) && $_POST["alumno"]==$tupla["cod_alu"])
                    {
                        echo "<option selected value='".$tupla["cod_alu"]."'>".$tupla["nombre"]."</option>";
                        $nombre_alumno=$tupla["nombre"];
                    }
                    else
                        echo "<option value='".$tupla["cod_alu"]."'>".$tupla["nombre"]."</option>";    
                }
                mysqli_free_result($result_alumnos);

                ?>
                </select>
                <button type="submit" name="btnVerNotas">Ver Notas</button>
            </p>
        </form>
    <?php
        if(isset($_POST["alumno"]))
        {
            echo "<h2>Notas del alumno ".$nombre_alumno."</h2>";
           
            echo "<table>";
            echo "<tr><th>Asignatura</th><th>Nota</th><th>Acción</th></tr>";
            while($tupla=mysqli_fetch_assoc($result_notas_alumno))
            {
                echo "<tr>";
                echo "<td>".$tupla["denominacion"]."</td>";
                if((isset($_POST["btnEditar"]) && $tupla["cod_asig"]==$_POST["asignatura"])|| (isset($_POST["btnCambiar"])  && $tupla["cod_asig"]==$_POST["asignatura"])|| (isset($_SESSION["asignatura"])  && $tupla["cod_asig"]==$_SESSION["asignatura"]))
                {
                    echo  "<td><form action='index.php' method='post'>";
                    echo "<input type='hidden' name='asignatura' value='".$tupla["cod_asig"]."'/>";
                    echo "<input type='hidden' name='alumno' value='".$_POST["alumno"]."'/>";
                    if(isset($_POST["btnCambiar"]))
                        echo "<input type='text' placeholder='Teclee un valor entre 0 y 10' name='nota' value='".$_POST["nota"]."'/>";
                    else
                        echo "<input type='text' placeholder='Teclee un valor entre 0 y 10' name='nota' value='".$tupla["nota"]."'/>";

                    if(isset($_POST["btnCambiar"]) && $error_form)
                    {
                        
                            echo "<br/><span class='error'>* No has introducido un valor válido de Nota *</span>";
                    
                    }
                    echo "</td>";
                    echo "<td>";
                    echo "<button name='btnCambiar' type='submit' class='enlace'>Cambiar</button>";
                    echo " - <button  type='submit' class='enlace'>Atrás</button> ";
                    echo "</form></td>";
                 
                }
                else
                {
                    echo "<td>".$tupla["nota"]."</td>";
                    echo "<td>";
                    echo "<form action='index.php' method='post'>";
                    echo "<input type='hidden' name='asignatura' value='".$tupla["cod_asig"]."'/>";
                    echo "<input type='hidden' name='alumno' value='".$_POST["alumno"]."'/>";
                    echo "<p>";
                    echo "<button name='btnEditar' type='submit' class='enlace'>Editar</button>";
                    echo " - <button name='btnBorrar' type='submit' class='enlace'>Borrar</button> ";
                    echo "</p>";
                    echo "</form>";
                    echo "</td>";
                }
                
                echo "</tr>";
            }
            echo "</table>";
            mysqli_free_result($result_notas_alumno);

            if(isset($_SESSION["mensaje_accion"]))
            {
                echo "<p class='mensaje'>¡¡ ".$_SESSION["mensaje_accion"]." !!</p>";
                session_destroy();
            }

            if(mysqli_num_rows($result_asig_no_alumno)<=0)
            {
                echo "<p>A <strong>".$nombre_alumno."</strong> no le quedan asignaturas que calificar</p>";
            }
            else
            {
                echo "<form action='index.php' method='post'>";
                echo "<input type='hidden' name='alumno' value='".$_POST["alumno"]."'/>";
                echo "<p>";
                echo "<label for='asignatura'>Asignaturas que a <strong></strong> aún le quedan por calificar: </label>";
                echo "<select name='asignatura' id='asignatura'>";
                while($tupla=mysqli_fetch_assoc($result_asig_no_alumno))
                {
                    echo "<option value='".$tupla["cod_asig"]."'>".$tupla["denominacion"]."</option>";
                }
                echo "</select>";
                echo "<button type='submit' name='btnCalificar'>Calificar</button>";
                echo "</p>";
                echo "</form>";
                mysqli_free_result($result_asig_no_alumno);
            }
        }
    }
    ?>
</body>
</html>