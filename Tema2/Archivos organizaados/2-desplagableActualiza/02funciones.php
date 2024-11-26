<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("../libreriaBD.php");

/**
 * Crea un desplegable con los valores de un array, y deja seleccionada
 * una opcion en concreto
 *
 * @param array $array array con los valores a mostrar
 * @param string $nombreSelect nombre del desplegable
 */
function foreachSelect($array, $nombreSelect)
{

    foreach ($array as $valorArray) {
        echo "<option value='$valorArray[0]' ";

        if ($valorArray[0] == $nombreSelect) {
            echo " selected ";
        }

        echo " >$valorArray[1] $valorArray[2] </option>";
    }
}

/**
 * Muestra un formulario con los datos de un alumno
 *
 * @param string $desplegable NIF del alumno a mostrar
 *
 * @return void
 */
function mostrarAlumno($desplegable)
{

    $consulta = "SELECT * FROM alumnos WHERE NIF = '$desplegable' ";

    $resul = consultaDatos($consulta);

    if ($resul) {
        $alumno = mysqli_fetch_row($resul);

        echo "<p><form name='form2' action='<?php echo $_SERVER[PHP_SELF] ?>' method='post'> 
            <p>
                <label for='nombre'>NIF: </label>
                <input type='text' name='nifFicha' value='$alumno[0]' readonly> 
            </p>
            <p>
                <label for='nombreFicha'>Nombre: </label>
                <input type='text' name='nombreFicha' value='$alumno[1]'> 
            </p>
            <p>
                <label for='apellido1Ficha'>Apellido 1: </label>
                <input type='text' name='apellido1Ficha' value='$alumno[2]'>
            </p>
            <p>
                <label for='apellido2Ficha'>Apellido 1: </label>
                <input type='text' name='apellido2Ficha' value='$alumno[3]'> 
                </p>
            <p>
                <label for='edadFicha'>Edad: </label>
                <input type='number' name='edadFicha' value='$alumno[4]'>
            </p>
            <p>
                <label for='telefonoFicha'>Telefono: </label>
                <input type='text' name='telefonoFicha' value='$alumno[5]'> 
            </p>
            <input type='hidden' name='nifFicha' value='$alumno[0]'>
            <input type='submit' name='actualizar' value='Actualizar'>
            </form></p>
            ";
    }
}

/**
 * Actualiza la informacion de un alumno en la base de datos.
 *
 * Recupera los datos actualizados de la solicitud POST y construye una consulta SQL
 * para actualizar la información del estudiante en la tabla 'alumnos' en función del NIF proporcionado.
 *
 * @param string $desplegable El NIF del estudiante a actualizar.
 *
 * @return void
 */
function actualizarAlumno($desplegable)
{
    $nombreAct = $_POST['nombreFicha'];
    $apellido1Act = $_POST['apellido1Ficha'];
    $apellido2Act = $_POST['apellido2Ficha'];
    $edadAct = $_POST['edadFicha'];
    $telefonoAct = $_POST['telefonoFicha'];

    $consulta = "UPDATE alumnos 
        SET Nombre = '$nombreAct', Apellido1 = '$apellido1Act', Apellido2 = '$apellido2Act', Edad = '$edadAct', Telefono= '$telefonoAct'
        WHERE NIF = '$desplegable';
        ";
    
    consulta($consulta);
}
