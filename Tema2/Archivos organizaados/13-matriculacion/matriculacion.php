<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("../libreriaBD.php");
require_once("13funciones.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matriculacion</title>
</head>

<body>
    <?php
    global $alumnosSeleccionados, $modulosSeleccionados;


    $alumnos = [];
    $fields = [];
    $alumnosSeleccionados = [];
    $modulosSeleccionados = [];
    $curso = ""; //almacena el id del curso seleccionado

    $pagActual = 1; //pagina principal por defecto
    $numFilasPagina = 5; //valor de fila por pagina por defecto

    if (isset($_POST['alumnosSeleccionados'])) {
        $alumnosSeleccionados = $_POST['alumnosSeleccionados'];
    }

    if (isset($_POST['modulosSeleccionados'])) {
        $modulosSeleccionados = $_POST['modulosSeleccionados'];
    }

    if (isset($_POST['curso'])) {
        $curso = $_POST['curso'];
    }

    if (isset($_GET['pagActual'])) {
        $pagActual = $_GET['pagActual'];
    }
    ?>

    <fieldset>
        <legend>Matriculacion</legend>
        <form name='form1' action='<?php echo $_SERVER['PHP_SELF']; ?>' method='get'>
            <p>
                <label for='numFilasPagina'>Número de filas por página:</label>
                <select name="numFilasPagina" onchange="this.form.submit()">
                    <option value=""></option>
                    <?php
                    for ($i = 1; $i <= 10; $i++) {
                        $selected = ($numFilasPagina == $i) ? "selected" : "";
                        echo "<option value='$i' $selected>$i</option>";
                    }
                    ?>
                </select>
            </p>
            <?php
            obtenerArrayPagActual($pagActual, $numFilasPagina);
            mostrarTablaAlumnos($alumnos, $fields);

            // Calcular número de enlaces de paginación.
            $totalRegistros = obtenerTotalAlumnos();
            $numEnlaces = ceil($totalRegistros / $numFilasPagina);

            echo "<p>";
            for ($i = 1; $i <= $numEnlaces; $i++) {
                echo "<a href='" . $_SERVER['PHP_SELF'] . "?pagActual=$i&numFilasPagina=$numFilasPagina'>$i</a> ";
            }
            echo "</p>";

            echo "<br>";

            mostrarTablaModulos();
            ?>

            <p>
                <label for="curso"><b>CURSO</b></label>
                <select name="curso">
                    <option value=""></option>
                    <option value="1">22-23</option>
                    <option value="2">23-24</option>
                    <option value="3">24-25</option>
                </select>
            </p>
            <input type="submit" name="matricular" value="Matricular">
        </form>

        <?php
        if (isset($_POST['matricular'])) {
            if (count($alumnosSeleccionados) !== 0 && count($modulosSeleccionados) !== 0 && $curso !== "") {
                matricularSeleccionados($alumnosSeleccionados, $modulosSeleccionados, $curso);

            } else {
                echo "<p>Debe seleccionar al menos un alumno, un modulo y un curso para continuar.</p>";
            }
        }
        ?>

    </fieldset>
</body>

</html>