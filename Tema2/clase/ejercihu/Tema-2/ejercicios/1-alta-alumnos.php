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

    function validarDatos($nif, $nombre, $apellido1, $apellido2, $telefono)
    {
        $valido = TRUE;

        $nif = trim($nif);
        $nombre = trim($nombre);
        $apellido1 = trim($apellido1);
        $apellido2 = trim($apellido2);
        $telefono = trim($telefono);

        if (strlen($nif) != 9) {
            echo "<p>ERROR: El nif debe tener una longitud de 9 caracteres</p>";
            $valido = FALSE;
        }

        //nombre
        if (strlen($nombre) > 25) {
            echo "<p>ERROR: El nombre no debe tener una longitud mayor a 25 caracteres</p>";
            $valido = FALSE;
        }
        if (strlen($nombre) == 0) {
            echo "<p>ERROR: El nombre no debe estar vacío</p>";
            $valido = FALSE;
        }

        //apellido1
        if (strlen($apellido1) > 25) {
            echo "<p>ERROR: El apellido 1 no debe tener una longitud mayor a 25 caracteres</p>";
            $valido = FALSE;
        }
        if (strlen($apellido1) == 0) {
            echo "<p>ERROR: El apellido 1 no debe estar vacío</p>";
            $valido = FALSE;
        }

        //apellido2
        if (strlen($apellido2) > 25) {
            echo "<p>ERROR: El apellido 2 no debe tener una longitud mayor a 25 caracteres</p>";
            $valido = FALSE;
        }
        if (strlen($apellido2) == 0) {
            echo "<p>ERROR: El apellido 2 no debe estar vacío</p>";
            $valido = FALSE;
        }

        if (strlen($telefono) != 9) {
            echo "<p>ERROR: El teléfono debe tener una longitud de 9 caracteres</p>";
            $valido = FALSE;
        }

        return $valido;
    }

    ?>

    <fieldset>
        <legend>Alta alumnos</legend>
        <form name='form1' action='<?php echo $_SERVER['PHP_SELF'] ?>' method='post'>
            <p>
                <label for='nif'>NIF: </label>
                <input type='text' name='nif' value='<?php echo $nif ?>'>
            </p>
            <p>
                <label for='nombre'>Nombre: </label>
                <input type='text' name='nombre' value='<?php echo $nombre ?>'>
            </p>
            <p>
                <label for='apellido1'>Apellido 1: </label>
                <input type='text' name='apellido1' value='<?php echo $apellido1 ?>'>
            </p>
            <p>
                <label for='apellido2'>Apellido 2: </label>
                <input type='text' name='apellido2' value='<?php echo $apellido2 ?>' >
            </p>
            <p>
                <label for='telefono'>Telefono: </label>
                <input type='text' name='telefono' value='<?php echo $telefono ?>' >
            </p>
            <input type='submit' name='enviar' value='Enviar'>
        </form>

        <?php
        if (isset($_POST['enviar'])) {
            $host = "localhost";

            $user = "root";

            $password = "";

            $database = "tema2";

            //se conecta al servidor de bbdd y devuelve un descriptor database
            $db = mysqli_connect($host, $user, $password, $database);

            $valido = validarDatos($nif, $nombre, $apellido1, $apellido2, $telefono);

            if ($valido) {
                $consulta = "insert into alumnos values('$nif','$nombre','$apellido1','$apellido2','$telefono')";

                //hacer la consulta en el servidor
                $resul = mysqli_query($db, $consulta);

                if ($resul) {
                    echo "<p>Consulta hecha correctamente</p>";
                } else {
                    echo "<p>Error en la consulta: " . mysqli_error($db) . "</p>";
                }
            }

            //cerrar servidor
            mysqli_close($db);
        }
        ?>
    </fieldset>
</body>

</html>