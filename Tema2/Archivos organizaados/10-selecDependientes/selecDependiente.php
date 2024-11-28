<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("../libreriaBD.php");
require_once("10funciones.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccion Dependiente</title>
</head>

<body>
    <?php
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
        <legend>Paises y localidades</legend>

        <form name='form1' action='<?php echo $_SERVER['PHP_SELF'] ?>' method='post'>
        <p>
        <label for='nombre'>Pais: </label>
                <select name="pais" onChange="form1.submit()">
                    <option value=""></option>

                    <?php
                    $paises = obtenerArrayTabla("paises");

                    foreach ($paises as $pais) {
                        //Creamos la opción con el primer  campo como valor

                        echo "<option value='$pais[Id]'";

                        // Si el valor coincide con la selección actual, marcamos la opción como seleccionada
                        if ($paisSeleccionado == $pais['Id']) {
                            echo " selected ";
                        }

                        //Mostramos el nombre del pais
                        echo " >$pais[Nombre] </option>";
                    }
                    ?>

                </select>
        </p>

        <?php
        if ($paisSeleccionado != "") {
            echo "
            <p>
                <label for='provincia'>Provincias: </label>
                <select name='provincia' onChange='form1.submit()'>
                    <option value=''></option>
            ";

            $provincias = obtenerArrayTabla("provincias");
            foreach ($provincias as $provincia) {
                // Creamos la opción con el primer campo como valor
                echo "<option value='$provincia[IdPro]' ";

                // Si el valor coincide con la selección actual, marcamos la opción como seleccionada
                if ($provinciaSeleccionada == $provincia['IdPro']) {
                    echo " selected ";
                }

                // Mostramos el nombre de la provincia en la opción
                echo " >$provincia[Nombre] </option>";
            }
             echo "
                </select>
            </p>";
        }

        if ($provinciaSeleccionada != "") {
            echo "<p>
            <label for='localidad'>Localidades: </label>
            <select name='localidad' onChange='form1.submit()'>
                <option value=''></option>";

            $localidades = obtenerArrayTabla("localidades");
            foreach ($localidades as $localidad) {
                // Creamos la opción con el primer campo como valor
                echo "<option value='$localidad[IdLoc]' ";

                // Si el valor coincide con la selección actual, marcamos la opción como seleccionada
                if ($localidadSeleccionada == $localidad['IdLoc']) {
                    echo " selected ";
                }

                // Mostramos el nombre de la localidad en la opción
                echo " >$localidad[Nombre] </option>";
            }
            echo "</select></p>";
        }
        ?>
        </form>
    </fieldset>
</body>


</html>