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
    <title>Bucles 4</title>
</head>

<body>
    <?php
    //Crea un formulario que permita al usuario ingresar un número entre 1 y 12. Al enviar el formulario, se debe calcular y mostrar una tabla con ese número de filas. Además, se identifican números primos.
    ?>

    <fieldset>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <label for="num">Ingrese un número del 1 al 12:</label>
            <input type="text" id="num" name="num" pattern="^(1[0-2]|[1-9])$" required>

            <input type="submit" name="Enviar" value="Enviar">
        </form>
    </fieldset>

    <?php

    function esPrimo($numero) {
        $primo = true;
        $contador = 0;
        

        for ($i=$numero-1; $i >= 2; $i--) { 
            if ($numero%$i==0) {
                $contador++;
            }
        }
        if ($contador>0) {
            $primo = false;
        }

        return $primo;

    }
   
    if (isset($_GET['Enviar'])) {
        $colum = $_GET['num'];
        $contador = 1;

        echo "<table border=solid 1px;>";

        for ($i=0; $i <= $colum; $i++) { 
            echo "<tr>";
            for ($j=0; $j <= 10; $j++) { 
                

                if (esPrimo($contador)) {
                    echo "<td style=background:red;>$contador</td>";
                } else {
                    echo "<td>$contador</td>";
                }

                $contador++;
            }
            echo "</tr>";
        }

        echo "</table>";
    }
    ?>
</body>

</html>