<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="">
        De que tamaño quieres el array: <select name="tamano" id="">
            <option value="<?php echo $tam ?>"></option>
            
            <?php
            for ($i = 10; $i <= 20; $i++) {

                if ($i == $tam) {
                    echo "<option value= '$i' selected>$i</option>";
                } else {
                    echo "<option value= '$i'>$i</option> ";
                }
            }
            ?>

        </select>
    </form>
</body>

</html>