<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php


    function obtenerArrayTabla()
    {
        global $db, $arrayTabla, $fields;

        $consulta = "SELECT * FROM `alumnos` WHERE 1 ";

        $resul = mysqli_query($db, $consulta);

        if ($resul) {
            $arrayTabla = mysqli_fetch_all($resul, MYSQLI_ASSOC);
            // Obtener los encabezados de las columnas 
            $fields = mysqli_fetch_fields($resul);
        } else {
            echo "Error en la consulta: " . mysqli_error($db);
        }
    }

    function mostrarTablaBDD($arrayTabla, $fields)
    {
        global $seleccionados;

        $campoIdentificador = "NIF";

        echo "<p><form name='formTabla' action='$_SERVER[PHP_SELF]' method='post'><table border='2px'><th>Selec</th><th>Alumno</th>";

        // Obtener y mostrar los datos de todas las filas
        foreach ($arrayTabla as $nombreColumna => $fila) {
            echo "<tr>
                <td><input type='checkbox' name='seleccionados[$fila[$campoIdentificador]]' ";
            // Comprobar si el NIF del alumno está en el array $seleccionados
            if (array_key_exists($fila[$campoIdentificador], $seleccionados)) {
                echo " checked ";
            }
            echo "></td>
                ";

            echo "<td> $fila[Nombre] $fila[Apellido1] $fila[Apellido2]</td>";

            echo "</tr>";
        }
        echo "</table>
        <p><input type='submit' name='mostrar' value='Mostrar fichas'></p>
        </form></p>";
    }

    function mostrarFichas($seleccionados)
    {
        global $arrayTabla;

        echo "<form name='formFicha' action='$_SERVER[PHP_SELF]' method='post'>";
        foreach ($arrayTabla as $key => $fila) {
            if (array_key_exists($fila['NIF'], $seleccionados)) {
                $NIF = $fila['NIF'];
                echo "
                <p>
                <fieldset>
                <legend>Ficha alumno</legend>
                
                <p>
                <label for='NIF'>NIF: </label>
                <input type='text' name='NIF' value='$NIF' readonly>
                </p>
                <p> 
                <label for='Nombres[$NIF]'>Nombre: </label> 
                <input type='text' name='Nombres[$NIF]' value='" . $fila['Nombre'] . "'>
                </p> 
                <p> 
                <label for='Apellidos1[$NIF]'>Apellido1: </label>
                <input type='text' name='Apellidos1[$NIF]' value='" . $fila['Apellido1'] . "'>
                </p>
                <p> 
                <label for='Apellidos2[$NIF]'>Apellido2: </label> 
                <input type='text' name='Apellidos2[$NIF]' value='" . $fila['Apellido2'] . "'> 
                </p>
                <p>
                <label for='Edades[$NIF]'>Edad: </label> 
                <input type='text' name='Edades[$NIF]' value='" . $fila['Edad'] . "'> 
                </p>
                <p>
                <label for='Telefonos[$NIF]'>Telefono: </label>
                <input type='text' name='Telefonos[$NIF]' value='" . $fila['Telefono'] . "'>
                </p>
                
                </fieldset>
                </p>
                ";
            }
        }
        echo "<input type='submit' name='actualizar' value='Actualizar'>";
        echo "</form>";
    }

    function actualizarAlumnos($seleccionados, $Nombres, $Apellidos1, $Apellidos2, $Edades, $Telefonos)
    {
        global $db;

        foreach ($seleccionados as $NIF => $value) {
            $consulta = "UPDATE alumnos 
            SET Nombre = '$Nombres[$NIF]', Apellido1 = '$Apellidos1[$NIF]', Apellido2 = '$Apellidos2[$NIF]', Edad = '$Edades[$NIF]', Telefono= '$Telefonos[$NIF]'
            WHERE NIF = '$NIF'";

            // Ejecutar la consulta y mostrar error si ocurre
            $resul = mysqli_query($db, $consulta);

            if ($resul) {
                echo "<p>Alumno actualizado </p>";
            } else {
                echo "<p>Error en la consulta: " . mysqli_error($db) . "</p>";
            }
        }
    }

    $arrayTabla = array();
    $fields = array();
    $seleccionados = array();

    if (isset($_POST['seleccionados'])) {
        $seleccionados = $_POST['seleccionados'];
    }

    // Comprobar si se ha enviado el formulario de actualización
    if (isset($_POST['actualizar'])) {
        echo "entra";

        $Nombres = array();
        if (isset($_POST['Nombres'])) {
            $Nombres = $_POST['Nombres'];
        }

        $Apellidos1 = array();
        if (isset($_POST['Apellidos1'])) {
            $Apellidos1 = $_POST['Apellidos1'];
        }

        $Apellidos2 = array();
        if (isset($_POST['Apellidos2'])) {
            $Apellidos2 = $_POST['Apellidos2'];
        }

        $Edades = array();
        if (isset($_POST['Edades'])) {
            $Edades = $_POST['Edades'];
        }

        $Telefonos = array();
        if (isset($_POST['Telefonos'])) {
            $Telefonos = $_POST['Telefonos'];
        }

        actualizarAlumnos($seleccionados, $Nombres, $Apellidos1, $Apellidos2, $Edades, $Telefonos);
    }

    $host = "localhost"; //127.0.0.1

    $user = "root";

    $password = ""; //por defecto en blanco

    $database = "tema2";

    //se conecta al servidor de bbdd y devuelve un descriptor database
    $db = mysqli_connect($host, $user, $password, $database);

    obtenerArrayTabla();
    ?>

    <fieldset>
        <legend>Tabla de alumnos</legend>
        <?php
        mostrarTablaBDD($arrayTabla, $fields)
        ?>
    </fieldset>

    <?php
    if (isset($_POST['mostrar'])) {
        if (count($seleccionados) != 0) {
            mostrarFichas($seleccionados);
        } else {
            echo "<p>Seleccion al menos un alumno para continuar.</p>";
        }
    }

    if (isset($_POST['actualizar'])) {



        foreach ($Nombres as $key => $value) {
            echo $key . "-" . "<br>";
        }
        foreach ($Apellidos1 as $key => $value) {
            echo $key . "-" . "<br>";
        }
        foreach ($Apellidos2 as $key => $value) {
            echo $key . "-" . "<br>";
        }
        foreach ($Edades as $key => $value) {
            echo $key . "-" . "<br>";
        }
        foreach ($Telefonos as $key => $value) {
            echo $key . "-" . "<br>";
        }

        actualizarAlumnos($seleccionados, $Nombres, $Apellidos1, $Apellidos2, $Edades, $Telefonos);
    }
    ?>
</body>

</html>