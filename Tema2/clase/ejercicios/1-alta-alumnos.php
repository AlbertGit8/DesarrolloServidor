<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- formulario para dar de alta un alumno comprobando las longitudes de los campos -->

    <?php
    $nif = "";
    $nombre = "";
    $apellido1 = "";
    $apellido2 = "";
    $telefono = "";

    if (isset($_POST['enviar'])) {
        $nif = $_POST['nif'];
        $nombre = $_POST['nombre'];
        $apellido1 = $_POST['apellido1'];
        $apellido2 = $_POST['apellido2'];
        $telefono = $_POST['telefono'];
    }

    ?>

    <fieldset>
        <legend>Saludador</legend>
        <form name='form1' action='<?php echo $_SERVER['PHP_SELF'] ?>' method='post'>
            <p>
                <label for='nif'>NIF: </label>
                <input type='text' name='nif' value='<?php echo $nif ?>' required maxlength="9" minlength="9">
            </p>
            <p>
                <label for='nombre'>Nombre: </label>
                <input type='text' name='nombre' value='<?php echo $nombre ?>' required maxlength="25">
            </p>
            <p>
                <label for='apellido1'>Apellido 1: </label>
                <input type='text' name='apellido1' value='<?php echo $apellido1 ?>' required maxlength="25">
            </p>
            <p>
                <label for='apellido2'>Apellido 2: </label>
                <input type='text' name='apellido2' value='<?php echo $apellido2 ?>' required maxlength="25">
            </p>
            <p>
                <label for='telefono'>Telefono: </label>
                <input type='text' name='telefono' value='<?php echo $telefono ?>' required maxlength="9" minlength="9">
            </p>
            <input type='submit' name='enviar' value='Enviar'>
        </form>

        <?php
        if (isset($_POST['enviar'])) {
            $host = "localhost";

            $user = "root";

            $password = "root";

            $database = "tema2";

            //se conecta al servidor de bbdd y devuelve un descriptor database
            $db = mysqli_connect($host, $user, $password, $database);

            $consulta = "insert into alumnos values('$nif','$nombre','$apellido1','$apellido2','$telefono')";

            //hacer la consulta en el servidor
            $resul = mysqli_query($db, $consulta);

            if ($resul) {
                echo "<p>Consulta hecha correctamente</p>";
            } else {
                echo "<p>Error en la consulta: " . mysqli_error($db) . "</p>";
            }

            //cerrar servidor
            mysqli_close($db);
        }
        ?>
    </fieldset>
</body>

</html>