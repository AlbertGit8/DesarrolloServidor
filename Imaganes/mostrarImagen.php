<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('libreriaBD.php');


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserccion imagenes</title>
</head>

<body>
    <fieldset>
        <legend>Alta Marcas con Imagen</legend>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">

            <?php

            $consulta = "SELECT * FROM marcas;";

            $filas=consultaDatosAssoc($consulta);

            echo "<table border=2>";
            echo "<th>Marca</th><th>Imagen</th>";

            foreach ($filas as $fila) {
                echo "<tr>";

                echo "<td>$fila[Nombre]</td>";
                echo "<td><img src='images/$fila[Imagen]' width='80'></td>";

                echo "</tr>";
            }
            ?>

            <input type="submit" name="Guardar" value="Guardar">
        </form>
    </fieldset>
</body>

</html>