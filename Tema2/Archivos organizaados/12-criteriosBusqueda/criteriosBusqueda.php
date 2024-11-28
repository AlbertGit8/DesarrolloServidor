<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("../libreriaBD.php");
require_once("12funciones.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criterios de busqueda</title>
</head>

<body>
    <?php
    // mejores si empieza desde arriba peores si empieza desde abajo
    $opcMejorPeor = "";
    if (isset($_POST['opcMejorPeor'])) {
        $opcMejorPeor = $_POST['opcMejorPeor'];
    }

    //1 a 10 registros de busqueda
    $numRegistros = "";
    if (isset($_POST['numRegistros'])) {
        $numRegistros = $_POST['numRegistros'];
    }

    // SI puede tener suspensos o si NO puede tener suspensos
    $suspensos = "si";
    if (isset($_POST['suspensos'])) {
        $suspensos = $_POST['suspensos'];
    }

    $mejorPeor = array("mejores" => "Mejores", "peores" => "Peores");
    $registros = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
    ?>

    <fieldset>
        <form name="f1" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <select name="opcMejorPeor">
                <option value=""></option>

                <?php

                foreach ($mejorPeor as $clave => $item) {
                    echo "<option value='$clave' ";

                    if ($opcMejorPeor == $clave) {
                        echo " selected ";
                    }

                    echo " >$item </option>";
                }
                ?>
            </select>

            <select name="numRegistros">
                <option value=""></option>

                <?php
                foreach ($registros as $item) {
                    echo "<option value='$item' ";

                    if ($numRegistros == $item) {
                        echo " selected ";
                    }

                    echo " >$item </option>";
                }
                ?>
            </select>
            <b>Con suspensos</b>
            Si <input type="radio" name="suspensos" <?php
                                                    if ($suspensos == "si") {
                                                        echo "checked";
                                                    }
                                                    ?> value="si">
            No <input type="radio" name="suspensos" <?php
                                                    if ($suspensos == "no") {
                                                        echo "checked";
                                                    }
                                                    ?> value="no">
            <input type="submit" name="mostrar" value="Mostrar">
        </form>
    </fieldset>

    <?php
    if (isset($_POST['mostrar'])) {

        $consulta = generarConsulta($opcMejorPeor, $numRegistros, $suspensos);

        $arrayAlumnos = consultaDatosAssoc($consulta);

        mostrarTablaAlumnos($arrayAlumnos);
    }
    ?>
</body>

</html>