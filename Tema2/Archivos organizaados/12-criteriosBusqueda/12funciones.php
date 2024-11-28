<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("../libreriaBD.php");

/**
 * Muestra una tabla con los datos de los alumnos en ella.
 * Los alumnos se ordenan por Apellido1 y luego por Apellido2.
 *
 * @param array $arrayAlumnos Un array asociativo con los datos de los alumnos.
 * @return string La tabla HTML con los datos de los alumnos.
 */
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

/**
 * Genera una consulta SQL que devuelve los datos de los
 * $numRegistros primeros o ltimos alumnos que no tienen
 * nota suspensa seg n el par metro $suspensos.
 *
 * @param string $opcMejorPeor "mejores" o "peores". Si es
 *        "mejores", devuelve los $numRegistros primeros
 *        alumnos que no tienen nota suspensa. Si es
 *        "peores", devuelve los ltimos.
 * @param int $numRegistros N mero de filas que se
 *        desean mostrar.
 * @param string $suspensos "si" o "no". Si es "si", se
 *        incluyen los alumnos con nota suspensa en la
 *        consulta. Si es "no", se excluyen.
 *
 * @return string La consulta SQL generada.
 */
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