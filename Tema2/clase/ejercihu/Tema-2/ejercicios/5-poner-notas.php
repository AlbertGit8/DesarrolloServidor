<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!--  deplegable alumnos , desplegable modulos y un input para la nota y que se guarde en la bdd
      si la nota existe se actualiza-->
    <?php
    function comprobarNota($desplegableAlumnos, $desplegableModulos)
    {
        global $db;
        $existe = FALSE;

        //comprobar si el alumno aparece en la columna de IDAlumno
        $consultaAlu = "SELECT count(*) as cuentaAlu FROM `notas` WHERE IDAlumno='$desplegableAlumnos'";
        $resulAlu = mysqli_query($db, $consultaAlu);
        $rowAlu = mysqli_fetch_assoc($resulAlu);

        if ($rowAlu['cuentaAlu'] == 0) { // Verificar si cuenta es igual a 0
            $existe = FALSE;
        } else {
            $existe = TRUE;
        }

        //comprobar si el modulo aparece en la columna de IDModulo
        $consultaMod = "SELECT count(*) as cuentaMod FROM `notas` WHERE IDModulo='$desplegableModulos'";
        $resulMod = mysqli_query($db, $consultaMod);
        $rowMod = mysqli_fetch_assoc($resulMod);

        if ($rowMod['cuentaMod'] == 0) { // Verificar si cuenta es igual a 0
            $existe = FALSE;
        } else {
            $existe = TRUE;
        }

        return $existe;
    }
    function ponerNota($desplegableAlumnos, $desplegableModulos, $nota)
    {
        global $db;

        if (comprobarNota($desplegableAlumnos, $desplegableModulos)) {
            //si el alumno ya está matriculado en el modulo
            echo "<p>NOTA: El alumno con NIF: $desplegableAlumnos ya tiene una nota en el modulo con ID: $desplegableModulos. Se actualizará su nota.</p>";

            $consulta = "UPDATE notas 
            SET nota = '$nota'
            WHERE IDAlumno = '$desplegableAlumnos' and IDModulo = '$desplegableModulos' ;";

            $resul = mysqli_query($db, $consulta);

            if ($resul) {
                echo "<p>Nota actualizada.</p>";
            } else {
                echo "<p>Error en la consulta: " . mysqli_error($db) . "</p>";
            }
        } else {
            //si el alumno NO está matriculado en el modulo

            $consulta = "insert into notas values('$desplegableAlumnos','$desplegableModulos','$nota')";

            $resul = mysqli_query($db, $consulta);

            if ($resul) {
                echo "<p>Nota registrada.</p>";
            } else {
                echo "<p>Error en la consulta: " . mysqli_error($db) . "</p>";
            }
        }
    }

    $desplegableAlumnos = ""; //recoge el NIF del alumno seleccionado
    $desplegableModulos = ""; //recoge el ID del modulo seleccionado
    $nota = "";
    $alumnos = array();
    $modulos = array();

    if (isset($_POST['enviar'])) {
        $nota = $_POST['nota'];
    }

    $host = "localhost"; //127.0.0.1

    $user = "root";

    $password = ""; //por defecto en blanco

    $database = "tema2";

    //se conecta al servidor de bbdd y devuelve un descriptor database
    $db = mysqli_connect($host, $user, $password, $database);

    // desplegable de alumnos
    $consulta = "SELECT * FROM `alumnos`";

    $resul = mysqli_query($db, $consulta);

    if ($resul) {
        $alumnos = mysqli_fetch_all($resul);
    } else {
        echo "Error en la consulta: " . mysqli_error($db);
    }

    if (isset($_POST['desplegableAlumnos'])) {
        $desplegableAlumnos = $_POST['desplegableAlumnos'];
    }

    //desplegable de alumnos
    $consulta = "SELECT * FROM `modulos`";

    $resul = mysqli_query($db, $consulta);


    if ($resul) {
        $modulos = mysqli_fetch_all($resul);
    } else {
        echo "Error en la consulta: " . mysqli_error($db);
    }

    if (isset($_POST['desplegableModulos'])) {
        $desplegableModulos = $_POST['desplegableModulos'];
    }
    ?>
    <fieldset>
        <legend>Poner notas</legend>
        <form name='form1' action='<?php echo $_SERVER['PHP_SELF'] ?>' method='post'>
            <p>
                <label for='desplegableAlumnos'>Alumnos: </label>
                <select name="desplegableAlumnos">
                    <option value=""></option>

                    <?php
                    foreach ($alumnos as $clave => $alumno) {
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

                <label for='desplegableModulos'>Modulos: </label>
                <select name="desplegableModulos">
                    <option value=""></option>

                    <?php
                    foreach ($modulos as $clave => $modulo) {
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

                <label for='nota'>Nota: </label>
                <input type='text' name='nota' value=''>

                <input type='submit' name='enviar' value='Enviar nota'>
            </p>
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
    <?php
    mysqli_close($db);
    ?>
</body>

</html>