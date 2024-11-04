<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $a = 1;
    $b = 2;
    $c = "Hola Mundo";

    $verdadero = TRUE;

    echo $verdadero;

    $iguales = ($a == $b);

    echo $iguales;

    echo "<br>";

    if ($a == $b) {
        echo "a y b son igules";
    } else {
        echo "a y b no son iguales";
    }

    $edad = 15;

    switch ($edad) {
        case 'value':
            # code...
            break;
        
        default:
            # code...
            break;
    }


    for ($i=0; $i <=10 ; $i++) { 
        for ($i=0; $i <=10 ; $i++) { 
            echo $i;
        }
    }


    ?>
</body>

</html>