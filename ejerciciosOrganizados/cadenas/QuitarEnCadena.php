<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quitar en cadena</title>
</head>
<body>
    <?php
    //El ejercicio elimina una subcadena específica de un texto más grande, utilizando comparaciones para identificar su presencia y ajustando el resultado en función de su eliminación.

    
    function dentroCad($cadena,$pos) { //funcion que nos dice si una posicion se encuentra dentro de una cadena
        return (($pos>= 0) && ($pos<strlen($cadena)));
    }

    function extraer($cadena, $inicio, $fin) {

        $sub = "";

        if (dentroCad($cadena,$inicio) && dentroCad($cadena,$fin)) {
            if ($inicio > $fin ) {
                echo "<b>Error<b> Ha introducido un valor inicial mayor que le final";
            } else {
                for ($i=0; $i < strlen($cadena); $i++) { 
                    if ($i>=$inicio && $i<=$fin) {
                        $sub.=$cadena[$i];
                    }
                }
            }
        } else {
            echo "<br>Error<br> no ha introducido un rango adecuado";
        }

        return $sub;

        
    }

    function eliminarCad($cadena, $sub) {
        $i = 0;

        while ($i <= strlen($cadena)) {
            
        }
    }
    ?>
</body>
</html>