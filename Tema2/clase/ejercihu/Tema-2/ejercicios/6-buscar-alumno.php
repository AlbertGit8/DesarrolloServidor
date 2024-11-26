<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    function mostrarTablaBDD($arrayTabla, $fields)
    {
        global $db, $seleccionados;

        $nombreTabla = "alumnos";
        $campoIdentificador = "NIF";

        echo "<p><table border='2px'><form name='formTabla' action='$_SERVER[PHP_SELF]' method='post'><th>Selec</th>";

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
        <p><input type='submit' name='enviar' value='Enviar'></p>
        </form></p>";
    }

    $alumnos = array();
    $fields = array();
    $seleccionados = array();

    $nombre = "";
    $apellido1 = "";
    $apellido2 = "";
    $edadMin = "";
    $edadMax = "";
    if (isset($_POST['buscar'])) {

        $nombre = $_POST['nombre'];
        $apellido1 = $_POST['apellido1'];
        $apellido2 = $_POST['apellido2'];
        $edadMin = $_POST['edadMin'];
        $edadMax = $_POST['edadMax'];
    }

    $host = "localhost"; //127.0.0.1

    $user = "root";

    $password = ""; //por defecto en blanco

    $database = "tema2";

    //se conecta al servidor de bbdd y devuelve un descriptor database
    $db = mysqli_connect($host, $user, $password, $database);

    // desplegable de alumnos
    $consulta = "SELECT * FROM `alumnos` WHERE 1 ";

    if ($nombre != "") {
        $consulta .= "AND Nombre='$nombre' ";
    }

    if ($apellido1 != "") {
        $consulta .= "AND Apellido1='$apellido1' ";
    }

    if ($apellido2 != "") {
        $consulta .= "AND Apellido2='$apellido2' ";
    }

    if ($edadMin != "") {
        $consulta .= "AND Edad >='$edadMin' ";
    }

    if ($edadMax != "") {
        $consulta .= "AND Edad <='$edadMax' ";
    }

    $resul = mysqli_query($db, $consulta);

    if ($resul) {
        $alumnos = mysqli_fetch_all($resul, MYSQLI_ASSOC);
        // Obtener los encabezados de las columnas 
        $fields = mysqli_fetch_fields($resul);
    } else {
        echo "Error en la consulta: " . mysqli_error($db);
    }
    ?>
    <fieldset>
        <legend>Buscar alumno</legend>
        <form name='form1' action='<?php echo $_SERVER['PHP_SELF'] ?>' method='post'>
            <p>
                <label for='nombre'>Nombre: </label>
                <input type='text' name='nombre' value=''>
            </p>
            <p>
                <label for='apellido1'>Apellido 1: </label>
                <input type='text' name='apellido1' value=''>
            </p>
            <p>
                <label for='apellido2'>Apellido 2: </label>
                <input type='text' name='apellido2' value=''>
            </p>
            <p>
                <label for='edadMin'>Edad minima: </label>
                <input type='number' name='edadMin' value=''>
                <label for='edadMax'>Edad máxima: </label>
                <input type='number' name='edadMax' value=''>
            </p>
            <input type='submit' name='buscar' value='Buscar'>
        </form>
    </fieldset>
    <?php
    if (isset($_POST['buscar'])) {
        mostrarTablaBDD($alumnos, $fields);
    }
    ?>
    <?php
    mysqli_close($db);
    ?>
</body>

</html>