<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    // Declaración de arrays para almacenar los alumnos y los seleccionados
    $alumnos = array();
    $seleccionados = array();

    // Datos de conexión a la base de datos
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "tema2";

    // Conexión a la base de datos
    $db = mysqli_connect($host, $user, $password, $database);

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
                    $_POST['telefonoFicha'][$index]
                );
            }
        }
    }

    // Realizar consulta SQL para obtener todos los alumnos
    $consulta = "SELECT * FROM `alumnos`";
    $resul = mysqli_query($db, $consulta);

    // Comprobar si la consulta fue exitosa y almacenar los datos
    if ($resul) {
        $alumnos = mysqli_fetch_all($resul);
    } else {
        echo "Error en la consulta: " . mysqli_error($db);
    }

    // Función para mostrar la tabla de alumnos con checkboxes para seleccionar
    function mostrarTablaAlumnos()
    {
        global $alumnos, $seleccionados;

        // Generar cada fila de la tabla con un checkbox para cada alumno
        foreach ($alumnos as $alumno) {
            echo "<tr>
            <td><input type='checkbox' name='seleccionados[$alumno[0]]' ";
            // Comprobar si el NIF del alumno está en el array $seleccionados
            if (array_key_exists($alumno[0], $seleccionados)) {
                echo " checked ";
            }
            echo "></td>
            <td>$alumno[1] $alumno[2] $alumno[3]</td>
            </tr>";
        }
    }

    // Función para mostrar el formulario de edición de un alumno específico
    function mostrarAlumno($nifAlumno)
    {
        global $db;

        // Consulta SQL para obtener los datos del alumno por su NIF
        $consulta = "SELECT * FROM `alumnos` WHERE NIF='$nifAlumno'";
        $resul = mysqli_query($db, $consulta);

        // Comprobar si la consulta fue exitosa y mostrar el formulario con los datos
        if ($resul) {
            $alumno = mysqli_fetch_row($resul);

            echo "<fieldset><legend>Alumno</legend>
            <input type='hidden' name='nifFicha[]' value='$alumno[0]'>
            <p>
                <label for='nombreFicha'>Nombre: </label>
                <input type='text' name='nombreFicha[]' value='$alumno[1]'> 
            </p>
            <p>
                <label for='apellido1Ficha'>Apellido 1: </label>
                <input type='text' name='apellido1Ficha[]' value='$alumno[2]'>
            </p>
            <p>
                <label for='apellido2Ficha'>Apellido 2: </label>
                <input type='text' name='apellido2Ficha[]' value='$alumno[3]'> 
            </p>
            <p>
                <label for='telefonoFicha'>Telefono: </label>
                <input type='text' name='telefonoFicha[]' value='$alumno[4]'> 
            </p>
            </fieldset>";
        } else {
            echo "<p>Error en la consulta: " . mysqli_error($db) . "</p>";
        }
    }

    // Función para actualizar los datos de un alumno en la base de datos
    function actualizarAlumnos($nifAlumno, $nombreAct, $apellido1Act, $apellido2Act, $telefonoAct)
    {
        global $db;

        // Consulta SQL para actualizar los datos del alumno
        $consulta = "UPDATE alumnos 
        SET Nombre = '$nombreAct', Apellido1 = '$apellido1Act', Apellido2 = '$apellido2Act', Telefono= '$telefonoAct'
        WHERE NIF = '$nifAlumno'";

        // Ejecutar la consulta y mostrar error si ocurre
        $resul = mysqli_query($db, $consulta);

        if (!$resul) {
            echo "<p>Error en la consulta: " . mysqli_error($db) . "</p>";
        }
    }
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
                <input type='submit' name='mostrar' value='Mostrar fichas'>
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
                    // Mensaje si no se ha seleccionado ningún alumno
                    echo "<p>Selecciona algún alumno</p>";
                }
            } 
            ?>
        </form>
    </fieldset>

    <?php
    // Cerrar la conexión a la base de datos
    mysqli_close($db);
    ?>
</body>

</html>
