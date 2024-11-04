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

    <?php
    $tam = "";
    $direccion = "";

    if (isset($_GET['mostrar'])) {
        $tam = $_GET['tamano'];
        $direccion = $_GET['direccion'];
        $palabra = $_GET['palabra'];
    }
    ?>
    <fieldset>
        <legend>Tabla palabra</legend>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
            Palabra<input type="text" name="palabra" value="<?php isset($_GET['mostrar']) == TRUE ? $palabra : "" ?>"">
            <br>
            Tamaño<select name=" tamano" id="">
            <option value="<?php echo $tam ?>"></option>
            <?php
            for ($i = 1; $i <= 10; $i++) {

                if ($i == $tam) {
                    echo "<option value= '$i' selected>$i</option>";
                } else {
                    echo "<option value= '$i'>$i</option> ";
                }
            }


            ?>
            </select>
            <br>

            <legend>Direccion</legend>
            Fila<input type="radio" name="direccion" id="" value="filas" <?php

                                                                            if (isset($_GET['mostrar']) && $direccion == 'filas') {
                                                                                echo "checked";
                                                                            }
                                                                            ?>>
            Columna<input type="radio" name="direccion" id="" value="columnas" <?php

                                                                                if (isset($_GET['mostrar']) && $direccion == 'columnas') {
                                                                                    echo "checked";
                                                                                }
                                                                                ?>>
            <br>

            <input type="submit" name="mostrar" value="mostrar">
        </form>
    </fieldset>

    <?php
    if ($direccion == 'filas' && isset($_GET['mostrar'])==true) {
        echo "<table>
                    <tr>";
        for ($i = 0; $i < $tam; $i++) {
            echo "<td>$palabra</td>";
        }
        echo "</tr>
            </table>";
    } else {
        echo "";
    } if($direccion == 'columnas' && isset($_GET['mostrar'])==true) {
        echo "<table>";
        for ($i = 0; $i < $tam; $i++) {
            echo "<tr><td>$palabra</td></tr>";
        }
        echo "</table>";
    } else {
        echo "";
    }

    ?>
</body>

</html>