<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Palindroma</title>
</head>
<body>
    <?php
        //Verifica si una cadena ingresada es un palíndromo. El ejercicio compara la cadena original con su versión invertida para determinar si ambas son iguales.

        //Parámetros de entrada: palabra
        //Parámetros de salida: boolean

        function palindroma($palabra) {
            $palin = "";
        
            // Construir la cadena invertida
            for ($i = strlen($palabra) - 1; $i >= 0; $i--) { 
                $palin .= $palabra[$i];
            }
        
            echo "Cadena invertida: $palin<br>";
        
            // Comparar la cadena invertida con la original
            return $palin === $palabra;
        }

        

        $palabra = "ojo";

        if (palindroma($palabra)) {
            echo "$palabra es palindroma";
        } else {
            echo "$palabra no es palindroma";
        }

    ?>
</body>
</html>