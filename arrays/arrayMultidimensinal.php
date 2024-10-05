<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    
    $alumnos = array("06167385H"=>array("Juan", "Perez", "Lopez"),
                    "05172939J"=>array("Jose", "Moreno", "García"), 
                    "05782838F"=>array("Luis", "vera", "Tellez"), 
                    );


    echo "<table border='2'>";

    echo "<th>DNI</th><th>Nombre</th><th>Apellido1</th><th>Apellido2</th>";
    foreach ($alumnos as $key => $alumno) {

        echo "<tr>";

        echo "<td>$key</td>";

        foreach ($alumno as $key => $campo) {
            echo "<td>$campo</td>";
        }


        echo "</tr>";
    }

    echo "</table>";
    ?>
</body>
</html>