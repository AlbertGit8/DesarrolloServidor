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
function mostrarTablaAlumnos($arrayTabla, $fields)
{
    global $alumnosSeleccionados;

    echo "<p><table border='2px'>";
    echo "<thead><tr><th>Selec</th>";

    // Encabezados de columna, poniendo sus nombres accediendo a la propiedad name del objeto columna perteneciente a fields.
    foreach ($fields as $columna) {
        echo "<th>{$columna->name}</th>";
    }
    echo "</tr></thead><tbody>";

    // Filas de datos.
    foreach ($arrayTabla as $fila) {
        echo "<tr>";
        echo "<td><input type='checkbox' name='alumnosSeleccionados[$fila[NIF]]'></td>";
        

        foreach ($fila as $valor) {
            echo "<td>$valor</td>";
        }
        echo "</tr>";
    }

    echo "</tbody></table></p>";
}


/**
 * Muestra la tabla de módulos con checkboxes para seleccionarlos.
 * Muestra todos los campos de la tabla excepto el ID.
 * Si se ha seleccionado un módulo, se marca como "checked".
 */
function mostrarTablaModulos()
{
    global $modulosSeleccionados;

    $consulta = "SELECT * FROM modulos";
    $resul = consultaDatos($consulta);

    if ($resul) {
        $modulos = consultaDatosAssoc($consulta);
        // Obtener encabezados de las columnas.
        $fields = mysqli_fetch_fields($resul);
    }



    echo "<p><table border='2px'>";
    echo "<thead><tr><th>Selec</th>";

    // Encabezados de columna, poniendo sus nombres accediendo a la propiedad name del objeto columna perteneciente a fields.
    foreach ($fields as $columna) {
        echo "<th>{$columna->name}</th>";
    }
    echo "</tr></thead><tbody>";

    // Filas de datos.
    foreach ($modulos as $modulo) {
        echo "<tr>";
        echo "<td><input type='checkbox' name='modulosSeleccionados[$modulo[ID]]'></td>";
        foreach ($modulo as $valor) {
            echo "<td>$valor</td>";
        }
        echo "</tr>";
    }
    echo "</tbody></table></p>";
}

/**
 * Matricula a los alumnos en los módulos seleccionados para un curso específico.
 * Si el alumno ya esta matriculado en alguno de los módulos seleccionados
 * guarda su info en Errores.txt.
 * En caso de que no esté matriculado, la matricula y devuelve un mensaje de
 * confirmación.
 *
 * @param array $alumnosSeleccionados array con los NIF de los alumnos seleccionados.
 * @param array $modulosSeleccionados array con los IDs de los módulos seleccionados.
 * @param int $curso ID del curso seleccionado.
 */
function matricularSeleccionados($alumnosSeleccionados, $modulosSeleccionados, $curso)
{
    foreach ($alumnosSeleccionados as $IdAlum) {
        foreach ($modulosSeleccionados as $IdMod) {
            //comprobar que el alumno no esta matriculado en ningun modulo seleccionado
            //si lo está guarda su info en Errores.txt
            if (alumnoEstaMatriculado($IdAlum, $IdMod, $curso)) {
                $nombreFichero = "Errores.txt";
                $saltoLinea = "\r\n";

                $fd = fopen($nombreFichero, "a+") or die("Error al abrir el archivo");

                $fila = "$IdAlum" . $saltoLinea;

                fputs($fd, $fila);

                fclose($fd);
            } else {
                $numero = comprobarCurso($IdAlum, $IdMod);

                $consulta = "INSERT INTO matricula(IdCurso, IdAlum, IdMod, Numero) 
                    VALUES('$curso', '$IdAlum', '$IdMod','$numero')";

                consulta($consulta);

                echo "Alumnos matriculados correctamente";
            }
        }
    }
}

/**
 * Comprueba si un estudiante está inscrito en un módulo y curso específicos.
 *
 * @param int $IdAlum ID of the student.
 * @param int $IdMod ID of the module.
 * @param int $curso ID of the course.
 *
 * @return bool True if the student is enrolled, false otherwise.
 */
function alumnoEstaMatriculado($IdAlum, $IdMod, $curso)
{

    $consulta = "SELECT * FROM matricula WHERE IdAlum='$IdAlum' AND IdMod='$IdMod' AND IdCurso='$curso'";

    $arrayResultados = consultaDatosAssoc($consulta);

    //si no hay ningun registro NO está matriculado
    if (count($arrayResultados) === 0) {
        return false;
    } else {
        //si hay al menos un registro SI está matriculado
        return true;
    }
}

/**
 * Comprueba el n mero de veces que un estudiante ha matriculado un m dulo.
 *
 * @param int $IdAlum ID del estudiante.
 * @param int $IdMod ID del m dulo.
 *
 * @return int N mero de veces que el estudiante ha matriculado el m dulo.
 */

function comprobarCurso($IdAlum, $IdMod)
{
    $consulta = "SELECT * FROM matricula WHERE IdAlum='$IdAlum' AND IdMod='$IdMod' ";

    $arrayResultados = consultaDatosAssoc($consulta);

    return count($arrayResultados) + 1;
}
