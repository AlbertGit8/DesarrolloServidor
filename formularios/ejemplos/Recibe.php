<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php
        //Recepción de los datos del formulario


        if (isset($_GET['nombre'])) {
            $nom=$_GET['nombre'];
        } else {
            echo "Variable Nombre no recibida";
        }

 

        $nom=$_GET['NOmbre'];
        
        $ap1=$_GET['Apellido1'];

        $ap2=$_GET['Apellido2'];

        echo "Hola $nom $ap1 $ap2";
    ?>

</body>
</html>