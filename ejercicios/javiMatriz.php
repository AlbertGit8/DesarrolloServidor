<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Despues de darle a enviar aparecera en campo de texto para introducir un texto y un boton 
     a buscar. Me debe de indicar en que fila y columna esta ese numero  -->
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get" name="form1">
        <?php

        $fila = 2;
        $colu = 2;
        $control = 0;
        $matriz = array();
        if (isset($_GET['enviar'])||isset($_GET['Buscar'])) {
            $control += 1;
            $fila = $_GET['filas'];
            $colu = $_GET['columnas'];
        }
        //Función que rellena un array con las filas y columnas deseadas
        function rellenarArray()
        {
            global $fila;
            global $colu;

            //$matriz;
            echo "Tenemos filas: " . $fila . "<br>";
            echo "Tenemos columnas: " . $colu . "<br>";
            for ($i = 0; $i < $fila; $i++) {
                $matriz[$i] = array();
                for ($j = 0; $j < $colu; $j++) {
                    $matriz[$i][$j] = rand(1, 50);
                }
            }

            return $matriz;
        }

        function mostrarArray($matriz)
        {
            echo "<table border='2'>";
            foreach ($matriz as $key1 => $fila) {
                echo "<tr>";
                //echo $key1;
                foreach ($fila as $key => $value) {
                    echo "<td>";
                    echo $value;
                    echo "</td>";
                }

                echo "</tr>";
            }
            echo "</table>";
        }
        //Función que recibe una matriz y la convierte en una cadena de texto
        function serializarMatriz($matriz)
        {
            $serializada = ""; //Variable que va a guardar una cadena serializada

            foreach ($matriz as $key => $fila) {
                if ($serializada == "") {
                    $serializada .= implode(",", $fila);
                } else {
                    $serializada .= "," . implode(",", $fila);
                    //$serializada.="-";
                }
            }
            return $serializada;
        }

        function deSerializarMatriz($serializada)
        {

            global $matriz, $fila, $colu;

            //Convertimos la cadena con los elementos de la matriz original en un array lineal.
            $lineal = explode(",", $serializada);
            $cont = 0; //Contador para referenciar a los elementos del array lineal
            for ($i = 0; $i < $fila; $i++) {

                for ($j = 0; $j < $colu; $j++) {
                    $matriz[$i][$j] = $lineal[$cont];
                    $cont++;
                }
            }
            return $matriz;
        }

        function mostrarPosiciones($num, $matriz)
        {

            global $fila, $colu;

            for ($i = 0; $i < $fila; $i++) {
                for ($j = 0; $j < $colu; $j++) {
                    if ($num == $matriz[$i][$j]) {
                        echo "<br>El numero $num está en la linea: " . ($i + 1), ", columna: " . ($j + 1)."<br>";
                    }
                }
            }
        }
        ?>

        Filas <select name="filas" id="">
            <option value=""></option>
            <?php

            for ($i = 1; $i <= 10; $i++) {
                echo "<option value='$i'";
                if ($i == $fila) {
                    echo "selected";
                }
                echo ">$i</option>";
            }
            ?>


        </select>

        Columnas <select name="columnas" id="">
            <option value=""></option>
            <?php
            for ($i = 1; $i <= 10; $i++) {
                echo "<option value='$i'";
                if ($i == $colu) {
                    echo "selected";
                }

                echo ">$i</option>";
            }
            ?>


        </select>

        <input type="submit" value="Crear Matriz" name="enviar">
        <br>

        <?php

        if (isset($_GET['enviar'])) {
            //$control += 1;
            //$fila = $_GET['filas'];
            //$colu = $_GET['columnas'];
            // if ($fila != "" && $colu != "") {

            $matriz = rellenarArray();
            mostrarArray($matriz);

            //Creamos campo de texto para guardar la matriz de busqueda
            $serializada = serializarMatriz($matriz);
            //El type hidden no esta en el navegador pero está en la pagina si la inspeccionas
            echo "<input type='hidden' name='matrizAnt' value='$serializada'>";
            echo "<br>";
            //Mostramos el campo de texto de busqueda de elementos
            echo "<br><br>";
            echo "Numero a buscar <input type='number' name='numero'>";
            echo "<input type='submit' name='Buscar' value='Buscar'>";



            /* mi intento
        //Recorre la tabla y va haciendo inplode de cada array, cuando pasa a otro pone un guión para verificar cambio de linea
        foreach ($matriz as $key => $value) {
            if ($key == 0) {
                $StringTabla = implode(",", $value);
            } else {
                $StringTabla .= "-";
                $StringTabla .= implode(",", $value);
            }
        }

        //foreach ($matriz as $key => $value) {

        //echo "La tabla es " . $StringTabla;
        echo "<input type='text name='tablaStrings' value='$StringTabla'><br>";

        //Se vuelve a pasar del String a Array
        $matriz = array();
        $filas = array();
        $filas = explode("-", $StringTabla);
        foreach ($filas as $fila) {
            $matriz[] = explode(",", $fila);
        }

        echo "Muestro la tabla otra vez: ";
        mostrarArray($matriz);*/
            // } else {
            //     if ($fila == "") {
            //         echo "Debes introducir las filas<br>";
            //     }
            //     if ($colu == "") {
            //         echo "Debes introducir las columnas<br>";
            //     }
            // }
        }
        if (isset($_GET['Buscar'])) {
            //Recuperar el numero que estabamos buscando 

            $num = $_GET['numero'];
            //Recuperar la matriz anterior

            $serializada = $_GET['matrizAnt'];

            $matriz = deSerializarMatriz($serializada);
            //Mostrar la matriz 
            mostrarArray($matriz);

            //Mostrar el numero a buscar en su campo de texto
            echo "<input type'number' name'Numero' value'$num'>";

            //Recorrer la matriz y mostrar la fila y la columna de las celdas que contengan ese numero
            mostrarPosiciones($num, $matriz);
        }
        ?>
    </form>



</body>

</html>