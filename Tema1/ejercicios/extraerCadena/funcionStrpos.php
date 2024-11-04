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
    if (isset($_GET['buscar'])) {

        //Devuelve -1 si no  esta contenida y en caso contrario la posición de comienzo
        function EstaContenida($conte, $princi)
        {
            $i = 0; //Indice de la cadena principal

            $j = 0; //Indice de la cadena contenida

            $pos = -1; // Por defecto suponemos qu eno está contenida

            $longPrin = strlen($princi);

            $longConte = strlen(($conte));

            if ($longPrin >= $longConte) {

                $encontrado = FALSE; //Aún no hemos encontrado nada

                while ($i <= $longPrin && !($encontrado)) {

                    $iAux = $i; //guardamos la posicion del indice exterior

                    while ( ($j <= $longConte) && ( $conte[$j   ]== $princi[$iAux])) {
                        
                        $j++;
                        $iAux++;
                    }
                    //Hemos salido del bucle

                    if ($j == $longConte) { // Si la j avanza el final de la cadena conte es que esta dentro
                        $encontrado = TRUE;

                        $pos = $i; //Si lo hemos encontrado retornamos 
                    } else { //Hemos encontrado una letra que no coincide en las dos cadenas
                        $j = 0;
                        $i++; 
                    }
                   
                }
            }

            return $pos;
        }



        $princi = $_GET['principal'];
        $conte = $_GET['contenida'];


        $pos = EstaContenida($conte, $princi);

        if ($pos == -1) {
            echo "La cadena $conte no esta contenida dentro de $princi";
        } else {
            echo "La cadena $conte esta contenida dentro de $princi en la posicion $pos";
        }
    }

    ?>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>">
        principal <input type="text" name="principal" value="<?php echo $princi  ?>">
        contenida <input type="text" name="contenida" value="<?php echo $conte  ?>">
        <input type="submit" name="buscar" value="buscar">
    </form>
    
</body>

</html>