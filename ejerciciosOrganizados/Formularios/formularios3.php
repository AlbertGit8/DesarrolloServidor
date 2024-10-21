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
    <title>Formulario3</title>
</head>

<body>

    <?php
    //Crea un formulario donde el usuario puede ingresar su nombre, apellidos y seleccionar su país de una lista desplegable. Al enviar el formulario, los datos se procesan y se muestra un mensaje que incluye la información ingresada.

    //Declaramos las variables vacias
    $nombre = "";
    $ape1 = "";
    $ape2 = "";
    $pais = "";

    if (isset($_GET['enviar'])) {
        $nombre = $_GET['nombre'];
        $ape1 = $_GET['ape1'];
        $ape2 = $_GET['ape2'];
        $pais = $_GET['pais'];

    }

    ?>

    <fieldset>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method=" get">
            <label for="nombre">Nombre: </label><br>
            <input type="text" id="nombre" name="nombre" value="<?php echo $nombre ?>"><br><br>

            <label for="ape1">Apellido 1: </label><br>
            <input type="text" id="ape1" name="ape1" value="<?php echo $ape1 ?>"> <br><br>

            <label for="ape2">Apellido 2: </label><br>
            <input type="text" id="ape2" name="ape2" value="<?php echo $ape2 ?>"><br><br>

            <label for="pais">País: </label><br>
            <select id="pais" name="pais">
                <option value="España">España</option>
                <option value="Francia">Francia</option>
                <option value="Italia">Italia</option>
                <option value="Alemania">Alemania</option>
            </select><br><br>

            <input type="submit" name="enviar" value="Enviar">
        </form>
    </fieldset>

    <?php
    if (isset($_GET['enviar'])) {
        
        echo "Hola $nombre $ape1 $ape2 de $pais";

    }
    ?>
</body>

</html>