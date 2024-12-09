<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('libreriaBD.php');

$nombre = "";

if (isset($_POST['Guardar'])) {
    $nombre = $_POST['nombre'];

    echo "Nombre puesto: ";
    echo "$nombre<br>";


    //Procesamos el file
    if ($_FILES['imagen']['name'] != "") {

        $nombreOrig = $_FILES['imagen']['name'];

        $nombreTemp =$_FILES['imagen']['tmp_name'];

        copy($nombreTemp, "images/$nombreOrig");//Copiamos en archivo temporal desde su direccion

        $consulta = "INSERT INTO Marcas VALUES(NULL, '$nombre', '$nombreOrig')";

        consulta($consulta);
        

    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserccion imagenes</title>
</head>

<body>
    <fieldset>
        <legend>Alta Marcas con Imagen</legend>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">

            <p>
                <label for="nombre">Nombre: </label>
                <input type="text" name="nombre" value="<?php echo $nombre ?>">
            </p>

            <p>
                <label for="imagen">Imagen </label>
                <input type="file" name="imagen">
            </p>


            <input type="submit" name="Guardar" value="Guardar">
        </form>
    </fieldset>
</body>

</html>