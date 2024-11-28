<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("../libreriaBD.php");

/**
 * Obtiene todos los registros de la tabla 'alumnos'.
 *
 * @return array El array de todos los registros de la tabla 'alumnos'.
 */
function obtenerArrayTabla()
{
    $consulta = "SELECT * FROM `alumnos` WHERE 1 "; // Define la consulta SQL

    $arrayTabla = consultaDatosAssoc($consulta);

    return $arrayTabla;
}


function buscarAlumno($buscar, &$posicionActual)
{
    global $NIF, $nombre, $apellido1, $apellido2, $edad, $telefono, $arrayAlumnos;

    switch ($buscar) { // Evalúa el criterio de búsqueda
        case 'primero':
            $alumno = $arrayAlumnos[0]; // Selecciona el primer alumno
            $posicionActual = 0; // Establece la posición actual a 0
            break;
        case 'anterior':
            $posAnterior = $posicionActual - 1; // Calcula la posición anterior
            if ($posAnterior < 0) {
                $posAnterior = 0; // Asegura que no sea menor que 0
            }
            $alumno = $arrayAlumnos[$posAnterior]; // Selecciona el alumno en la posición anterior
            $posicionActual = $posAnterior; // Actualiza la posición actual
            break;
        case 'siguiente':
            $posSiguiente = $posicionActual + 1; // Calcula la posición siguiente
            if ($posSiguiente > count($arrayAlumnos) - 1) {
                $posSiguiente = count($arrayAlumnos) - 1; // Asegura que no exceda el límite
            }
            $alumno = $arrayAlumnos[$posSiguiente]; // Selecciona el alumno en la posición siguiente
            $posicionActual = $posSiguiente; // Actualiza la posición actual
            break;
        case 'ultimo':
            $alumno = $arrayAlumnos[count($arrayAlumnos) - 1]; // Selecciona el último alumno
            $posicionActual = count($arrayAlumnos) - 1; // Establece la posición actual al último índice
    }

    // Actualiza las variables globales con los datos del alumno seleccionado
    $NIF = $alumno['NIF'];
    $nombre = $alumno['Nombre'];
    $apellido1 = $alumno['Apellido1'];
    $apellido2 = $alumno['Apellido2'];
    $edad = $alumno['Edad'];
    $telefono = $alumno['Telefono'];
}


function actualizarAlumno($NIF, $nombre, $apellido1, $apellido2, $edad, $telefono)
{
    $consulta = "UPDATE alumnos 
                SET Nombre = '$nombre', Apellido1 = '$apellido1', Apellido2 = '$apellido2', Edad = '$edad', Telefono= '$telefono'
                WHERE NIF = '$NIF';"; // Define la consulta SQL para actualizar el alumno

    $resul = consulta($consulta);

    if ($resul) {
        echo "<p>Alumno ACTUALIZADO correctamente.</p>";
    }
}

function borrarAlumno($NIF) {

    $consulta = "DELETE FROM `alumnos` WHERE NIF='$NIF'"; // Define la consulta SQL para borrar el alumno

    $resul = consulta($consulta);

    if ($resul) {
        echo "<p>Alumno BORRADO correctamente.</p>";
    }
}