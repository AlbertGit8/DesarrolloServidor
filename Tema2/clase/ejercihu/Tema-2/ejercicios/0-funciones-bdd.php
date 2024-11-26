<?php
$host = "localhost"; //127.0.0.1

$user = "root";

$password = ""; //por defecto en blanco

$database = "tema2";

//se conecta al servidor de bbdd y devuelve un descriptor database
$db = mysqli_connect($host, $user, $password, $database);

$arrayTabla = array();
$fields = array();
$seleccionados = array();

if (isset($_POST['seleccionados'])) {
    $seleccionados = $_POST['seleccionados'];
}

function obtenerArrayTabla()
{
    global $db,$arrayTabla,$fields;

    $consulta = "SELECT * FROM `alumnos` WHERE 1 ";

    $resul = mysqli_query($db, $consulta);

    if ($resul) {
        $arrayTabla = mysqli_fetch_all($resul, MYSQLI_ASSOC);
        // Obtener los encabezados de las columnas 
        $fields = mysqli_fetch_fields($resul);
    } else {
        echo "Error en la consulta: " . mysqli_error($db);
    }
}

function mostrarTablaBDD($arrayTabla, $fields)
{
    global $seleccionados;

    $campoIdentificador = "NIF";

    echo "<p><form name='formTabla' action='$_SERVER[PHP_SELF]' method='post'><table border='2px'><th>Selec</th>";

    //primer foreach para mostrar los nombres de las columas de la tabla
    foreach ($fields as $nombreColumna) {
        echo "<th>$nombreColumna->name</th>";
    }

    // Obtener y mostrar los datos de todas las filas
    foreach ($arrayTabla as $nombreColumna => $fila) {
        echo "<tr>
            <td><input type='checkbox' name='seleccionados[$fila[$campoIdentificador]]' ";
        // Comprobar si el NIF del alumno está en el array $seleccionados
        if (array_key_exists($fila[$campoIdentificador], $seleccionados)) {
            echo " checked ";
        }
        echo "></td>
            ";

        foreach ($fila as $valor) {
            echo "<td> $valor </td>";
        }
        echo "</tr>";
    }

    echo "</table>
        </form></p>";
}

obtenerArrayTabla();

mostrarTablaBDD($arrayTabla, $fields);
