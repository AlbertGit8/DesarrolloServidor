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
    $ini = "";
    $fin = "";

    if (isset($_GET['enviar'])) {
        $ini = $_GET['inicial'];
        $fin = $_GET['final'];
    }
    ?>

    <fieldset>
        <legend>Tablas de multiplicar</legend>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
            Tabla inicial <select name="inicial" id="">
                <option value="<?php echo $ini ?>"></option>
                <?php
                for ($i = 1; $i <= 10; $i++) {

                    if ($i == $ini) {
                        echo "<option value= '$i' selected>$i</option>";
                    } else {
                        echo "<option value= '$i'>$i</option> ";
                    }
                }


                ?>
            </select>
            Tabla final <select name="final" id="">
                <option value="<?php echo $fin ?>"></option>
                <?php
                for ($i = 1; $i <= 10; $i++) {

                    if ($i == $fin) {
                        echo "<option value= '$i' selected>$i</option>";
                    } else {
                        echo "<option value= '$i'>$i</option> ";
                    }
                }


                ?>
            </select>

            <input  type="submit" name="enviar" value="Mostrar Tablas">

            <?php
            if (isset($_GET['enviar'])) {
                echo "<table>
                <tr>";

                for ($i = $ini; $i <= $fin; $i++) {
                    echo "<td>";
                     echo "<table>";
                    for ($j = 1; $j <= 10; $j++) {
                        $resultado = $i * $j;
                       echo "
                            <tr class='fila'>
                        <td >$i</td>
                        <td>X</td>
                        <td>$j</td>
                        <td>$resultado</td>
                            </tr>
                        ";
                        
                    }
                    echo "</table>";
                    echo "</td>";
                }
                echo "</tr>
                </table>";
            }
            ?>

           
        </form>
    </fieldset>
</body>

</html>