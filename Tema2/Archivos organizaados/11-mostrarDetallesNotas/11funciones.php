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

    echo "
    <p>
    <form name='formTabla' action='$_SERVER[PHP_SELF]' method='post'>
        <table border='2px'>
            <th>NIF</th><th>Nombre y Apellidos</th>";
    // Obtener y mostrar los datos de todas las filas
    foreach ($arrayAlumnos as $fila) {
        echo "<tr>";
        echo "<td> $fila[NIF] </td>";
        echo "<td><a href='$_SERVER[PHP_SELF]?NIFSelec=$fila[NIF]'>$fila[Apellido1] $fila[Apellido2], $fila[Nombre]</a> </td>";
        echo "</tr>";
    }

    echo "</table>
    </form>
    </p>";
}

/**
 * Muestra los detalles del estudiante seleccionado y sus calificaciones en todos los módulos.
 *
 * @param string $NIF Student's NIF
 */
function mostrarNotasAlumno($NIF)
{
    //obtener alumno seleccionado
    $consultaAlumnos = "SELECT * FROM alumnos WHERE NIF='$NIF' ";
    $arrayAlumnos = consultaDatosAssoc($consultaAlumnos);
    $alumno = $arrayAlumnos[0];

    tablaAlumnoSeleccionado($alumno);

    //obtener modulos
    $consultaModulos = "SELECT * FROM modulos WHERE 1 ";
    $arrayModulos = consultaDatosAssoc($consultaModulos);

    tablaModuloNota($arrayModulos, $NIF);
}

/**
 * Muestra una tabla con el NIF y nombre completo del alumno seleccionado.
 *
 * @param array $alumno Array asociativo que contiene los datos de los estudiantes
 * con claves 'NIF', 'Apellido1', 'Apellido2' y 'Nombre'.
 */
function tablaAlumnoSeleccionado($alumno)
{
    echo "<p><table border='2px'><th>NIF</th><th>Nombre y Apellidos</th>";

    // Obtener y mostrar los datos de todas las filas
    echo "<tr>";
    echo "<td> $alumno[NIF] </td>";
    echo "<td>$alumno[Apellido1] $alumno[Apellido2], $alumno[Nombre] </td>";
    echo "</tr>";


    echo "</table></p>";
}

/**
 * Muestra una tabla con los modulos y las notas del alumno seleccionado
 * 
 * @param array $arrayModulos Array con los modulos
 * @param string $NIF NIF del alumno seleccionado
 */
function tablaModuloNota($arrayModulos, $NIF)
{
    echo "<p><table border='2px'><th>Módulo</th><th>Nota</th>";

    // Obtener y mostrar los datos de todas las filas
    foreach ($arrayModulos as $campo) {

        $consultaNotas = "SELECT * FROM notas WHERE IdAlum='$NIF' AND IdMod='$campo[ID]'";
        $filaNota = consultaUnaFila($consultaNotas);

        echo "<tr>";
        echo "<td>$campo[Nombre] </td>";
        echo "<td>$filaNota[Nota]</td>";
        echo "</tr>";
    }

    echo "</table></p>";
}
