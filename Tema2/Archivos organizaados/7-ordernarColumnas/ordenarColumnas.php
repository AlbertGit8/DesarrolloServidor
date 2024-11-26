<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("../libreriaBD.php");
require_once("07funciones.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordenar columnas</title>
</head>

<body>
    <?php
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

        $resul = consultaDatos($consulta);

        if ($resul) {
            $alumnos = consultaDatosAssoc($consulta);
            $fields = mysqli_fetch_fields($resul);
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
</body>

</html>