<?php

$ficheroAlumnos = "../pruebas";

$dir = opendir($ficheroAlumnos);

$archivosPHP = array();
$archivosTXT = array();

while (($nombreFichero = readdir($dir)) != FALSE) {
    if (substr($nombreFichero, 0, 1) != ".") {
        //array con dos campos: 1- nombre, 2- extension
        $campos = explode(".", $nombreFichero);
        if ($campos[count($campos) - 1] === "php") {
            $archivosPHP[] = $nombreFichero;
        } else {
            $archivosTXT[] = $nombreFichero;
        }
    }
}

//orden ascendente
sort($archivosPHP);
sort($archivosTXT);

echo "<p> Archivos .php: <br>";
foreach ($archivosPHP as $clave => $archivo) {
    echo $archivo . "<br>";
}
echo "<p>";

echo "<p> Archivos .txt: <br>";
foreach ($archivosTXT as $clave => $archivo) {
    echo $archivo . "<br>";
}
echo "<p>";

closedir($dir);
