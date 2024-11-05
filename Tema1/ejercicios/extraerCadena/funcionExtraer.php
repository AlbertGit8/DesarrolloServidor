<?php

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

                

                for ($i=0; $i < strlen($cad); $i++) { 
                    $sub.=$cad[$i];
                }

            }

        } else { //Error los límites introducidos no están dentro de la cadena
            
            echo "<B>Error</B> los límites introducidos no están dentro de la cadena";

        }

        return $sub;

    }

    $cadena = "telecospio";

    $ini = 0;

    $fin = 8;

    echo "La cadena es $cadena y extraemos desde $ini hasta $fin";

    echo "<br>";

    echo ExtraerCad($cadena,$ini,$fin);

?>