<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("../libreriaBD.php");
require_once("02funciones.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desplegable actualiza</title>
</head>

<body>
    <?php
    $desplegable = "";
    $alumnos = array();

    //actualizar antes de cargar el resul para que se actualice el desplegable
    if (isset($_POST['actualizar'])) {
        $nifFicha = $_POST['nifFicha'];  // Obtiene el NIF del alumno del formulario
        actualizarAlumno($nifFicha);      // Actualiza los datos del alumno      
    }

    $consulta = "SELECT * FROM `alumnos`";
    $resul = consultaDatos($consulta);

    if ($resul) {
        $alumnos = mysqli_fetch_all($resul);
    }

    if (isset($_POST['desplegable'])) {
        $desplegable = $_POST['desplegable'];
    }
    ?>
    <!-- actualiza desplegable con nombre y primer apellido y un boton mostrar y te crea un formulario rellenado con los datos del alumno (nif disabled)  -->

    <fieldset>
        <legend>Desplagable de alumnos</legend>

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <label for="desplegable">Alumnos: </label>
            <select name="desplegable">
                <option value=""></option>

                <?php foreachSelect($alumnos, $desplegable) ?>

            </select>

            <input type="submit" value="Mostrar" name="Mostrar">

            <?php
            if (isset($_POST['Mostrar']) || isset($_POST['actualizar'])) {
                mostrarAlumno($desplegable);
            }
            ?>
        </form>
    </fieldset>
</body>

</html>