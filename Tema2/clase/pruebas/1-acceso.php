<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


//conectar al servidor de BBDD en local

$host = "localhost"; //127.0.0.1

$user = "root";

$password = "root"; //por defecto en blanco

$database = "tema2";

//se conecta al servidor de bbdd y devuelve un descriptor database
$db = mysqli_connect($host, $user, $password, $database); // orden de los parametros es siempre este

$dni = '85728356W';
$nombre = "Joselito";
$apellido1 = "Muñoz";
$apellido2 = "Canaberales";
$telefono = "678458755";

//insertar fila
$consulta = "insert into alumnos values('$dni','$nombre','$apellido1','$apellido2','$telefono')";

//hacer la consulta en el servidor
$resul = mysqli_query($db, $consulta);

if ($resul) {
    echo "Consulta hecha correctamente";
} else {
    echo "Error en la consulta: " . mysqli_error($db);
}

//cerrar servidor
mysqli_close($db);
