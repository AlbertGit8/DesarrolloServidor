<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("../libreriaBD.php");

/**
 * Muestra la tabla de alumnos con checkboxes para seleccionarlos.
 * Muestra todos los campos de la tabla excepto el NIF.
 * Si se ha seleccionado un alumno, se marca como "checked".
 * El encabezado de cada columna es un enlace que permite ordenar por la columna correspondiente.
 * 
 * @param array $arrayTabla Array asociativo con los datos de los alumnos.
 * @param array $fields Array asociativo con los nombres de los campos de la tabla.
 */
function mostrarTablaBDD($arrayTabla, $fields)
{
    // Importar variables globales que se usan en la función
    global $seleccionados, $nombre, $apellido1, $apellido2, $edadMin, $edadMax;

    // Definir el campo que identifica cada fila de forma única
    $campoIdentificador = "NIF";

    // Iniciar la tabla HTML con borde y formulario
    echo "<p><table border='2px'>
          <form name='formTabla' action='" . $_SERVER['PHP_SELF'] . "' method='post'>
          <thead>
          <tr>
          <th>Selec</th>"; // Columna para seleccionar filas (checkboxes)

    // Mostrar los nombres de las columnas de la base de datos como encabezados
    foreach ($fields as $nombreColumna) {
        echo "<th>
                <a href='" . $_SERVER['PHP_SELF'] . "?Campo=$nombreColumna->name&nombre=$nombre&apellido1=$apellido1&apellido2=$apellido2&edadMin=$edadMin&edadMax=$edadMax'>
                    $nombreColumna->name
                </a>
              </th>";
        // Los encabezados son enlaces que permiten ordenar por la columna correspondiente.
    }

    echo "</tr></thead><tbody>";

    // Verificar si hay datos en $arrayTabla
    if (!empty($arrayTabla)) {
        // Recorrer cada fila de la tabla (cada alumno)
        foreach ($arrayTabla as $fila) {
            echo "<tr>
                  <td><input type='checkbox' name='seleccionados[" . htmlspecialchars($fila[$campoIdentificador]) . "]' ";

            // Marcar el checkbox si el identificador de la fila está en los seleccionados
            if (isset($seleccionados[$fila[$campoIdentificador]])) {
                echo " checked ";
            }

            echo "></td>"; // Cerrar la celda del checkbox

            // Recorrer cada valor de la fila y mostrarlo en una celda
            foreach ($fila as $valor) {
                echo "<td>" . htmlspecialchars($valor) . "</td>";
                // Usar htmlspecialchars para evitar inyecciones de HTML o JS
            }

            echo "</tr>"; // Final de la fila
        }
    } else {
        // Si no hay datos, mostrar un mensaje de "sin resultados"
        echo "<tr><td colspan='" . (count($fields) + 1) . "'>No se encontraron resultados.</td></tr>";
    }

    // Cerrar la tabla y agregar un botón de envío
    echo "</tbody></table>
          <p><input type='submit' name='enviar' value='Enviar'></p>
          </form></p>";
}
