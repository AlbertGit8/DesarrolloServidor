<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    //Crear una funcion que quite un string que este contenido dentro de otro y una opcion que pregunte que si esta contenido mas de una vez quitarlo la primera o todas las veces que se repita
    

    ?>
     <form action="<?php echo $_SERVER['PHP_SELF'] ?>">
        principal <input type="text" name="principal" value="<?php echo $princi  ?>">
        contenida <input type="text" name="contenida" value="<?php echo $conte  ?>">
        Varias veces: 
        SI<input type="radio" name="estado" id="" value="si">
        NO<input type="radio" name="estado" id="" value="no">
        <input type="submit" name="buscar" value="buscar">
    </form>
</body>
</html>