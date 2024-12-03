<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    // Crear una función que quite un string contenido dentro de otro
    // y permita elegir si quitarlo una vez o todas las veces que se repita.

    function DentroCadena($cad, $pos)
    { // Verifica si la posición está dentro de los límites de la cadena
        return (($pos >= 0) && ($pos < strlen($cad)));
    }

    function ExtraerCad($cad, $ini, $fin)
    {
        $sub = "";
        if (DentroCadena($cad, $ini) && DentroCadena($cad, $fin)) {
            if ($ini > $fin) {
                echo "<b>Error:</b> El valor inicial es mayor que el final.";
            } else {
                // Extraemos de la cadena principal el segmento pedido
                for ($i = $ini; $i <= $fin; $i++) {
                    $sub .= $cad[$i];
                }
            }
        } else { // Error: los límites no están dentro de la cadena
            echo "<b>Error:</b> Los límites introducidos no están dentro de la cadena.";
        }
        return $sub;
    }

    function EstaContenida($conte, $princi)
    {
        $i = 0; // Índice de la cadena principal
        $j = 0; // Índice de la cadena contenida
        $pos = -1; // Por defecto, suponemos que no está contenida

        $longPrin = strlen($princi);
        $longConte = strlen($conte);

        if ($longPrin >= $longConte) {
            $encontrado = false; // Aún no hemos encontrado nada

            while ($i <= $longPrin && !$encontrado) {
                $iAux = $i; // Guardamos la posición del índice exterior
                while (($j < $longConte) && ($conte[$j] == $princi[$iAux])) {
                    $j++;
                    $iAux++;
                }
                // Hemos salido del bucle
                if ($j == $longConte) { // Si coincide toda la cadena contenida
                    $encontrado = true;
                    $pos = $i; // Guardamos la posición inicial
                } else { // Reiniciamos el índice de la cadena contenida
                    $j = 0;
                    $i++;
                }
            }
        }
        return $pos;
    }

    // Inicializamos variables si están definidas
    $opc = isset($_GET['opcion']) ? $_GET['opcion'] : null;
    $princi = isset($_GET['principal']) ? $_GET['principal'] : '';
    $conte = isset($_GET['contenida']) ? $_GET['contenida'] : '';
    $ca = isset($_GET['varias']) ? $_GET['varias'] : null;
    ?>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
        <label for="principal">Cadena principal:</label>
        <input type="text" name="principal" value="<?php echo $princi; ?>"><br>

        <label for="contenida">Cadena contenida:</label>
        <input type="text" name="contenida" value="<?php echo $conte; ?>"><br>

        <label>¿Varias veces?</label><br>
        <?php
        $opciones = array(0 => "Sí", 1 => "No");
        foreach ($opciones as $clave => $valor) {
            echo "$valor <input type='radio' name='varias' value='$clave'";
            if ($ca !== null && $ca == $clave) {
                echo " checked";
            }
            echo "><br>";
        }
        ?>
        <input type="submit" name="quitar" value="Quitar">
    </form>

    <?php
    if (isset($_GET['quitar'])) {
        if (!empty($princi) && !empty($conte)) {
            $pos = EstaContenida($conte, $princi);
            if ($pos >= 0) {
                echo "<p>La cadena '$conte' está contenida en '$princi' en la posición $pos.</p>";

                if ($ca == 0) { // Si se seleccionó "Sí", quitar todas las veces
                    while (($pos = EstaContenida($conte, $princi)) >= 0) {
                        $princi = substr($princi, 0, $pos) . substr($princi, $pos + strlen($conte));
                    }
                    echo "<p>Cadena final después de quitar todas las ocurrencias: $princi</p>";
                } else { // Si se seleccionó "No", quitar solo la primera vez
                    $princi = substr($princi, 0, $pos) . substr($princi, $pos + strlen($conte));
                    echo "<p>Cadena final después de quitar la primera ocurrencia: $princi</p>";
                }
            } else {
                echo "<p>La cadena '$conte' no está contenida en '$princi'.</p>";
            }
        } else {
            echo "<p><b>Error:</b> Ambas cadenas deben tener contenido.</p>";
        }
    }
    ?>
</body>

</html>
