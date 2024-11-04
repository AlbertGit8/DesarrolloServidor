<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajedrez</title>
</head>

<body>
    <table border="solid 1px">
        <?php

        // Crea un tablero de ajedrez en una tabla HTML utilizando bucles anidados. Las celdas del tablero deben alternar entre color blanco y negro.
        for ($i = 0; $i <= 8; $i++) {
            echo "<tr>";
            for ($j = 0; $j <= 8; $j++) {
                if ($i % 2 === 0) {
                    if ($j % 2 === 0) {
                        echo "<td width=50px; height=50px; style=background:black;></td>";
                    } else {
                        echo "<td width=50px; height=50px;></td>";
                    }
                } else {
                    if ($j % 2 === 0) {
                        echo "<td width=50px; height=50px;></td>";
                    } else {
                        echo "<td width=50px; height=50px; style=background:black;></td>";
                    }
                }
            }
        }

        ?>
    </table>
</body>

</html>