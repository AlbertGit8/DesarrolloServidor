<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    
    $num = 9;


    function ejemplo(){

        global $num;

        for ($i=0; $i < $num; $i++) { 
            echo "Hola <br>";
        }
    }
    
    ejemplo($num);

    $potencia=1;

    function potencia($base, $exp) {
        global $potencia;

        for ($i=0; $i < $exp; $i++) { 
            $potencia*=$base;
        }
    }

    $base=2;

    $exp=3;

    potencia($base,$exp);

    echo "El resultado de la potencia de $base elevado a $exp es: $potencia";

    $numero = 15;

    $numeroDecremento = 5;

    $valorDecremento = 2;

    function decrementar(&$numero, $numeroDecremento, $valorDecremento) { //el & es para 
        while ($numeroDecremento > 0) {
            $numero=$numero-$valorDecremento;

            $numeroDecremento--;
        }

        return $numero;
    }

    

    echo "<br>";

    decrementar($numero, $numeroDecremento, $valorDecremento);

    echo "Decrementado $numeroDecremento veces en $valorDecremento resulta $numero";
    
    ?>
</body>
</html>