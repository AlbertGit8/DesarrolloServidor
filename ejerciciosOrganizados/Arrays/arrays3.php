<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrays 3</title>
</head>

<body>
    <?php
    //: Genera un array de 20 números enteros aleatorios. El programa cuenta cuántas veces se repite cada número en el array y muestra el resultado en una tabla HTML, con los números y sus respectivas frecuencias.

    //funcion que cuenta cuantas veces esta repetido un valor dentro de un array
    function contar($array, $num)
    {
        $contador = 0;

        foreach ($array as $key => $value) {
            if ($num === $value) {
                $contador++;
            }
        }

        return $contador;
    }

    //funcion que recorre un array y verifica si un numero se encuentra o no
    function recorrer($array, $num)
    {
        foreach ($array as $key => $value) {
            if ($num === $value) {
                return true;
            }
        }
        return false;
    }

    $array = array();
    $arraySinRepetir = array();

    //Rellenamos el array con numeros aleatorios del 1 al 10
    for ($i = 0; $i < 20; $i++) {
        $array[$i] = rand(1, 10);
    }

    //rellenamos un array auxiliar con los valores del array sin repetir
    foreach ($array as $key => $value) {
        if (!recorrer($arraySinRepetir, $value)) { // si el valor del array normal ya se encuentran en el array auxiliar no se almacenan

            $arraySinRepetir[$key] = $value;
        }    
    }

   

    echo "[ ";
    foreach ($array as $key => $value) {
        echo "$value ";
    }
    echo " ]<br><br>";

    echo "<table border='1'>";

    echo "<tr> 
            <td>Valor array</td> <td>Veces repetido</td> 
        </tr>";

    // Recorremos el array sin repetir para contar las frecuencias
    foreach ($arraySinRepetir as $valorUnico) {
        echo "<tr> 
            <td>$valorUnico</td> 
            <td>" . contar($array, $valorUnico) . "</td>
          </tr>";
    }

    echo "</table>";




    ?>
</body>

</html>