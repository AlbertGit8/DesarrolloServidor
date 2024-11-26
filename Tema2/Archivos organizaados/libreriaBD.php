<?php
//Archivo  de libreria para conectar a una BDD
$host = "localhost";

$user = "root";

$password = "root";

$database = "tema2";

/**
 * Establece una conexion a la base de datos usando variables globales de configuracion.
 * 
 * @global string $host El nombre de host del servidor de base de datos.
 * @global string $user El nombre de usuario utilizado para conectarse a la base de datos.
 * @global string $password La contraseña utilizada para conectarse a la base de datos.
 * @global string $database El nombre de la base de datos a la que conectarse.
 * 
 * @return mysqli Un objeto mysqli que representa la conexión a la base de datos.
 * 
 * @throws RuntimeException Si falla la conexión a la base de datos, se muestra un mensaje de error y el script sale.
 */
function conectar()
{
    global $host, $user, $password, $database;

    $db = mysqli_connect($host, $user, $password, $database);

    if (!$db) {
        echo "ERROR AL CONECTAR " . mysqli_connect_error();
        exit;
    }

    return $db;
}

/**
 * Ejecuta una consulta que no devuelve datos como INSERT o UPDATE.
 *
 * @param string $consulta La consulta SQL a ejecutar.
 *
 * @return void
 *
 * @throws RuntimeException Si la consulta falla, se muestra un mensaje de error y el script sale.
 */
function consulta($consulta)
{
    $db = conectar();

    $resul = mysqli_query($db, $consulta);

    if (!$resul) {
        throw new RuntimeException("Error al ejecutar la consulta: " . mysqli_error($db));
    }

    cerrar($db);
}

/**
 * Ejecuta una consulta que devuelve datos como un SELECT.
 *
 * @param string $consulta La consulta SQL a ejecutar.
 *
 * @return array El resultado de la consulta como un array asociativo.
 *
 * @throws RuntimeException Si la consulta falla, se muestra un mensaje de error y el script sale.
 */
function consultaDatosAssoc($consulta)
{
    $db = conectar();

    $filas = array();

    $resul = mysqli_query($db, $consulta);

    if (!$resul) {
        throw new RuntimeException("Error al ejecutar la consulta: " . mysqli_error($db));
    } else {
        $filas = mysqli_fetch_all($resul, MYSQLI_ASSOC);
    }

    cerrar($db);

    return $filas;
}

/**
 * Ejecuta una consulta SQL y devuelve el resultado.
 *
 * @param string $consulta La consulta SQL a ejecutar.
 *
 * @return mysqli_result|false El objeto de resultado de la consulta, o false en caso de error.
 *
 * @throws RuntimeException Si la consulta falla, se lanza una excepción con el mensaje de error.
 */
function consultaDatos($consulta) {
    $db = conectar();

    $resul = mysqli_query($db, $consulta);

    if (!$resul) {
        throw new RuntimeException("Error al ejecutar la consulta: " . mysqli_error($db));
    }

    cerrar($db);

    return $resul;

}

/**
 * Cierra la conexion a la base de datos.
 *
 * @param mysqli $db La conexion de la base de datos a cerrar.
 *
 * @return void
 */

function cerrar($db)
{
    mysqli_close($db);

}
