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
    <title>Formularios5</title>
</head>

<body>
    <?php
    //Crea un script que recibe el nombre de una persona como parámetro GET en la URL. Luego, se genera un mensaje que se muestra diez veces en la página, saludando a la persona con el nombre recibido.

    $nombre = "";

    if (isset($_GET['enviar'])) {
        $nombre = $_GET['nombre'];
    }
    ?>

    <fieldset>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method=" get">
            <label for="nombre">Nombre: </label><br>
            <input type="text" id="nombre" name="nombre" value="<?php echo $nombre ?>"><br><br>
            <input type="submit" name="enviar" value="Enviar">
        </form>
    </fieldset>

    <?php
    if (isset($_GET['enviar'])) {
        for ($i=0; $i <= 10; $i++) { 
            echo "Hola $nombre <br>";
        }
    }
    ?>
</body>

</html>