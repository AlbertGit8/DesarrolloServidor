<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function mostrarTabla($alumnos, $nombre, $apellido1, $apellido2, $min, $max)
{
    // Incluye los filtros en los enlaces de ordenación
    echo "<fieldset><legend>Resultado de la tabla búsqueda</legend>";
    echo "<table border='2'>
            <tr>
                <th><a href='$_SERVER[PHP_SELF]?Campo=NIF&nombre=$nombre&apellido1=$apellido1&apellido2=$apellido2&minima=$min&maxima=$max'>NIF</a></th>

                <th><a href='$_SERVER[PHP_SELF]?Campo=Nombre&nombre=$nombre&apellido1=$apellido1&apellido2=$apellido2&minima=$min&maxima=$max'>Nombre</a></th>

                <th><a href='$_SERVER[PHP_SELF]?Campo=Apellido1&nombre=$nombre&apellido1=$apellido1&apellido2=$apellido2&minima=$min&maxima=$max'>Apellido1</a></th>

                <th><a href='$_SERVER[PHP_SELF]?Campo=Apellido2&nombre=$nombre&apellido1=$apellido1&apellido2=$apellido2&minima=$min&maxima=$max'>Apellido2</a></th>

                <th><a href='$_SERVER[PHP_SELF]?Campo=Edad&nombre=$nombre&apellido1=$apellido1&apellido2=$apellido2&minima=$min&maxima=$max'>Edad</a></th>
                
                <th><a href='$_SERVER[PHP_SELF]?Campo=Telefono&nombre=$nombre&apellido1=$apellido1&apellido2=$apellido2&minima=$min&maxima=$max'>Telefono</a></th>
            </tr>";

    foreach ($alumnos as $alumno) {
        echo "<tr>";
        foreach ($alumno as $valor) {
            echo "<td>$valor</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
} 

$host = "localhost";
$user = "root";
$password = "root";
$database = "tema2";

// Conexión a la base de datos
$db = mysqli_connect($host, $user, $password, $database);

// Procesa los valores de los filtros desde POST para búsqueda inicial o desde GET para ordenación
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : (isset($_GET['nombre']) ? $_GET['nombre'] : '');

$apellido1 = isset($_POST['apellido1']) ? $_POST['apellido1'] : (isset($_GET['apellido1']) ? $_GET['apellido1'] : '');

$apellido2 = isset($_POST['apellido2']) ? $_POST['apellido2'] : (isset($_GET['apellido2']) ? $_GET['apellido2'] : '');

$min = isset($_POST['minima']) ? $_POST['minima'] : (isset($_GET['minima']) ? $_GET['minima'] : '');

$max = isset($_POST['maxima']) ? $_POST['maxima'] : (isset($_GET['maxima']) ? $_GET['maxima'] : '');

// Campo para ordenar
$campo = isset($_GET['Campo']) ? $_GET['Campo'] : 'NIF';

// Construcción de la consulta con filtros
$consulta = "SELECT * FROM alumnos WHERE 1";

if ($nombre != "") {
    $consulta .= " AND Nombre = '$nombre'";
}
if ($apellido1 != "") {
    $consulta .= " AND Apellido1 = '$apellido1'";
}
if ($apellido2 != "") {
    $consulta .= " AND Apellido2 = '$apellido2'";
}
if ($min != "") {
    $consulta .= " AND Edad >= '$min'";
}
if ($max != "") {
    $consulta .= " AND Edad <= '$max'";
}

$consulta .= " ORDER BY $campo";

// Ejecución de la consulta
$resul = mysqli_query($db, $consulta);
if ($resul) {
    $alumnos = mysqli_fetch_all($resul, MYSQLI_ASSOC);
} else {
    echo "<p>Error en la consulta: " . mysqli_error($db) . "</p>";
}

// Cierra la conexión a la base de datos
mysqli_close($db);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Alumno</title>
</head>

<body>
    <fieldset>
        <legend>Buscar Alumno</legend>
        <form name='form1' action='<?php echo $_SERVER['PHP_SELF'] ?>' method='post'>

            <p>
                <label for='nombre'>Nombre: </label>
                <input type='text' name='nombre' value='<?php echo $nombre ?>'>
            </p>
            <p>
                <label for='apellido1'>Apellido 1: </label>
                <input type='text' name='apellido1' value='<?php echo $apellido1 ?>'>
            </p>
            <p>
                <label for='apellido2'>Apellido 2: </label>
                <input type='text' name='apellido2' value='<?php echo $apellido2 ?>'>
            </p>
            <p>
                <label for="minima">Edad mínima:</label>
                <input type="text" name="minima" value="<?php echo $min ?>">
                <label for="maxima">Edad máxima:</label>
                <input type="text" name="maxima" value="<?php echo $max ?>">
            </p>

            <input type='submit' name='Buscar' value='Buscar'>
        </form>
    </fieldset>

    <?php
    // Mostrar la tabla si hay resultados
    if (isset($alumnos) && count($alumnos) > 0) {
        mostrarTabla($alumnos, $nombre, $apellido1, $apellido2, $min, $max);
    }
    ?>
</body>

</html>