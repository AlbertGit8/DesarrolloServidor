<?php

$dir = opendir("../ejercicios"); //Abrimos esta carpeta o directorio

$archivosPhp = array();
$archivosTxt = array();
$extensiones=array();

while (($NomFich = readdir($dir)) != false) {

    if (substr($NomFich, 0, 1) != false) {

        $campos= explode(".",$NomFich);

        if ($campos[count($campos)-1]=== "php") {
            $archivosPhp[] = $NomFich;
        } else {
            $archivosTxt[] = $NomFich;
        }

    }
}

sort($archivosPhp); //Ordenamos por valor ascendente
sort($archivosTxt);

echo "<p>Archivos .php</p>";
foreach ($archivosPhp as $archivo) {
    echo $archivo . "<br>";
}

echo "<p>Archivos .txt</p>";
foreach ($archivosTxt as $archivo) {
    echo $archivo . "<br>";
}

closedir($dir);
