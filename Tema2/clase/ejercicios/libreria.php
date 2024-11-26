<?php
//Archivo  de libreria para conectar a una BDD
$host = "localhost";

$user = "root";

$password = "root";

$database = "tema2";

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
 * Consulta que no devuelve datos como un insert o un update
 *
 * @param [type] $consulta
 * @return void
 */
function consulta($consulta)
{ //Funcion que ejecuta una consulta que no devuelve los datos
    $db = conectar();

    $resul = mysqli_query($db, $consulta);

    if (!$resul) {
        echo mysqli_error($db);
    }

    cerrar($db);
}

/**
 * 
 *
 * @param [type] $consulta
 * @return array
 */
function consultaDatos($consulta)
{ //Funcion que ejecuta una consulta que no devuelve los datos
    $db = conectar();

    $filas = array();

    $resul = mysqli_query($db, $consulta);

    if (!$resul) {
        echo mysqli_error($db);
    } else {
        $filas = mysqli_fetch_all($resul, MYSQLI_ASSOC);
    }

    cerrar($db);

    return $filas;
}

function cerrar($db)
{
    mysqli_close($db);
}
