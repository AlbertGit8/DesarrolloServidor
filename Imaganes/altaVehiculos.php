<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('libreriaBD.php');

function mostrarMarcas()
{
    $consulta = "SELECT * FROM marcas;";

    $filas = consultaDatosAssoc($consulta);

    foreach ($filas as $fila) {
        echo "<option value='$fila[Id]'> ";
        echo "$fila[Nombre] </option>";
    }
}

function guardarCoche()
{
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $precio = $_POST['precio'];

    $marca = (int)$marca;
    $precio = (int)$precio;
    //Procesamos el file
    if ($_FILES['foto']['name'] != "") {

        $nombreOrig = $_FILES['foto']['name'];

        $nombreTemp = $_FILES['foto']['tmp_name'];

        copy($nombreTemp, "images/$nombreOrig"); //Copiamos en archivo temporal desde su direccion

        $consulta = "INSERT INTO coches VALUES(NULL, '$nombre', $marca, '$modelo', $precio, '$nombreOrig')";

        consulta($consulta);

        echo "Coche guardado correctamente en la base de datos";
    }
}

$nombre = "";
$marca = "";
$modelo = "";
$precio = "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserccion coches</title>
</head>

<body>
    <fieldset>
        <legend>Alta Vehiculos con Imagen</legend>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">

            <p>
                <label for="nombre">Nombre: </label>
                <input type="text" name="nombre" value="">
            </p>

            <p>
                <label for="marca">Marca: </label>
                <select name="marca" id="marca">
                    <?php mostrarMarcas() ?>
                </select>
            </p>

            <p>
                <label for="modelo">Modelo: </label>
                <input type="text" name="modelo" value="">
            </p>

            <p>
                <label for="precio">Precio: </label>
                <input type="text" name="precio" value="">
            </p>

            <p>
                <label for="foto">Foto </label>
                <input type="file" name="foto">
            </p>

            <input type="submit" name="Guardar" value="Guardar">
        </form>
    </fieldset>

    <?php
    if (isset($_POST['Guardar'])) {
        guardarCoche();
    }
    ?>

</body>

</html>