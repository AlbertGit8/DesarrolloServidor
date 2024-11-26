<?php
require_once('libreria.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- Listamos en una tabla el nombre y apellido de los alumnos (tanto nombre como apellidos se muestran como enlaces) al hacer click se muestran las notas de todos los modulos de ese alumno -->

    <fieldset>
        <legend>Seleccione alumno</legend>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method='post'>
            <?php
            $consulta = "SELECT NIF,Nombre, Apellido1, Apellido2 FROM 'alumnos' order by 3,4,1;";

            $filas = consultaDatos($consulta);

            echo "<table border='2'>
            <tr>
            <th>Alumno<th>
            </tR>";
            
            foreach ($filas as $fila) {
                echo "<tr>
                
                <td>$fila[Apellido1] $fila[Apellido2], $fila[Nombre]
                
                </tr>
                
                </table>";
            }
            ?>
        </form>
    </fieldset>
</body>

</html>