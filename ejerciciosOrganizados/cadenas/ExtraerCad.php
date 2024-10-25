<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Extraer Cadena</title>
</head>

<body>
    <?php
    //Este ejercicio extrae un fragmento de una cadena dado un intervalo de inicio y fin, imitando la funcionalidad de strstr pero con mayor control sobre las posiciones específicas.

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

    $cadena = "";
    $inicio = "";
    $fin = "";


    if (isset($_GET['extraer'])) {
        $cadena = $_GET['cadena'];
        $inicio = $_GET['inicio'];
        $fin = $_GET['fin'];
    }



    ?>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">

        <label for="cadena">Introduce una cadena</label><br>
        <input type="text" id="cadena" name="cadena" value="<?php echo $cadena; ?>">
        <br><br>

        <h3>Introdice un intervalo para extraer un fragmento de la cadena</h3>
        <label for="inicio">Inicio</label><br>
        <input type="number" id="inicio" name="inicio" value="<?php echo $inicio; ?>">
        <br><br>

        <label for="fin">Fin</label><br>
        <input type="number" id="fin" name="fin" value="<?php echo $fin; ?>">
        <br><br>

        <input type="submit" name="extraer" value="extraer"><br>


    </form>

    <?php

    

    if (isset($_GET['extraer'])) {

        echo "Quitaremos de la posicion $inicio hasta la posicion $fin en la cadena $cadena<br>";

        echo "Cadena extraida: ".extraer($cadena, $inicio, $fin);
    }

    ?>
</body>

</html>