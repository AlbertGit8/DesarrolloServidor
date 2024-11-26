<?php
//Archivo de libreria

// Conexión a la base de datos
$host = "localhost"; //127.0.0.1
$user = "root";
$password = "root"; // Por defecto en blanco
$database = "tema2";

/**
 * Método que se conecta a la BDD
 */
function conectar()
{
    global $host, $user, $password, $database;
    $db = mysqli_connect($host, $user, $password, $database);

    if (!$db) {
        echo "Error al conectar:" . mysqli_connect_error();
        exit;
    }
    return $db;
}

/**
 * Método que cierra la conexion a la BDD
 */
function cerrar($db)
{
    mysqli_close($db);
}

/**
 * Método de consulta que no devuelve nada como un INSERT o UPDATE
 */
function consultaSimple($consulta)
{
    $db = conectar();

    $resul = mysqli_query($db, $consulta);

    if (!$resul) {
        echo mysqli_error($db);
    }


    cerrar($db);
}

/**
 * Método de consulta que devuelve un array 
 */
function consultaDatos($consulta)
{
    $db = conectar();

    $resul = mysqli_query($db, $consulta);

    if ($resul) {
        $filas = mysqli_fetch_all($resul, MYSQLI_ASSOC);
    } else {
        echo mysqli_error($db);
    }

    cerrar($db);

    return $filas;
}

function consultaUnaFila($consulta)
{
    $db = conectar();

    $resul = mysqli_query($db, $consulta);

    if ($resul) {
        $filas = mysqli_fetch_assoc($resul);
    } else {
        echo mysqli_error($db);
    }

    cerrar($db);

    return $filas;
}
