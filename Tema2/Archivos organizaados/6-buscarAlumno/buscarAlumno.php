<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("../libreriaBD.php");
require_once("06funciones.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Alumno</title>
</head>

<body>
    <?php
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

    $alumnos = consultaDatosAssoc($consulta);
    ?>
</body>
<fieldset>
    <legend>Buscar Alumnos</legend>
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
</html>