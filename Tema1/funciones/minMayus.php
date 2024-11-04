<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mayúsculas o Minúsculas</title>
    <!-- pagina recibe una cadena con un radio mayus-min y transformas la cadena en todo mayusculas o minusculas-->
</head>

<body>
    <?php
    $cad = "";
    $nuevaCad = "";
    $trans = "minuscula"; //por defecto

    if (isset($_GET['enviar'])) {

        $cad = $_GET['cadena'];
        $trans = $_GET['transformar'];
    }
    ?>
    <fieldset>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>">
            Cadena:
            <input type="text" name="cadena" value="<?php echo $cad ?>">
            <br>
            <br>
            Opción:
            <input type="radio" name="transformar" id="estadoMin" value="minuscula" <?php if ($trans == 'minuscula') {
                                                                                        echo 'checked';
                                                                                    } ?>><label for="estadoMin">minúscula</label>

            <input type="radio" name="transformar" id="estadoMayus" value="mayuscula" <?php if ($trans == 'mayuscula') {
                                                                                            echo 'checked';
                                                                                        } ?>><label for="estadoMayus">MAYÚSCULA</label>
            <br>
            <br>
            <input type="submit" name="enviar" value="Ver resultado">

            <?php
            if (isset($_GET['enviar'])) {
                $letras = array();
                $letras['a'] = "A";
                $letras['b'] = "B";
                $letras['c'] = "C";
                $letras['d'] = "D";
                $letras['e'] = "E";
                $letras['f'] = "F";
                $letras['g'] = "G";
                $letras['h'] = "H";
                $letras['i'] = "I";
                $letras['j'] = "J";
                $letras['k'] = "K";
                $letras['l'] = "L";
                $letras['m'] = "M";
                $letras['n'] = "N";
                $letras['o'] = "O";
                $letras['p'] = "P";
                $letras['q'] = "Q";
                $letras['r'] = "R";
                $letras['s'] = "S";
                $letras['t'] = "T";
                $letras['u'] = "U";
                $letras['v'] = "V";
                $letras['w'] = "W";
                $letras['x'] = "X";
                $letras['y'] = "Y";
                $letras['z'] = "Z";

                function convMayus($cad)
                {
                    global $letras;
                    //convertir cadena a array por caracteres
                    $caracteres = str_split($cad);
                    foreach ($letras as $min => $mayus) {
                        for ($i = 0; $i < count($caracteres); $i++) {
                            if ($caracteres[$i] == $min) {
                                $caracteres[$i] = $mayus;
                            }
                        }
                    }
                    return implode('', $caracteres);
                }

                function convMinus($cad)
                {
                    global $letras;
                    $caracteres = str_split($cad);
                    foreach ($letras as $min => $mayus) {
                        for ($i = 0; $i < count($caracteres); $i++) {
                            if ($caracteres[$i] == $mayus) {
                                $caracteres[$i] = $min;
                            }
                        }
                    }
                    return implode('', $caracteres);
                }

                if ($trans == 'minuscula') {
                    $nuevaCad = convMinus($cad);
                } else {
                    $nuevaCad = convMayus($cad);
                }
                echo "<br>";
                echo "<br>";
                echo "<input type='text' name='nuevaCadena' value='$nuevaCad'>";
            }
            ?>
        </form>

    </fieldset>
</body>

</html>