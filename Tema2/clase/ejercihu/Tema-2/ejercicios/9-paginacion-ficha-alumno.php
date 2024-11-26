<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- Al formulario del 1 le añadimos botones para pasar de la página actual a la siguiente y viceversa
    << < > >>
    ir al primero, retroceder, avanzar, ir al último 
    -->
    <?php
    // Función para obtener todos los registros de la tabla 'alumnos'
    function obtenerArrayTabla()
    {
        global $db; // Accede a la variable global $db

        $consulta = "SELECT * FROM `alumnos` WHERE 1 "; // Define la consulta SQL

        $resul = mysqli_query($db, $consulta); // Ejecuta la consulta

        if ($resul) { // Verifica si la consulta fue exitosa
            $arrayTabla = mysqli_fetch_all($resul, MYSQLI_ASSOC); // Convierte el resultado en un array asociativo
        } else {
            echo "Error en la consulta: " . mysqli_error($db); // Muestra un error si la consulta falla
        }
        return $arrayTabla; // Retorna el array de resultados
    }

    // Función para buscar un alumno en base al criterio y actualizar la posición actual
    function buscarAlumno($buscar, &$posicionActual)
    {
        global $NIF, $nombre, $apellido1, $apellido2, $edad, $telefono, $arrayAlumnos;

        switch ($buscar) { // Evalúa el criterio de búsqueda
            case 'primero':
                $alumno = $arrayAlumnos[0]; // Selecciona el primer alumno
                $posicionActual = 0; // Establece la posición actual a 0
                break;
            case 'anterior':
                $posAnterior = $posicionActual - 1; // Calcula la posición anterior
                if ($posAnterior < 0) {
                    $posAnterior = 0; // Asegura que no sea menor que 0
                }
                $alumno = $arrayAlumnos[$posAnterior]; // Selecciona el alumno en la posición anterior
                $posicionActual = $posAnterior; // Actualiza la posición actual
                break;
            case 'siguiente':
                $posSiguiente = $posicionActual + 1; // Calcula la posición siguiente
                if ($posSiguiente > count($arrayAlumnos) - 1) {
                    $posSiguiente = count($arrayAlumnos) - 1; // Asegura que no exceda el límite
                }
                $alumno = $arrayAlumnos[$posSiguiente]; // Selecciona el alumno en la posición siguiente
                $posicionActual = $posSiguiente; // Actualiza la posición actual
                break;
            case 'ultimo':
                $alumno = $arrayAlumnos[count($arrayAlumnos) - 1]; // Selecciona el último alumno
                $posicionActual = count($arrayAlumnos) - 1; // Establece la posición actual al último índice
        }

        // Actualiza las variables globales con los datos del alumno seleccionado
        $NIF = $alumno['NIF'];
        $nombre = $alumno['Nombre'];
        $apellido1 = $alumno['Apellido1'];
        $apellido2 = $alumno['Apellido2'];
        $edad = $alumno['Edad'];
        $telefono = $alumno['Telefono'];
    }

    // Conexión a la base de datos
    $host = "localhost"; //127.0.0.1
    $user = "root";
    $password = ""; // Por defecto en blanco
    $database = "tema2";

    // Se conecta al servidor de BBDD y devuelve un descriptor de la base de datos
    $db = mysqli_connect($host, $user, $password, $database);

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
        </form>
        <?php
        // Muestra la posición actual y los enlaces para navegar entre registros

        echo "<a href='" . $_SERVER['PHP_SELF'] . "?buscar=primero&posicionActual=$posicionActual'><< &nbsp &nbsp &nbsp</a>";
        echo "<a href='" . $_SERVER['PHP_SELF'] . "?buscar=anterior&posicionActual=$posicionActual'>< &nbsp &nbsp &nbsp</a>";
        echo "<a href='" . $_SERVER['PHP_SELF'] . "?buscar=siguiente&posicionActual=$posicionActual'>> &nbsp &nbsp &nbsp</a>";
        echo "<a href='" . $_SERVER['PHP_SELF'] . "?buscar=ultimo&posicionActual=$posicionActual'>>> </a>";

        mysqli_close($db);
        ?>
    </fieldset>
</body>

</html>