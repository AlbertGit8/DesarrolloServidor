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
    /*
        *** Metodos de apertura ***
        r Lectura Al inicio del archivo
        
        w Escritura Si e archivo no existe, intenta crearlo. Si existe, lo sobreescribe. Al inicio del archivo

        a+ Lectura y escritura Si e archivo no existe, intenta crearlo. Al final del archivo    
    
    $fd = fopen("prueba.txt","r") or die("Error al abir el archivo");

    

    while ( !feof($fd) ) { // Minetras no hayamos llegado al fin del archivo
        $line=fgets($fd); // Extraemos una linea de ese archivo 

        echo $line."<br>";
    }

    fclose($fd); //Cerramos el archivo
    */

    $fd=fopen("escritura.txt","w") or die("Error al abrir el archivo");

    $saltoLin = "\n";

    $linea= "Alberto Santos Díaz".$saltoLin;

    $linea2 = "Espabila hombre ya";

    fputs($fd,$linea);
    fputs($fd,$linea2);

    fclose($fd);

    ?>
</body>
</html>