<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar en Cadena</title>
</head>

<body>
    <?php
    //Este ejercicio realiza una búsqueda dentro de una cadena mayor para localizar una subcadena específica, devolviendo la posición de la primera ocurrencia encontrada.

    //Parámetros de entrada: $cadenaPrincipal $subcadena
    //Prámetro de salida: $posicion inicial de la primera subcadena encontrada en la cadena principal

    //Necesitamos verificar primero si la subcadena está dentro de la cadena principal, luego iteramos sobre la cadena principal buscando cuincidencias con la subcadena

    function enCadena($cadenaPrincipal, $subcadena)
    {
        return (strlen($cadenaPrincipal) > strlen($subcadena));
    }

    function buscar($cadenaPrincipal, $subcadena)
    {

        if (enCadena($cadenaPrincipal, $subcadena)) {
            $pos = 0;

            for ($i = 0; $i < strlen($cadenaPrincipal); $i++) {
                if ($cadenaPrincipal[$i] === $subcadena[$pos]) {
                    if ($pos === strlen($subcadena) - 1) {
                        return $i - $pos;
                        break;
                    }
                    $pos++;
                } else {
                    $pos = 0;
                }
            }

            return -1;
        } else {
            echo "La cadena a buscar es mayor que el texto introducido";
        }
    }


    $texto = "Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cupiditate sunt animi libero voluptas earum commodi quam perferendis aliquid quidem dolorem sint dignissimos odio suscipit, assumenda itaque nihil alias iusto labore!<br><br>";

    $subcadena = "ipsum";

    echo $texto;


    if(buscar($texto, $subcadena) == -1){
        echo "La cadena no se encuentra en el texto";
    } else {
        echo "La cadena $subcadena buscada en el texto se encuntra en la posicion ".buscar($texto, $subcadena);
    }

    ?>
</body>

</html>