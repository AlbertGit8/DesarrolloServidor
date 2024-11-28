<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("../libreriaBD.php");

/**
 * Metodo que devuelve el numero total de filas o alumnos 
 * que hay en la tabla alumnos de la bdd
 * 
 * @return int el numero total de filas o alumnos
 */
function obtenerTotalAlumnos()
{
    $consulta = 'SELECT COUNT(*) AS total FROM alumnos';
    $resul = consultaDatosAssoc($consulta);

    if ($resul && count($resul) > 0) {
        return $resul[0]['total']; // Accedemos al campo "total".
    }
    return 0; // Devuelve 0 si no hay registros o en caso de error.
}

/**
 * Recupera una matriz de estudiantes para la página actual de la base de datos.
 *
 * Esta función calcula el punto de inicio en la base de datos en función del
 * número de página actual y la cantidad de filas por página. Ejecuta una consulta
 * para recuperar los registros de estudiantes limitados a la página especificada. Los resultados se
 * almacenan globalmente en la matriz $alumnos. Además, recupera y
 * almacena la lista de encabezados de columna en la variable global $fields.
 *
 * @param int $pagActual The current page number.
 * @param int $numFilasPagina The number of rows to display per page.
 */
function obtenerArrayPagActual($pagActual, $numFilasPagina)
{
    global $alumnos, $fields;

    $valorInicial = ($pagActual - 1) * $numFilasPagina;

    $db = conectar(); // Usar conexión persistente para no cerrar inmediatamente.
    $consulta = "SELECT * FROM alumnos LIMIT $valorInicial, $numFilasPagina";

    $resul = mysqli_query($db, $consulta);

    if ($resul) {
        // Guardar los datos de los alumnos.
        $alumnos = mysqli_fetch_all($resul, MYSQLI_ASSOC);

        // Obtener encabezados de las columnas.
        $fields = mysqli_fetch_fields($resul);
    } else {
        $alumnos = [];
        $fields = [];
        throw new RuntimeException("Error al ejecutar la consulta: " . mysqli_error($db));
    }

    cerrar($db);
}

/**
 * Muestra la tabla de alumnos con checkboxes para seleccionarlos.
 * Muestra todos los campos de la tabla excepto el NIF.
 * Si se ha seleccionado un alumno, se marca como "checked".
 * 
 * @param array $arrayTabla Array asociativo con los datos de los alumnos.
 * @param array $fields Array asociativo con los nombres de los campos de la tabla.
 */
function mostrarTablaBDD($arrayTabla, $fields)
{
    global $seleccionados;

    echo "<p><form name='formTabla' action='$_SERVER[PHP_SELF]' method='post'><table border='2px'>";
    echo "<thead><tr><th>Selec</th>";

    // Encabezados de columna.
    foreach ($fields as $columna) {
        echo "<th>{$columna->name}</th>";
    }
    echo "</tr></thead><tbody>";

    // Filas de datos.
    foreach ($arrayTabla as $fila) {
        echo "<tr>";
        echo "<td><input type='checkbox' name='seleccionados[{$fila['NIF']}]'";
        if (array_key_exists($fila['NIF'], $seleccionados)) {
            echo " checked";
        }
        echo "></td>";

        foreach ($fila as $valor) {
            echo "<td>$valor</td>";
        }
        echo "</tr>";
    }

    echo "</tbody></table></form></p>";
}
