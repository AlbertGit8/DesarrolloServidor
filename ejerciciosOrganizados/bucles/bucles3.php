<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bucles 3</title>
</head>
<body>
    <?php
    //Escribe un programa que utiliza bucles anidados. El bucle externo cuenta de 0 a 9, y el bucle interno imprime los números del 0 al 9 para cada iteración del bucle externo.

        for ($i=0; $i < 10; $i++) { 
            for ($j=0; $j <= 9; $j++) { 
                echo "$j ";
                if($j== 9) {
                    echo "<br>";
                }
            }
        }
    ?>
</body>
</html>