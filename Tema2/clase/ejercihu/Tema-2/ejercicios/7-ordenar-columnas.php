<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>7-Ordenar Columnas</title>
</head>

<body>
    <?php
    function mostrarTablaBDD($arrayTabla, $fields)
    {
        global $seleccionados, $nombre, $apellido1, $apellido2, $edadMin, $edadMax;

        $campoIdentificador = "NIF";

        echo "<p><table border='2px'><form name='formTabla' action='" . $_SERVER['PHP_SELF'] . "' method='post'><thead><tr><th>Selec</th>";

        // Primer foreach para mostrar los nombres de las columnas de la tabla
        foreach ($fields as $nombreColumna) {
            echo "<th><a href='" . $_SERVER['PHP_SELF'] . "?Campo=$nombreColumna->name&nombre=$nombre&apellido1=$apellido1&apellido2=$apellido2&edadMin=$edadMin&edadMax=$edadMax'>$nombreColumna->name</a></th>";
        }

        // Obtener y mostrar los datos de todas las filas
        foreach ($arrayTabla as $fila) {
            echo "<tr>
            <td><input type='checkbox' name='seleccionados[" . $fila[$campoIdentificador] . "]' ";
            if (array_key_exists($fila[$campoIdentificador], $seleccionados)) {
                echo " checked ";
            }
            echo "></td>";

            foreach ($fila as $valor) {
                echo "<td> $valor </td>";
            }
            echo "</tr>";
        }

        echo "</tbody></table>
        <p><input type='submit' name='enviar' value='Enviar'></p>
        </form></p>";
    }


    $alumnos = array();
    $fields = array();
    $seleccionados = array();

    $campo = "NIF";

    $nombre = "";
    $apellido1 = "";
    $apellido2 = "";
    $edadMin = "";
    $edadMax = "";

    if (isset($_POST['nombre'])) {
        $nombre = $_POST['nombre'];
    } else if (isset($_GET['nombre'])) {
        $nombre = $_GET['nombre'];
    }

    if (isset($_POST['apellido1'])) {
        $apellido1 = $_POST['apellido1'];
    } else if (isset($_GET['apellido1'])) {
        $apellido1 = $_GET['apellido1'];
    }

    if (isset($_POST['apellido2'])) {
        $apellido2 = $_POST['apellido2'];
    } else if (isset($_GET['apellido2'])) {
        $apellido2 = $_GET['apellido2'];
    }

    if (isset($_POST['edadMin'])) {
        $edadMin = $_POST['edadMin'];
    } else if (isset($_GET['edadMin'])) {
        $edadMin = $_GET['edadMin'];
    }

    if (isset($_POST['edadMax'])) {
        $edadMax = $_POST['edadMax'];
    } else if (isset($_GET['edadMax'])) {
        $edadMax = $_GET['edadMax'];
    }

    $host = "localhost"; //127.0.0.1

    $user = "root";

    $password = ""; //por defecto en blanco

    $database = "tema2";

    //se conecta al servidor de bbdd y devuelve un descriptor database
    $db = mysqli_connect($host, $user, $password, $database);

    if (isset($_POST['buscar']) || isset($_GET['Campo'])) {
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
        if (isset($_GET['Campo'])) {
            $campo = $_GET['Campo'];
            $consulta .= " ORDER BY $campo ASC";
        }
        $resul = mysqli_query($db, $consulta);
        if ($resul) {
            $alumnos = mysqli_fetch_all($resul, MYSQLI_ASSOC);
            $fields = mysqli_fetch_fields($resul);
        } else {
            echo "Error en la consulta: " . mysqli_error($db);
        }
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
    //los enlaces siempre se mandan en GET 
    if (isset($_POST['buscar']) || isset($_GET['Campo'])) {
        mostrarTablaBDD($alumnos, $fields);
    }
    ?>
    <?php
    mysqli_close($db);
    ?>
</body>

</html>