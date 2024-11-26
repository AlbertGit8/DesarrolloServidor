<?php


/**
 * Valida los datos de un alumno.
 *
 * Comprueba la longitud de los diferentes campos y muestra un mensaje
 * de error en caso de que no sean validos.
 *
 * @param string $nif El nif del alumno.
 * @param string $nombre El nombre del alumno.
 * @param string $apellido1 El primer apellido del alumno.
 * @param string $apellido2 El segundo apellido del alumno.
 * @param string $edad La edad del alumno.
 * @param string $telefono El telefono del alumno.
 *
 * @return boolean True si los datos son validos, false en caso contrario.
 */
function validarDatos($nif, $nombre, $apellido1, $apellido2,$edad, $telefono) {
    /**
     * Variable que nos permite determinar si los datos son validos o no.
     *
     * @var boolean
     */
    $valido = true;

    /**
     * Quitamos los espacios en blanco de los datos.
     */
    $nif = trim($nif);
    $nombre = trim($nombre);
    $apellido1 = trim($apellido1);
    $apellido2 = trim($apellido2);
    $telefono = trim($telefono);

    /**
     * Comprobamos la longitud del nif.
     */
    if (strlen($nif) != 9) {
        echo "<p>ERROR: El nif debe tener una longitud de 9 caracteres</p>";
        $valido = false;
    }

    /**
     * Comprobamos la longitud del nombre.
     */
    if (strlen($nombre) > 25) {
        echo "<p>ERROR: El nombre no debe tener una longitud mayor a 25 caracteres</p>";
        $valido = false;
    }
    if (strlen($nombre) == 0) {
        echo "<p>ERROR: El nombre no debe estar vacio</p>";
        $valido = false;
    }   

    /**
     * Comprobamos la longitud del apellido1.
     */
    if (strlen($apellido1) > 25) {
        echo "<p>ERROR: El apellido 1 no debe tener una longitud mayor a 25 caracteres</p>";
        $valido = false;
    }
    if (strlen($apellido1) == 0) {
        echo "<p>ERROR: El apellido 1 no debe estar vacio</p>";
        $valido = false;
    }

    /**
     * Comprobamos la longitud del apellido2.
     */
    if (strlen($apellido2) > 25) {
        echo "<p>ERROR: El apellido 2 no debe tener una longitud mayor a 25 caracteres</p>";
        $valido = false;
    }

    /**
     * Comprobamos la longitud de la edad.
     */
    if (strlen($edad) > 3) {
        echo "<p>ERROR: La edad no debe tener una longitud mayor a 3 caracteres</p>";
        $valido = false;
    }

    /**
     * Comprobamos la longitud del telefono.
     */
    if (strlen($telefono) != 9) {
        echo "<p>ERROR: El telefono debe tener una longitud de 9 caracteres</p>";
        $valido = false;
    }

    return $valido;
}
