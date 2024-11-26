<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("../libreriaBD.php");
require_once("05funciones.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poner Notas</title>
</head>

<body>
    <!--  deplegable alumnos , desplegable modulos y un input para la nota y que se guarde en la bdd
      si la nota existe se actualiza-->
    <?php
    $desplegableAlumnos = ""; //recoge el NIF del alumno seleccionado
    $desplegableModulos = ""; //recoge el ID del modulo seleccionado
    $nota = "";
    $alumnos = array();
    $modulos = array();

    if (isset($_POST['enviar'])) {
        $nota = $_POST['nota'];
    }

    //desplegable alumnos
    $consulta = "SELECT * FROM `alumnos`";

    $resul = consultaDatos($consulta);

    if ($resul) {
        $alumnos = mysqli_fetch_all($resul);
    }

    if (isset($_POST['desplegableAlumnos'])) {
        $desplegableAlumnos = $_POST['desplegableAlumnos'];
    }

    //desplegable de modulos
    $consulta = "SELECT * FROM `modulos`";

    $resul = consultaDatos($consulta);

    if ($resul) {
        $modulos = mysqli_fetch_all($resul);
    }

    if (isset($_POST['desplegableModulos'])) {
        $desplegableModulos = $_POST['desplegableModulos'];
    }
    ?>
    <fieldset>
        <legend>Poner Notas</legend>

        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
            <label for="desplegableAlumnos">Alumnos: </label>
            <select name="desplegableAlumnos" id="desplegableAlumnos">
                <option value=""></option>

                <?php
                foreach ($alumnos as $alumno) {
                    // Creamos la opción con el primer campo como valor

                    echo "<option value='$alumno[0]' ";

                    // Si el valor coincide con la selección actual, marcamos la opción como seleccionada
                    if ($desplegableAlumnos == $alumno[0]) {
                        echo " selected ";
                    }

                    // Mostramos el nombre y apellido del alumno en la opción
                    echo " >$alumno[1] $alumno[2] </option>";
                }
                ?>
            </select>

            <label for="desplegableModulos">Modulos: </label>
            <select name="desplegableModulos" id="desplegableModulos">
                <option value=""></option>

                <?php
                foreach ($modulos as $modulo) {
                    // Creamos la opción con el primer campo como valor

                    echo "<option value='$modulo[0]' ";

                    // Si el valor coincide con la selección actual, marcamos la opción como seleccionada
                    if ($desplegableModulos == $modulo[0]) {
                        echo " selected ";
                    }

                    // Mostramos el nombre y apellido del alumno en la opción
                    echo " >$modulo[1] </option>";
                }
                ?>
            </select>

            <label for="nota">Nota: </label>
            <input type="text" name="nota" value="">

            <input type="submit" name="enviar" value="Enviar">
        </form>
        <?php
        if (isset($_POST['enviar'])) {
            if (isset($_POST['desplegableAlumnos']) && $_POST['desplegableAlumnos'] != "" && isset($_POST['desplegableModulos']) && $_POST['desplegableModulos']) {
                if ($nota >= 1 && $nota <= 10) {

                    ponerNota($desplegableAlumnos, $desplegableModulos, $nota);
                } else {
                    echo "<p>ERROR: Introduce una nota entre 1 y 10.</p>";
                }
            } else {
                echo "<p>ERROR: Selecciona un alumno y un módulo.</p>";
            }
        }
        ?>
    </fieldset>
</body>

</html>