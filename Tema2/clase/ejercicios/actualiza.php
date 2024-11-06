<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualiza</title>
</head>

    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    //en un desplegable lista el nombre y el apellido del alumno y un boton mostrar, al pulsar muestra los datos de ese alumno

    $host = "localhost";

    $user = "root";

    $password = "root";

    $database = "tema2";

    //se conecta al servidor de bbdd y devuelve un descriptor database
    $db = mysqli_connect($host, $user, $password, $database);

    if (isset($_POST['Actualizar'])) { //Actualizamos el alumno seleccionado
        $nif = $_POST['NIF'];
        $nombre = $_POST['Nombre'];
        $apellido1 = $_POST['Apellido1'];
        $apellido2 = $_POST['Apellido2'];
        $telefono = $_POST['Telefono'];

        $consulta = "UPDATE alumnos SET Nombre = '$nombre',
                                        Apellido1 = '$apellido1',
                                        Apellido2 = '$apellido2',
                                        Telefono = '$telefono'
                                    WHERE NIF = '$nif' ";

        $resul = mysqli_query($db, $consulta);

        if ($resul) {
            echo "Registro actualizado correctamente";
        } else {
            echo mysqli_error($db);
        }
    }

    //declaramos el array donde guardaremos a los alumnos
    $alumnos = array();

    $consulta = "SELECT * FROM alumnos;";

    $resul = mysqli_query($db, $consulta);

    if ($resul) {
        while ($alumno = mysqli_fetch_assoc($resul)) {

            $alumnos[$alumno['NIF']] = $alumno;

        }
    } else {

        echo "Error:" . mysqli_error($db);

    }

    $alu = "";//aqui guardaremos el nif del alumno seleccionado
    
    if (isset($_POST['alumno'])) {//comprobamos si hay alumno seleccionado
        $alu = $_POST['alumno'];
    }
    
    mysqli_close($db);

    ?>

<body>

    <fieldset>
        <legend>Seleccione alumno</legend>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method='post'>

            <label for="alumno">Alumno:</label>
            <select  name="alumno" id="desplegable">
                <?php


                foreach ($alumnos as $alumno) {
                    echo "<option value='$alumno[NIF]' ";
                    
                    if ($alu == $alumno['NIF']) {
                        echo " selected ";
                    }
                    
                    echo ">$alumno[Apellido1],$alumno[Nombre]</option>";
                    
                }

                ?>
            </select>

            <input type="submit" value="mostrar" name="mostrar">

    </fieldset>
    <?php
    if (isset($_POST['mostrar'])) {

      

        echo "<fieldset><legend>Datos del alumno</legend> ";

        echo "<p>
                <label for='nif'>NIF: </label>
                <input type='text' name='NIF' value='$alu' readonly='readonly'>
            </p>";

        $fila = $alumnos[$alu];

           echo "<p>
                <label for='nombre'>Nombre: </label>
                <input type='text' name='Nombre' value='$fila[Nombre]' required maxlength='25'>
            </p>
            <p>
                <label for='apellido1'>Apellido 1: </label>
                <input type='text' name='Apellido1' value='$fila[Apellido1]' required maxlength='25'>
            </p>
            <p>
                <label for='apellido2'>Apellido 2: </label>
                <input type='text' name='Apellido2' value='$fila[Apellido2]' required maxlength='25'>
            </p>
            <p>
                <label for='telefono'>Telefono: </label>
                <input type='text' name='Telefono' value='$fila[Telefono]' required maxlength='9' minlength='9'>
            </p>";

        echo "<input type='submit' name='Actualizar' value='Actualizar'>";

        echo "</fieldset>";
    }

    ?>
    </form>
</body>

</html>