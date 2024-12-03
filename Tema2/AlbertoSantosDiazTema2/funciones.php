<?php
require_once("libreriaBD.php");

function mostrarCategorias()
{
    global $categoriasSelec;

    $consulta = "SELECT * FROM categoria";

    $categorias = consultaDatosAssoc($consulta);

    $contador = 0;


    echo "<table>";
    foreach ($categorias as $categoria) {

        echo "<td><label><input type='checkbox' name='categorias[$categoria[Id]]' value=''";
        if (array_key_exists($categoria['Id'], $categoriasSelec)) {
            echo " checked ";
        }
        echo ">";

        echo "$categoria[Nombre]</label>
            </td>";
        $contador++;

        if ($contador == 3) {
            echo "<tr>";
            $contador = 0;
        }
    }
    echo "</table>";
}

function obtenerMarcas()
{
    global $marca;
    $consulta = "SELECT * FROM marcas;";
    $marcas = consultaDatosAssoc($consulta);
    foreach ($marcas as $clave => $valores) {
        // Creamos la opción con el primer campo como valor

        echo "<option value='$valores[Id]' ";

        // Si el valor coincide con la selección actual, marcamos la opción como seleccionada
        if ($marca == $valores['Id']) {
            echo " selected ";
        }

        // Mostramos el nombre y apellido del alumno en la opción
        echo " >$valores[Nombre] </option>";
    }
}

function generarId()
{
    $consulta = "SELECT Id FROM producto";

    $ids = consultaDatosAssoc($consulta);

    $ultimoId = array_pop($ids);

    $ultimoId = array_pop($ultimoId);

    $ultimoId = intval($ultimoId);

    $ultimoId = $ultimoId + 1;

    return $ultimoId;
}

function insertarDatos($nombre, $modelo, $precio, $marca, $categorias)
{

    $id = generarID();

    $inserccionProducto = "INSERT INTO producto(Id, Nombre, Marca, Modelo, Precio) 
    VALUES($id, '$nombre', $marca,'$modelo', $precio)";

    consulta($inserccionProducto);

    foreach ($categorias as $IdCat => $value) {
        $consulta = "INSERT INTO prodcatego(IdPro, IdCat) 
        VALUES($id, $IdCat)";

        consulta("$consulta");
    }

    echo "Producto añadido con exito";
}

function buscarProducto($id)
{
    $producto = array();
    $consultaProducto = "SELECT * FROM producto WHERE Id = $id";

    $producto = consultaDatosAssoc($consultaProducto);

    if ($producto == []) {
        echo "<p style=color:red; >El producto no fue encontrado</p>";
    } else {
        foreach ($producto as $valor) {
            foreach ($valor as $termino) {
                array_push($producto, $termino);
            }
        }
    
        return $producto;
    }

    
}

function buscarProCat($id)
{
    $categorias = array();
    $consulta = "SELECT * FROM prodcatego WHERE IdPro = $id";

    $productoCatego = consultaDatosAssoc($consulta);

    return $productoCatego;
}
