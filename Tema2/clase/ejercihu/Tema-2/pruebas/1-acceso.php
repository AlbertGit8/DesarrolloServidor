<?php

//conectar al servidor de BBDD en local

$host = "localhost"; //127.0.0.1

$user = "root";

$password = ""; //por defecto en blanco

$database = "tema2";

//se conecta al servidor de bbdd y devuelve un descriptor database
$db = mysqli_connect($host, $user, $password, $database); // orden de los parametros es siempre este

$dni = '3333333B';
$nombre = "Tomás";
$apellido1 = "Sancho";
$apellido2 = "Benito";
$telefono = "888888888";

//insertar fila
$consulta = "insert into alumnos values('$dni','$nombre','$apellido1','$apellido2','$telefono')";

//hacer la consulta en el servidor
$resul = mysqli_query($db, $consulta);

if ($resul) {
    echo "Consulta hecha correctamente";
} else {
    echo "<p>Error en la consulta: " . mysqli_error($db)."</p>";
}

//cerrar servidor
mysqli_close($db);
