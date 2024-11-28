<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("../libreriaBD.php");



/**
 * Devuelve un array asociativo con los registros de la tabla especificada.
 *
 * @param string $nombreTabla El nombre de la tabla de la que se desean obtener los registros.
 *
 * @return array Un array asociativo con los registros de la tabla especificada.
 */
function obtenerArrayTabla($nombreTabla)
{
    global $paisSeleccionado, $provinciaSeleccionada;

    switch ($nombreTabla) {
        case 'paises':
            $consulta = obtenerPaises();
            break;
        case 'provincias':
            $consulta = obtenerProvincias($paisSeleccionado);
            break;
        case 'localidades':
            $consulta = obtenerLocalidades($paisSeleccionado, $provinciaSeleccionada);
    }

    $arrayTabla = consultaDatosAssoc($consulta);

    return $arrayTabla;
}



/**
 * Construye una consulta SQL para seleccionar todos los países de la base de datos.
 *
 * @return string La consulta SQL para recuperar todos los países.
 */
function obtenerPaises()
{
    return "SELECT * FROM paises WHERE 1 ";
}

/**
 * Construye una consulta SQL para seleccionar todas las provincias de un país determinado.
 *
 * @param string $pais El ID del país para el cual se recuperarán las provincias.
 * @return string La consulta SQL para obtener las provincias asociadas con el ID de país especificado.
 */
function obtenerProvincias($pais)
{
    return "SELECT * FROM provincias WHERE IdPais = '$pais'";
}

/**
 * Obtiene las localidades de una provincia
 * 
 * @param string $pais El codigo del pais
 * @param string $provincia El codigo de la provincia
 * @return string La consulta SQL para obtener las localidades
 */
function obtenerLocalidades($pais, $provincia)
{
    return "SELECT * FROM localidades WHERE IdPais = '$pais' AND IdProvincia = '$provincia'";
}
