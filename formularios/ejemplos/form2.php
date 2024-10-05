<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <fieldset>
        <form name="f1" method="get" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            Nombre<input type="text" name="nombre">
            Numero<input type="number" name="num">

            <input type="submit" name="Enviar" value="repetir">
        </form>
    </fieldset>

    <?php

        if (isset($_GET['Enviar'])){

            $nombre = $_GET['nombre'];

            for ($i=0; $i <$_GET['num'] ; $i++) { 
                echo $nombre;
                echo '<br>';
            }
        }
    ?>
</body>
</html>