<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SelecCheckbox</title>
</head>

<body>
    <?php
    //Permite al usuario seleccionar varias opciones y muestra el resultado concatenado de las opciones seleccionadas en un formato de cadena.


    ?>

    <fieldset>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
            <h3>Seleccione para concatenar</h3>

            <?php

            $aficiones = array("Deporte", "Lectura", "Viajar", "Cine", "Musica");

            foreach ($aficiones as $clave => $valor) {
                echo "<label>
                <input type='checkbox' name='Aficiones[$clave]' value='$valor'>$valor
                </label><br>
                ";
            }

            ?>

            <input type="submit" value="enviar" name="enviar">
            
        </form>
    </fieldset>

    <?php
    $aficionesSelec = "";

    if (isset($_GET['enviar'])) {
        $aficionesSelec = $_GET['Aficiones'];

        foreach ($aficionesSelec as $clave => $valor) {
            echo "Aficion $clave marcada que es $aficionesSelec[$clave]<br>";
        }
    }
    ?>
</body>

</html>