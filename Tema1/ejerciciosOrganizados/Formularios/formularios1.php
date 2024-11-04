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
    <title>formularios1</title>
</head>

<body>
    <?php
    //Crea un formulario web que solicita al usuario ingresar su nombre y dos apellidos. Cuando el formulario es enviado, los datos introducidos son mostrados en la misma página, con un saludo que incluye los tres campos.

    //Declaramos las variables vacias
    $nombre = "";
    $ape1 = "";
    $ape2 = "";

    if (isset($_GET['saludar'])) {
        $nombre = $_GET['nombre'];
        $ape1 = $_GET['ape1'];
        $ape2 = $_GET['ape2'];
    }

    ?>

    <fieldset>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method=" get">
            <label for="nombre">Nombre: </label><br>
            <input type="text" id="nombre" name="nombre" value="<?php echo $nombre ?>"><br><br>

            <label for="nombre">Apellido 1: </label><br>
            <input type="text" id="ape1" name="ape1" value="<?php echo $ape1 ?>"> <br><br>
            <!--Para php lo que recogemos es el name no el id el id sirve para el label en este caso-->

            <label for="nombre">Apellido 2: </label><br>
            <input type="text" id="ape2" name="ape2" value="<?php echo $ape2 ?>"><br><br>

            <input type="submit" name="saludar" value="Saludar">
        </form>
    </fieldset>

    <?php
    if (isset($_GET['saludar'])) {

        echo "Bienvenido $nombre $ape1 $ape2";

    } ?>

</body>

</html>