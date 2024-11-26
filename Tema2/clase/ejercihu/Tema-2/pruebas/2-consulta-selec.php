<?php


function mostrarTabla($filas) {
    echo "<p><table border='2px'><th>NIF</th><th>Nombre</th><th>Apellido 1</th><th>Apellido 2</th><th>Telefono</th>";


    foreach ($filas as $fila) {
        echo "<tr>";
        foreach ($fila as $celda) {
            echo "<td>$celda</td>";
        }
        echo "</tr>";
    }

    echo "</table></p>";
}

function mostrarCampos($fila) {
    foreach ($fila as $clave => $campo) {
        echo "Campo:$clave es $campo <br>";
    }
}


//conectar al servidor de BBDD en local

$host = "localhost"; //127.0.0.1

$user = "root";

$password = ""; //por defecto en blanco

$database = "tema2";

//se conecta al servidor de bbdd y devuelve un descriptor database
$db = mysqli_connect($host, $user, $password, $database);

$consulta="SELECT * FROM `alumnos`";

$resul = mysqli_query($db, $consulta);

if ($resul) {
    echo "<p>Consulta hecha correctamente. Mostrando tabla...</p>";

    //devuelve un resultset que no se puede recorrer con un foreach

    $filas=array();

    //extrae todas las filas de la tabla de golpe
    //$filas=mysqli_fetch_all($resul);

    mostrarTabla($filas);

    //el fetch coge la primera fila y se queda apuntando a la siguiente para la siguiente vez que se le llame
    echo "<p>";
    $fila=mysqli_fetch_assoc($resul);
    echo "Extraccion con array asociativo <br>";
    mostrarCampos($fila);
    echo "</p>";

    echo "<p>";
    $fila=mysqli_fetch_array($resul);
    echo "Extraccion con array combinado <br>";
    mostrarCampos($fila);
    echo "</p>";

    echo "<p>";
    $fila=mysqli_fetch_row($resul);
    echo "Extraccion con array numérico <br>";
    mostrarCampos($fila);
    echo "</p>";

} else {
    echo "<p>Error en la consulta: " . mysqli_error($db)."</p>";
}

mysqli_close($db);


?>