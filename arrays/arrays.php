<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        //$numeros = array(1,2,3,4,5,6);

        //$elementos = array(4, "Hola", 5.2, true, 2);

        $elementos = array();

        $elementos[4]=11;
        $elementos[]=4;
        $elementos[]="Hola";
        $elementos[]=5;
        $elementos[]=TRUE;
        $elementos[]=2;

        foreach($elementos as $clave => $valor) { 
            echo "El numero en la posicion en la posicion $clave es $valor <br>";
        }


        //$edades=array('Juan' =>19, 'Pepe' => 20, 'Luis' => 18, 'Tomas' => 24);
        $edades=array();
        $edades['Juan']=19;
        $edades['Pepe']=20;
        $edades['Luis']=18;
        $edades['Tomas']=24;

        echo "Mostramos las edades de los alumnos: <br>";

        foreach ($edades as $key => $value) {
            echo "El alumno $key tiene $value años <br>";
        }
    ?>
</body>
</html>