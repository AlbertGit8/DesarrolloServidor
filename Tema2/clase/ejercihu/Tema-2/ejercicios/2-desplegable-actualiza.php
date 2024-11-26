<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- actualiza deplegable con nombre y primer apellido y un boton mostrar y te crea un formulario rellenado con los datos del alumno (nif disabled)  -->
    <?php
    $desplegable = "";
    $alumnos = array();

    $host = "localhost"; //127.0.0.1

    $user = "root";

    $password = ""; //por defecto en blanco

    $database = "tema2";

    //se conecta al servidor de bbdd y devuelve un descriptor database
    $db = mysqli_connect($host, $user, $password, $database);

    //actualizar antes de cargar el resul para que se actualice el desplegable
    if (isset($_POST['actualizar'])) {
        $nifFicha = $_POST['nifFicha'];  // Obtiene el NIF del alumno del formulario
        actualizarAlumno($nifFicha);      // Actualiza los datos del alumno      
    }

    $consulta = "SELECT * FROM `alumnos`";

    $resul = mysqli_query($db, $consulta);


    if ($resul) {
        $alumnos = mysqli_fetch_all($resul);
    } else {
        echo "Error en la consulta: " . mysqli_error($db);
    }

    if (isset($_POST['desplegable'])) {
        $desplegable = $_POST['desplegable'];
    }

    function mostrarAlumno($desplegable)
    {
        global $db;

        $consulta = "SELECT * FROM `alumnos` WHERE NIF='$desplegable'";

        $resul = mysqli_query($db, $consulta);

        if ($resul) {
            $alumno = mysqli_fetch_row($resul);

            echo "<p><form name='form2' action='<?php echo $_SERVER[PHP_SELF] ?>' method='post'> 
            <p>
                <label for='nombre'>NIF: </label>
                <input type='text' name='nifFicha' value='$alumno[0]' readonly> 
            </p>
            <p>
                <label for='nombreFicha'>Nombre: </label>
                <input type='text' name='nombreFicha' value='$alumno[1]'> 
            </p>
            <p>
                <label for='apellido1Ficha'>Apellido 1: </label>
                <input type='text' name='apellido1Ficha' value='$alumno[2]'>
            </p>
            <p>
                <label for='apellido2Ficha'>Apellido 1: </label>
                <input type='text' name='apellido2Ficha' value='$alumno[3]'> 
                </p>
            <p>
                <label for='telefonoFicha'>Telefono: </label>
                <input type='text' name='telefonoFicha' value='$alumno[4]'> 
            </p>
            <input type='hidden' name='nifFicha' value='$alumno[0]'>
            <input type='submit' name='actualizar' value='Actualizar'>
            </form></p>
            ";
        } else {
            echo "<p>Error en la consulta: " . mysqli_error($db)."</p>";
        }
    }

    function actualizarAlumno($desplegable)
    {
        global $db;

        $nombreAct = $_POST['nombreFicha'];
        $apellido1Act = $_POST['apellido1Ficha'];
        $apellido2Act = $_POST['apellido2Ficha'];
        $telefonoAct = $_POST['telefonoFicha'];

        $consulta = "UPDATE alumnos 
        SET Nombre = '$nombreAct', Apellido1 = '$apellido1Act', Apellido2 = '$apellido2Act', Telefono= '$telefonoAct'
        WHERE NIF = '$desplegable';
        ";

        $resul = mysqli_query($db, $consulta);

        if ($resul) {
            echo "";
        } else {
            echo "<p>Error en la consulta: " . mysqli_error($db)."</p>";
        }
    }

    ?>
    <fieldset>
        <legend>Desplegable de Alumnos</legend>
        <form name='form1' action='<?php echo $_SERVER['PHP_SELF'] ?>' method='post'>
            <p>
                <label for='nombre'>Alumnos: </label>
                <select name="desplegable">
                    <option value=""></option>

                    <?php
                    foreach ($alumnos as $clave => $alumno) {
                        // Creamos la opción con el primer campo como valor

                        echo "<option value='$alumno[0]' ";

                        // Si el valor coincide con la selección actual, marcamos la opción como seleccionada
                        if ($desplegable == $alumno[0]) {
                            echo " selected ";
                        }

                        // Mostramos el nombre y apellido del alumno en la opción
                        echo " >$alumno[1] $alumno[2] </option>";
                    }
                    ?>
                </select>
                <input type='submit' name='mostrar' value='Mostrar'>
            </p>
            
            <?php
            if (isset($_POST['mostrar']) || isset($_POST['actualizar']) ) {
                mostrarAlumno($desplegable);
            }
            ?>
        </form>
    </fieldset>
    <?php
    mysqli_close($db);
    ?>
</body>

</html>