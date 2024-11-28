<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criterios de busqueda</title>
</head>
<!-- mostrar los alumnos en una tabla segun las opciones elegidas en los select ordenanos de forma por apellido1 apellido2 nombre-->

<?php
require_once("libreria-bd.php");

function mostrarTablaAlumnos($arrayAlumnos)
{
    // Extraer las columnas de Apellido1 y Apellido2 para ordenar
    $apellido1 = array_column($arrayAlumnos, 'Apellido1');
    $apellido2 = array_column($arrayAlumnos, 'Apellido2');

    // Ordenar el array por Apellido1 y luego por Apellido2
    array_multisort($apellido1, SORT_ASC, $apellido2, SORT_ASC, $arrayAlumnos);

    echo "<p><form name='formTabla' action='$_SERVER[PHP_SELF]' method='post'><table border='2px'><th>Nombre y Apellidos</th><th>Nota</th>";

    // Obtener y mostrar los datos de todas las filas
    foreach ($arrayAlumnos as $fila) {
        echo "<tr>";
        echo "<td>$fila[Apellido1] $fila[Apellido2], $fila[Nombre]</td>";
        echo "<td>$fila[NotaMedia]</td>";
        echo "</tr>";
    }

    echo "</table>
        </form></p>";
}

function generarConsulta($opcMejorPeor, $numRegistros, $suspensos)
{
    $consulta = "SELECT 
        a.Apellido1,
        a.Apellido2,
        a.Nombre,
        AVG(Nota) AS NotaMedia
        FROM 
            notas n
        JOIN 
            alumnos a ON n.IdAlum = a.NIF";

    if ($suspensos === "no") {
        $consulta .= " WHERE n.IdAlum NOT IN ( SELECT DISTINCT(n2.IdAlum) FROM notas n2 WHERE Nota < 5 )";
    }

    $consulta .= " GROUP BY a.Apellido1, a.Apellido2, a.Nombre, n.IdAlum 
                   ORDER BY NotaMedia";

    if ($opcMejorPeor === "mejores") {
        $consulta .= " DESC";
    } else {
        $consulta .= " ASC";
    }

    $consulta .= " LIMIT $numRegistros";
    return $consulta;
}


// mejores si empieza desde arriba peores si empieza desde abajo
$opcMejorPeor = "";
if (isset($_POST['opcMejorPeor'])) {
    $opcMejorPeor = $_POST['opcMejorPeor'];
}

//1 a 10 registros de busqueda
$numRegistros = "";
if (isset($_POST['numRegistros'])) {
    $numRegistros = $_POST['numRegistros'];
}

// SI puede tener suspensos o si NO puede tener suspensos
$suspensos = "si";
if (isset($_POST['suspensos'])) {
    $suspensos = $_POST['suspensos'];
}

$mejorPeor = array("mejores" => "Mejores", "peores" => "Peores");
$registros = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
?>

<body>
    <fieldset>
        <form name="f1" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <select name="opcMejorPeor">
                <option value=""></option>

                <?php

                foreach ($mejorPeor as $clave => $item) {
                    echo "<option value='$clave' ";

                    if ($opcMejorPeor == $clave) {
                        echo " selected ";
                    }

                    echo " >$item </option>";
                }
                ?>
            </select>

            <select name="numRegistros">
                <option value=""></option>

                <?php
                foreach ($registros as $item) {
                    echo "<option value='$item' ";

                    if ($numRegistros == $item) {
                        echo " selected ";
                    }

                    echo " >$item </option>";
                }
                ?>
            </select>
            <b>Con suspensos</b>
            Si <input type="radio" name="suspensos" <?php
                                                    if ($suspensos == "si") {
                                                        echo "checked";
                                                    }
                                                    ?> value="si">
            No <input type="radio" name="suspensos" <?php
                                                    if ($suspensos == "no") {
                                                        echo "checked";
                                                    }
                                                    ?> value="no">
            <input type="submit" name="mostrar" value="Mostrar">
        </form>
    </fieldset>
    <?php
    if (isset($_POST['mostrar'])) {

        $consulta = generarConsulta($opcMejorPeor, $numRegistros, $suspensos);

        $arrayAlumnos = consultaDatos($consulta);

        mostrarTablaAlumnos($arrayAlumnos);
    }
    ?>
</body>

</html>