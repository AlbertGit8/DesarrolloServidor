<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ConMayMin</title>
</head>

<body>
    <?php
    // Convierte una cadena de texto ingresada a mayúsculas o minúsculas según la elección del usuario

    function conMayusculas($cadena)
    {
        $mayusculas = "";
        for ($i = 0; $i < strlen($cadena); $i++) {
            $value = $cadena[$i];
            if (ord($value) >= 97 && ord($value) <= 122) { // a-z en ASCII
                $caracter = ord($value) - 32;
                $mayusculas .= chr($caracter);
            } else {
                $mayusculas .= $value;
            }
        }
        return $mayusculas;
    }

    function conMinusculas($cadena)
    {
        $minusculas = "";
        for ($i = 0; $i < strlen($cadena); $i++) {
            $value = $cadena[$i];
            if (ord($value) >= 65 && ord($value) <= 90) { // A-Z en ASCII
                $caracter = ord($value) + 32;
                $minusculas .= chr($caracter);
            } else {
                $minusculas .= $value;
            }
        }
        return $minusculas;
    }

    // Valores predeterminados
    $ope = 1;
    $cadena = "";

    // Verifica si se ha enviado el formulario
    if (isset($_GET['generar'])) {
        $ope = $_GET['Operacion'];
        $cadena = $_GET['cadena'];
    }
    ?>

    <fieldset>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
            <label for="cadena">Introduzca una palabra o un texto:</label><br>
            <input type="text" id="cadena" name="cadena" value="<?php echo $cadena ?>"><br><br>

            <?php
            $opcines = array(1 => "Mayúsculas", 2 => "Minúsculas");
            foreach ($opcines as $key => $value) {
                echo "$value<input type='radio' name='Operacion' value='$key' ";
                if ($ope == $key) {
                    echo " checked ";
                }
                echo "> ";
            }
            ?>

            <input type="submit" name="generar" value="Generar">
        </form>
    </fieldset>

    <?php
    // Mostrar el resultado
    if (isset($_GET['generar'])) {
        if ($ope == 1) {
            echo conMayusculas($cadena);
        } elseif ($ope == 2) {
            echo conMinusculas($cadena);
        }
    }
    ?>

</body>

</html>