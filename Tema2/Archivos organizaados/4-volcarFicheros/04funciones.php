<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("../libreriaBD.php");

/**
 * Convierte un fichero de texto en un array asociativo.
 *
 * Cada linea del fichero debe tener el siguiente formato:
 * <clave>:<valor1>:<valor2>:...
 *
 * Donde <clave> es el elemento clave del array asociativo y <valor1>, <valor2>, ...
 * son los valores asociados.
 *
 * @param string $nombreFichero nombre del fichero que se va a leer
 * @return array array asociativo con los valores leidos del fichero
 * @throws Exception si no se puede abrir el fichero
 */
function convertirFicheroArray($nombreFichero)
{
    $arrayFichero = array();
    $fd = fopen($nombreFichero, "r") or die("Error al abrir el archivo");

    while (!feof($fd)) {
        $fila = fgets($fd);
        if ($fila) { // Verificamos que la linea no este vacia
            $linea = explode(":", trim($fila));
            if (count($linea) >= 4) { // Aseguramos que tenga al menos 2 campos
                $arrayFichero[$linea[0]] = $linea;
            }
        }
    }
    fclose($fd);
    return $arrayFichero;
}
