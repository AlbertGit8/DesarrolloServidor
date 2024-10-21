<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario 6</title>
</head>
<body>
    <?php
    //Este script recibe datos de un formulario que contiene nombre y dos apellidos mediante el método GET. Si los datos son proporcionados, se genera un saludo utilizando esta información; si no, se muestra un mensaje de error indicando que no se ha recibido el nombre.


    if (isset($_GET['nombre']) && isset($_GET['ape1']) && isset($_GET['ape2'])) {
        $nombre = $_GET['nombre'];
        $apellido1 = $_GET['ape1'];
        $apellido2 = $_GET['ape2'];
    
        if (!empty($nombre) && !empty($apellido1) && !empty($apellido2)) {
            echo "Hola, $nombre $apellido1 $apellido2. ¡Bienvenido!";
        } else {
            echo "<p style=color:red;> Error: Todos los campos son obligatorios. </p>";
        }
    } else {
        echo "Error: No se ha recibido el nombre o los apellidos.";
    }
    ?>

   
</body>
</html>