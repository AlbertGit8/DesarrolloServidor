<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    //Crear una funcion que quite un string que este contenido dentro de otro y una opcion que pregunte que si esta contenido mas de una vez quitarlo la primera o todas las veces que se repita

    function DentroCadena($cad, $pos) { //funcion que indica si esa posicion esta dentro de los límites de la cadena

        return ( ($pos>=0) && ($pos<strlen($cad)) ); 
        
    }

    function ExtraerCad($cad,$ini,$fin) {

        $sub = "";

        if ( DentroCadena($cad,$ini) && DentroCadena($cad,$fin) ) {
            
            if ($ini>$fin) {
                echo "<B>Error</B> Ha introducido un valor inicial mayor que el final";
            } else {
                //Extraemos de la cadena principal el segmento pedido

                

                for ($i=$ini; $i <= $fin; $i++) { 
                    $sub.=$cad[$i];
                }

            }

        } else { //Error los límites introducidos no están dentro de la cadena
            
            echo "<B>Error</B> los límites introducidos no están dentro de la cadena";

        }

        return $sub;

    }

    function EstaContenida($conte,$princi){
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

    if(isset($_GET['opcion'])){
        $opc = $_GET['opcion'];
    }

    if (isset($_GET['quitar'])) {
        $princi = $_GET['principal'];

        $conte = $_GET['contenida'];

        $princiAux
    }


    ?>
     <form action="<?php echo $_SERVER['PHP_SELF'] ?>">
        principal <input type="text" name="principal" value="<?php echo $princi  ?>">
        contenida <input type="text" name="contenida" value="<?php echo $conte  ?>">

        <?php

            $opciones = array(0=>"Si", 1=>"No");

            foreach ($opciones as $clave => $valor) {
                echo "$valor <input type='radio' name='varias' value='$clave' ";

                if ($ca) {
                    echo " checked ";
                }
            }

        ?>
        Varias veces: 
        SI<input type="radio" name="estado" id="" value="si">
        NO<input type="radio" name="estado" id="" value="no">
        <input type="submit" name="quitar" value="quitar">
    </form>
</body>
</html>