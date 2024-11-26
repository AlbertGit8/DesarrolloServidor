<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("../libreriaBD.php");
require_once("03funciones.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkbox</title>
</head>

<body>
    <?php
    // Declaración de arrays para almacenar los alumnos y los seleccionados
    $alumnos = array();
    $seleccionados = array();

    // Guardar los NIF seleccionados en el array $seleccionados como claves
    if (isset($_POST['seleccionados'])) {
        foreach ($_POST['seleccionados'] as $nif => $valor) {
            $seleccionados[$nif] = true;  // Guardar los NIF seleccionados como claves
        }
    }

    // Comprobar si se ha enviado el formulario de actualización
    if (isset($_POST['actualizar'])) {
        // Iterar sobre cada alumno seleccionado y actualizar sus datos en la base de datos
        foreach ($seleccionados as $nifAlumno => $valor) {
            $index = array_search($nifAlumno, $_POST['nifFicha']);  // Obtener el índice del alumno en el array de datos

            // Llamada a la función actualizarAlumnos con los datos actuales del alumno
            if ($index !== false) {
                actualizarAlumnos(
                    $nifAlumno,
                    $_POST['nombreFicha'][$index],
                    $_POST['apellido1Ficha'][$index],
                    $_POST['apellido2Ficha'][$index],
                    $_POST['edadFicha'][$index],
                    $_POST['telefonoFicha'][$index]
                );
            }
        }
    }

    // Realizar consulta SQL para obtener todos los alumnos
    $consulta = "SELECT * FROM `alumnos`";
    $resul = consultaDatos($consulta);

    $alumnos = mysqli_fetch_all($resul);
    ?>

    <fieldset>
        <legend>Tabla de alumnos</legend>
        <form name='form1' action='<?php echo $_SERVER['PHP_SELF'] ?>' method='post'>
            <table border="2px">
                <tr>
                    <th>Selec</th>
                    <th>Alumno</th>
                </tr>
                <?php
                // Llamada a la función para mostrar la tabla de alumnos con checkboxes
                mostrarTablaAlumnos();
                ?>
            </table>
            <p>
                <input type='submit' name='mostrar' value='Mostrar Fichas'>
            </p>
            <?php
            // Si se ha hecho clic en "Mostrar fichas" y hay alumnos seleccionados
            if (isset($_POST['mostrar'])) {
                if (isset($_POST['mostrar']) && !empty($seleccionados)) {
                    // Mostrar el formulario de edición para cada alumno seleccionado
                    foreach (array_keys($seleccionados) as $nif) {
                        mostrarAlumno($nif);
                    }
                    // Mostrar un solo botón "Actualizar" al final
                    echo "<br><input type='submit' name='actualizar' value='Actualizar'>";
                } else {
                    // Mensaje si no se ha seleccionado ningúno alumno
                    echo "<p>Selecciona algun alumno</p>";
                }
            }
            ?>
        </form>
    </fieldset>
</body>

</html>