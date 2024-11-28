<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("../libreriaBD.php");
require_once("09funciones.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paginacion ficha</title>
</head>

<body>
    <!-- Al formulario del 1 le añadimos botones para pasar de la página actual a la siguiente y viceversa
    << < > >>
    ir al primero, retroceder, avanzar, ir al último 
    -->

    <?php
    // Inicialización de variables
    $NIF = "";
    $nombre = "";
    $apellido1 = "";
    $apellido2 = "";
    $edad = "";
    $telefono = "";

    // Obtiene el array de alumnos
    $arrayAlumnos = obtenerArrayTabla();
    $buscar = "primero"; // Inicializa la variable de búsqueda
    $posicionActual = 0; // Inicializa la posición actual

    // Verifica si existen parámetros GET y los asigna a las variables correspondientes
    if (isset($_GET['buscar'])) {
        $buscar = $_GET['buscar'];
    }

    if (isset($_GET['posicionActual'])) {
        $posicionActual = $_GET['posicionActual'];
    }

    // Busca el alumno basado en los parámetros
    buscarAlumno($buscar, $posicionActual);

    // ACTUALIZAR Y BORRAR
    if (isset($_POST['borrar']) || isset($_POST['actualizar'])) {
        // Verifica si los campos de formulario están definidos y los asigna a las variables correspondientes
        if (isset($_POST['NIF'])) {
            $NIF = $_POST['NIF'];
        }
        if (isset($_POST['nombre'])) {
            $nombre = $_POST['nombre'];
        }
        if (isset($_POST['apellido1'])) {
            $apellido1 = $_POST['apellido1'];
        }
        if (isset($_POST['apellido2'])) {
            $apellido2 = $_POST['apellido2'];
        }
        if (isset($_POST['edad'])) {
            $edad = $_POST['edad'];
        }
        if (isset($_POST['telefono'])) {
            $telefono = $_POST['telefono'];
        }
    }
    ?>

    <fieldset>
        <legend>Ficha del alumno</legend>
        <!-- Formulario para mostrar y actualizar los datos del alumno -->
        <form name='form1' action='<?php echo $_SERVER['PHP_SELF'] ?>' method='post'>
            <p>
                <label for='nombre'>NIF: </label>
                <input type='text' name='nif' value='<?php echo $NIF ?>' disabled>
            </p>
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
                <label for='edad'>Edad: </label>
                <input type='text' name='edad' value='<?php echo $edad ?>'>
            </p>
            <p>
                <label for='telefono'>Telefono: </label>
                <input type='text' name='telefono' value='<?php echo $telefono ?>'>
            </p>
            <p><input type='submit' name='actualizar' value='Actualizar'><input type='submit' name='borrar' value='Borrar'></p>
        </form>

        <?php
        // Muestra la posición actual y los enlaces para navegar entre registros

        echo "<a href='" . $_SERVER['PHP_SELF'] . "?buscar=primero&posicionActual=$posicionActual'><< &nbsp &nbsp &nbsp</a>";
        echo "<a href='" . $_SERVER['PHP_SELF'] . "?buscar=anterior&posicionActual=$posicionActual'>< &nbsp &nbsp &nbsp</a>";
        echo "<a href='" . $_SERVER['PHP_SELF'] . "?buscar=siguiente&posicionActual=$posicionActual'>> &nbsp &nbsp &nbsp</a>";
        echo "<a href='" . $_SERVER['PHP_SELF'] . "?buscar=ultimo&posicionActual=$posicionActual'>>> </a>";

        // Verifica si se ha presionado el botón 'actualizar' y llama a la función para actualizar el alumno
        if (isset($_POST['actualizar'])) {
            actualizarAlumno($NIF, $nombre, $apellido1, $apellido2, $edad, $telefono);
        }

        // Verifica si se ha presionado el botón 'borrar' y llama a la función para borrar el alumno
        if (isset($_POST['borrar'])) {
            borrarAlumno($NIF);
        }
        ?>
    </fieldset>
</body>

</html>