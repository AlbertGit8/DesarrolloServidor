<?php
require_once("libreriaBD.php");
require_once("funciones.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>

<body>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <title>Examen Tema 2</title>
    </head>

    <body>
        <?php
        $idBuscado = "";
        $categoriasSelec = array();
        $nombre = "";
        $modelo = "";
        $precio = "";
        $marca = "";

        if (isset($_POST['idBuscado'])) {
            $idBuscado = $_POST['idBuscado'];
        }

        if (isset($_POST['Buscar'])) {
            $productoBuscado = array();


            $productoBuscado = buscarProducto($idBuscado);
            $categoriasSelec = buscarProCat($idBuscado);

            if (!$productoBuscado == []) {
                $nombre = $productoBuscado[2];
                $modelo = $productoBuscado[4];
                $precio = $productoBuscado[5];
                $marca = $productoBuscado[1];
            }
        }
        if (isset($_POST['Insertar'])) {
            if (isset($_POST['categorias'])) {
                $categoriasSelec = $_POST['categorias'];
            }

            if (isset($_POST['nombre'])) {
                $nombre = $_POST['nombre'];
            }

            if (isset($_POST['modelo'])) {
                $modelo = $_POST['modelo'];
            }

            if (isset($_POST['precio'])) {
                $precio = $_POST['precio'];
            }

            if (isset($_POST['marca'])) {
                $marca = $_POST['marca'];
            }
        }




        $acccion = "";
        if (isset($_POST['accion'])) {
            $acccion = $_POST['accion'];
        }
        ?>
        <form name='form1' action='<?php echo $_SERVER['PHP_SELF']; ?>' method='post'>
            <label>
                <input type="radio" name="accion" value="insertar" onchange="submit()"
                    <?php if ($acccion === 'insertar') echo 'checked'; ?>>
                Insertar
            </label>


            <label>
                <input type="radio" name="accion" value="buscar" onchange="submit()"
                    <?php if ($acccion === 'buscar') echo 'checked'; ?>>
                Buscar
            </label>
            <br>

            <?php
            if ($acccion == 'buscar') {
                echo "ID del producto: <input type='number' name='idBuscado'><br>";
                echo "<input type='submit' value='Buscar' name='Buscar'><br>";
            }
            ?>

            Nombre del producto: <input type="text" name="nombre" value="<?php echo $nombre ?>"><br>
            Modelo: <input type="text" name="modelo" value="<?php echo $modelo ?>"><br>
            Precio: <input type="number" name="precio" value="<?php echo $precio ?>"><br>
            Marca: <select name="marca" id="marca">
                <?php obtenerMarcas() ?>
            </select>

            <fieldset>
                <legend>Categorias</legend>
                <?php mostrarCategorias() ?>
            </fieldset>

            <input type="submit" value="Insertar" name="Insertar">

            <?php
            if (isset($_POST['Insertar'])) {
                if ($nombre == "" || $modelo == "" || $precio == "" || $marca == "" || $categoriasSelec == []) {
                    echo "DEBE INTRODUCIR TODOS LOS DATOS";
                } else {
                    insertarDatos($nombre, $modelo, $precio, $marca, $categoriasSelec);
                }
            }



            ?>
        </form>
    </body>

    </html>
</body>

</html>