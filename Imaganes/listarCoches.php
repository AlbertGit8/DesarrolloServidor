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
    <title>Listar Coches</title>
</head>

<!-- Crear una página que liste las imágenes de los logos de las marcas de coches, estos logos se
mostrarán como un enlace que, al pulsar sobre este, mostrará los coches que pertenezcan a esta
marca. Para cada coche se mostrarán todos sus datos además de su fotografía. -->

<body>
    <legend>Listar Coches</legend>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">

        <?php

        $consulta = "SELECT * FROM marcas;";

        $filas = consultaDatosAssoc($consulta);

        echo "<table border=2>";
        echo "<th>Marca</th>";

        foreach ($filas as $fila) {
            echo "<tr>";

            echo "<td><a href=" . $_SERVER['PHP_SELF'] . "?buscar=$fila[Id]><img src='images/$fila[Imagen]' width='80'></a></td>";

            echo "</tr>";
        }

        echo "</table>";

        if (isset($_GET['buscar'])) {
            $idMarca = $_GET['buscar'];

            $consulta = "SELECT * FROM coches WHERE Marca = '$idMarca'";

            $coches = consultaDatosAssoc($consulta);

            echo "<table border=2>";
            echo "<tr>
        <th>Nombre</th> <th>Modelo</th> <th>Precio</th> <th>Foto</th>
            </tr>";

            foreach ($coches as $coche) {
                echo "<tr>
                        <td>$coche[Nombre]</td> <td>$coche[Modelo]</td> <td>$coche[Precio]</td> <td> <img src='images/$coche[Foto]' width='80'></td>
                     </tr>";
            }

            echo "</table>";
        }
        ?>

    </form>
    </fieldset>
</body>

</html>