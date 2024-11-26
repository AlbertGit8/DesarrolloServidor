<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("../libreriaBD.php");

/**
 * Muestra la tabla de alumnos con checkboxes para seleccionarlos.
 * Muestra todos los campos de la tabla excepto el NIF.
 * Si se ha seleccionado un alumno, se marca como "checked".
 * @param array $arrayTabla Array asociativo con los datos de los alumnos.
 * @param array $fields Array asociativo con los nombres de los campos de la tabla.
 */
function mostrarTablaBDD($arrayTabla, $fields)
{
    global $seleccionados;
    $nombreTabla = "alumnos";
    $campoIdentificador = "NIF";

    echo "<p><table border='2px'><form name='formTabla' action='$_SERVER[PHP_SELF]' method='post'><th>Selec</th>";

    //primer foreach para mostrar los nombres de las columas de la tabla
    foreach ($fields as $nombreColumna) {
        echo "<th>$nombreColumna->name</th>";
    }

    // Obtener y mostrar los datos de todas las filas
    foreach ($arrayTabla as $nombreColumna => $fila) {
        echo "<tr>
        <td><input type='checkbox' name='seleccionados[$fila[$campoIdentificador]]' ";
        // Comprobar si el NIF del alumno está en el array $seleccionados
        if (array_key_exists($fila[$campoIdentificador], $seleccionados)) {
            echo " checked ";
        }
        echo "></td>
        ";

        foreach ($fila as $valor) {
            echo "<td> $valor </td>";
        }
        echo "</tr>";
    }

    echo "</table>
        <p><input type='submit' name='enviar' value='Enviar'></p>
        </form></p>";
}
