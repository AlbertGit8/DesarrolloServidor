<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("../libreriaBD.php");
require_once("08funciones.php");

$alumnos = [];
$fields = [];
$seleccionados = [];

$pagActual = isset($_GET['pagActual']) ? (int) $_GET['pagActual'] : 1;
$numFilasPagina = isset($_GET['numFilasPagina']) ? (int) $_GET['numFilasPagina'] : 5;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paginación</title>
</head>

<body>
    <fieldset>
        <legend>Paginación</legend>
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
        </form>

        <?php
        obtenerArrayPagActual($pagActual, $numFilasPagina);
        mostrarTablaBDD($alumnos, $fields);

        // Calcular número de enlaces de paginación.
        $totalRegistros = obtenerTotalAlumnos();
        $numEnlaces = ceil($totalRegistros / $numFilasPagina);

        echo "<p>";
        for ($i = 1; $i <= $numEnlaces; $i++) {
            echo "<a href='" . $_SERVER['PHP_SELF'] . "?pagActual=$i&numFilasPagina=$numFilasPagina'>$i</a> ";
        }
        echo "</p>";
        ?>
    </fieldset>
</body>

</html>