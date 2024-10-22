<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bucles 5</title>
</head>

<body>
<?php
$filas = isset($_GET['filas']) ? $_GET['filas'] : '';
$colum = isset($_GET['colum']) ? $_GET['colum'] : '';
?>

    <fieldset>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <label for="filas">Elije número de filas: </label><br>
            <select id="filas" name="filas">
                <option value="<?php echo $filas ?>"></option>
                <?php
                for ($i = 0; $i <= 20; $i++) {
                    if ($i == $filas) {
                        echo "<option value='$i' selected>$i</option>";
                    } else {
                        echo "<option value='$i'>$i</option>";
                    }
                }
                ?>
            </select><br><br>

            <label for="colum">Elije número de columnas: </label><br>
            <select id="colum" name="colum">
                <option value="<?php echo $colum ?>"></option>
                <?php
                for ($i = 0; $i <= 20; $i++) {
                    if ($i == $colum) {
                        echo "<option value='$i' selected>$i</option>";
                    } else {
                        echo "<option value='$i'>$i</option>";
                    }
                }
                ?>
            </select><br><br>

            <input type="submit" name="crear" value="crear">
        </form>
    </fieldset>

    <?php

    if (isset($_GET['crear'])) {
        $filas=$_GET['filas'];
        $colum=$_GET['colum'];

        echo "<table border=solid 1px;>";

        for ($i=0; $i <= $filas; $i++) { 
            echo "<tr>";
            for ($j=0; $j < $colum; $j++) { 
                echo "<td style='width: 20px; height: 20px;'></td>";
            }
            echo "</tr>";
        }

        echo "</table>";
    }
    ?>
</body>

</html>