<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar dependientes en un desplegable</title>
</head>

<body>
    <?php
    // Función para obtener todos los registros de la tabla elegida
    function obtenerArrayTabla($nombreTabla)
    {
        global $db, $paisSeleccionado, $provinciaSeleccionada;

        switch ($nombreTabla) {
            case 'paises':
                $consulta = obtenerPaises();
                break;
            case 'provincias':
                $consulta = obtenerProvincias($paisSeleccionado);
                break;
            case 'localidades':
                $consulta = obtenerLocalidades($paisSeleccionado, $provinciaSeleccionada);
        }

        // Define la consulta SQL

        $resul = mysqli_query($db, $consulta); // Ejecuta la consulta

        if ($resul) { // Verifica si la consulta fue exitosa
            $arrayTabla = mysqli_fetch_all($resul, MYSQLI_ASSOC); // Convierte el resultado en un array asociativo
        } else {
            echo "Error en la consulta: " . mysqli_error($db); // Muestra un error si la consulta falla
        }
        return $arrayTabla; // Retorna el array de resultados
    }

    function obtenerPaises()
    {
        return "SELECT * FROM paises WHERE 1 ";
    }
    function obtenerProvincias($pais)
    {
        return "SELECT * FROM provincias WHERE IdPais = '$pais'";
    }
    function obtenerLocalidades($pais, $provincia)
    {
        return "SELECT * FROM localidades WHERE IdPais = '$pais' AND IdProvincia = '$provincia'";
    }

    // Conexión a la base de datos
    $host = "localhost"; //127.0.0.1
    $user = "root";
    $password = ""; // Por defecto en blanco
    $database = "tema2";

    // Se conecta al servidor de BBDD y devuelve un descriptor de la base de datos
    $db = mysqli_connect($host, $user, $password, $database);

    // Inicializa las variables para país, provincia y localidad seleccionados
    $paisSeleccionado = "";
    if (isset($_POST['pais'])) {
        $paisSeleccionado = $_POST['pais'];
    }

    $provinciaSeleccionada = "";
    if (isset($_POST['provincia'])) {
        $provinciaSeleccionada = $_POST['provincia'];
    }

    $localidadSeleccionada = "";
    if (isset($_POST['localidad'])) {
        $localidadSeleccionada = $_POST['localidad'];
    }


    ?>
    <fieldset>
        <legend>Ficha del alumno</legend>
        <!-- Formulario para mostrar y actualizar los datos del alumno -->
        <form name='form1' action='<?php echo $_SERVER['PHP_SELF'] ?>' method='post'>
            <p>
                <label for='nombre'>Pais: </label>
                <select name="pais" onChange="form1.submit()">
                    <option value=""></option>

                    <?php
                    $paises = obtenerArrayTabla("paises");
                    foreach ($paises as $clave => $paisDes) {
                        // Creamos la opción con el primer campo como valor

                        echo "<option value='$paisDes[Id]' ";

                        // Si el valor coincide con la selección actual, marcamos la opción como seleccionada
                        if ($paisSeleccionado == $paisDes['Id']) {
                            echo " selected ";
                        }

                        // Mostramos el nombre y apellido del alumno en la opción
                        echo " >$paisDes[Nombre] </option>";
                    }
                    ?>
                </select>
            </p>
            <?php
            if ($paisSeleccionado != "") {
                echo "<p>
                <label for='provincia'>Provincias: </label>
                <select name='provincia' onChange='form1.submit()'>
                    <option value=''></option>";

                $provincias = obtenerArrayTabla("provincias");
                foreach ($provincias as $clave => $provDes) {
                    // Creamos la opción con el primer campo como valor
                    echo "<option value='$provDes[IdPro]' ";

                    // Si el valor coincide con la selección actual, marcamos la opción como seleccionada
                    if ($provinciaSeleccionada == $provDes['IdPro']) {
                        echo " selected ";
                    }

                    // Mostramos el nombre de la provincia en la opción
                    echo " >$provDes[Nombre] </option>";
                }
                echo "</select></p>";
            }


            if ($provinciaSeleccionada != "") {
                echo "<p>
                <label for='localidad'>Localidades: </label>
                <select name='localidad' onChange='form1.submit()'>
                    <option value=''></option>";

                $localidades = obtenerArrayTabla("localidades");
                foreach ($localidades as $clave => $locDes) {
                    // Creamos la opción con el primer campo como valor
                    echo "<option value='$locDes[IdLoc]' ";

                    // Si el valor coincide con la selección actual, marcamos la opción como seleccionada
                    if ($localidadSeleccionada == $locDes['IdLoc']) {
                        echo " selected ";
                    }

                    // Mostramos el nombre de la localidad en la opción
                    echo " >$locDes[Nombre] </option>";
                }
                echo "</select></p>";
            }

            ?>

        </form>
    </fieldset>
    <?php
    mysqli_close($db);
    ?>
</body>

</html>