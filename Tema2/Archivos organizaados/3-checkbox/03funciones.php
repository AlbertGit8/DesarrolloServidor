<?php
require_once("../libreriaBD.php");

/**
 * Muestra una tabla con los alumnos y un checkbox para cada uno de ellos.
 *
 * Genera cada fila de la tabla con un checkbox para cada alumno, y si el
 * NIF del alumno está en el array $seleccionados, se marca como seleccionado.
 *
 * @global array $alumnos Array con la informacion de los alumnos.
 * @global array $seleccionados Array con los NIF de los alumnos seleccionados.
 */
function mostrarTablaAlumnos()
{
    global $alumnos, $seleccionados;

    // Generar cada fila de la tabla con un checkbox para cada alumno
    foreach ($alumnos as $alumno) {
        echo "<tr>
        <td><input type='checkbox' name='seleccionados[$alumno[0]]' ";
        // Comprobar si el NIF del alumno está en el array $seleccionados
        if (array_key_exists($alumno[0], $seleccionados)) {
            echo " checked ";
        }
        echo "></td>
        <td>$alumno[1] $alumno[2] $alumno[3]</td>
        </tr>";
    }
}

/**
 * Muestra un formulario con los datos de un alumno.
 *
 * Muestra un formulario con los campos nombre, apellido1, apellido2, edad y telefono
 * para cada alumno, y un input hidden para el NIF del alumno.
 *
 * @param string $nifAlumno NIF del alumno a mostrar.
 *
 * @return void
 */
function mostrarAlumno($nifAlumno) {
    
    // Consulta SQL para obtener los datos del alumno por su NIF
    $consulta = "SELECT * FROM `alumnos` WHERE NIF='$nifAlumno'";
    $resul = consultaDatos($consulta);

    // Comprobar si la consulta fue exitosa y mostrar el formulario con los datos del alumno
    if ($resul) {
        $alumno = mysqli_fetch_row($resul);

        echo "<fieldset><legend>Alumno</legend>
            <input type='hidden' name='nifFicha[]' value='$alumno[0]'>
            <p>
                <label for='nombreFicha'>Nombre: </label>
                <input type='text' name='nombreFicha[]' value='$alumno[1]'> 
            </p>
            <p>
                <label for='apellido1Ficha'>Apellido 1: </label>
                <input type='text' name='apellido1Ficha[]' value='$alumno[2]'>
            </p>
            <p>
                <label for='apellido2Ficha'>Apellido 2: </label>
                <input type='text' name='apellido2Ficha[]' value='$alumno[3]'> 
            </p>
            <p>
                <label for='edadFicha'>Edad: </label>
                <input type='number' name='edadFicha[]' value='$alumno[4]'>
            </p>
            <p>
                <label for='telefonoFicha'>Telefono: </label>
                <input type='text' name='telefonoFicha[]' value='$alumno[5]'> 
            </p>
            </fieldset>";
    }
}

/**
 * Actualiza los datos de un alumno en la base de datos.
 *
 * @param string $nifAlumno NIF del alumno a actualizar.
 * @param string $nombreAct Nuevo nombre del alumno.
 * @param string $apellido1Act Nuevo primer apellido del alumno.
 * @param string $apellido2Act Nuevo segundo apellido del alumno.
 * @param int $edadAct Nueva edad del alumno.
 * @param string $telefonoAct Nuevo telefono del alumno.
 *
 * @return void
 */
function actualizarAlumnos($nifAlumno, $nombreAct, $apellido1Act, $apellido2Act,$edadAct, $telefonoAct) {
    $consulta = "UPDATE alumnos 
        SET Nombre = '$nombreAct', Apellido1 = '$apellido1Act', Apellido2 = '$apellido2Act', Edad = '$edadAct', Telefono= '$telefonoAct'
        WHERE NIF = '$nifAlumno'";

    consulta($consulta);
}
