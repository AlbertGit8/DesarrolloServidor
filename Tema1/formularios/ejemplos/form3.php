<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <legend>Formulario de registro</legend>
    <form name="f1" method="get" action="<?php echo $_SERVER['PHP_SELF'] ?>">
        Nombre<input type="text" name="Nombre">
        Apellido1<input type="text" name="Apellido1">
        Apellido2<input type="text" name="Apellido2">

        Pais <select name="Pais" id="">
            <option value="e">España</option>
            <option value="f">Francia</option>
            <option value="p">Portugal</option>
            <option value="a">Alemania</option>
        </select>

        <input type="submit" name="Enviar" value="Envio de datos">
    </form>


    <?php

    if (isset($_GET['Enviar'])) { //Aqui controlamos si hemos pulsado el boton de submit

        $nom = $_GET['Nombre'];

        $ap1 = $_GET['Apellido1'];

        $ap2 = $_GET['Apellido2'];

        $pais = $_GET['Pais'];


        echo "Hola $nom $ap1 $ap2";
        echo "<br>";

        switch ($pais) {
            case 'e':
                echo "Tu pais es España";
                break;
            case 'f':
                echo "Tu pais es Francia";
                break;
            case 'p':
                echo "Tu pais es Portugal";
                break;
            case 'a':
                echo "Tu pais es Alemania";
                break;

            default:
                echo "No ha seleccionado una opción correcta";
                break;
        }
    }
    ?>
</body>

</html>