<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php

$numeros = array(5,7,1,3,4,6,9,8,7);

$edades["Jose"]=21;
$edades["Luis"]=19;
$edades["Rafa"]=20;
$edades["Tomas"]=22;
$edades["Edu"]=25;

echo "Antes de ordenar numetod <br>";

foreach ($numeros as $key => $value) {
    echo "$value ";
}
echo "<br>";

sort($numeros); //Ordenacion por valor ascendente

echo "Despues de ordenar <br>";

foreach ($numeros as $key => $value) {
    echo "$value ";
}

?>
</body>
</html>