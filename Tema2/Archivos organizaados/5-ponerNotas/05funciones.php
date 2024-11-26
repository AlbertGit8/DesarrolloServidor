<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("../libreriaBD.php");

/**
 * Comprueba si un alumno con el nif pasado como parametro esta  matriculado en el m dulo con el id pasado como para metro.
 * @param string $desplegabkeAlumnos NIF del alumno a comprobar.
 * @param int $desplegableModulos ID del m dulo al que se va a comprobar.
 * @return boolean True si el alumno est  matriculado en el m dulo, false en caso contrario.
 */
function comprobarNota($desplegableAlumnos, $desplegableModulos)
{

    $existe = false;

    $consulta = "SELECT count(*) as cuentaAlu FROM `notas` WHERE IDAlum='$desplegableAlumnos' and IDMod='$desplegableModulos'";

    $result = consultaDatosAssoc($consulta);

    if ($result[0]['cuentaAlu'] == 0) { // Verificar si cuenta es igual a 0
        $existe = false;
    } else {
        $existe = true;
    }

    return $existe;
}

/**
 * Pone una nota a un alumno en un modulo.
 * 
 * Si el alumno ya tiene una nota en el modulo, se actualiza la nota.
 * Si el alumno no tiene una nota en el modulo, se registra una nueva.
 * 
 * @param string $desplegableAlumnos NIF del alumno al que se va a poner una nota.
 * @param int $desplegableModulos ID del modulo en el que se va a poner una nota.
 * @param int $nota nota que se va a poner al alumno en el modulo.
 */
function ponerNota($desplegableAlumnos, $desplegableModulos, $nota)
{
    if (comprobarNota($desplegableAlumnos, $desplegableModulos)) {
        //si el alumno ya está matriculado en el modulo
        echo "<p>NOTA: El alumno con NIF: $desplegableAlumnos ya tiene una nota en el modulo con ID: $desplegableModulos. Se actualizará su nota.</p>";

        $consulta = "UPDATE notas
        SET nota = '$nota'
        WHERE IDAlum '$desplegableAlumnos' AND IDMod = '$desplegableModulos';";

        $resul = consulta($consulta);

        if ($resul) {
            echo "<p>Nota actualizada.</p>";
        }
    } else { //si el alumno NO está matriculado en el modulo

        $consulta = "INSERT INTO notas VALUES('$desplegableAlumnos','$desplegableModulos','$nota')";

        $resul = consulta($consulta);

        if ($resul) {
            echo "<p>Nota registrada.</p>";
        }
    }
}
