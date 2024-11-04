<?php
/*
        *** Metodos de apertura ***
        r Lectura Al inicio del archivo
        
        w Escritura Si e archivo no existe, intenta crearlo. Si existe, lo sobreescribe. Al inicio del archivo

        a+ Lectura y escritura Si e archivo no existe, intenta crearlo. Al final del archivo*/

// ***ABRIR Y CERRAR ARCHIVOS***
fopen($filename, $mode); //Abre un archivo en un modo específico (r para solo lectura, w para escribir y truncar, a para escribir al final sin truncar, etc.) y devuelve un manejador.

fclose($handle); //Cierra un archivo abierto, liberando el recurso.


// ***LEER Y ESCRIBIR EN ARCHIVOS***
fread($handle, $length); //Lee un número específico de bytes de un archivo abierto.

fwrite($handle, $string); //Escribe una cadena en un archivo.

fputs($file, $string, $length = null); // igual que fwrite pero con otro nombre

fgets($handle); //Lee una línea de un archivo.

fgetc($handle); //Lee un solo carácter de un archivo.

file_get_contents($filename); //Lee todo el contenido de un archivo y lo devuelve como una cadena.

file_put_contents($filename, $data); //Escribe datos en un archivo, creando o sobrescribiéndolo; es una combinación de fopen, fwrite y fclose.

/*7- Continuación del ejercicio 1 de ficheros AltaAlumno.php. Al hacer click en las cabeceras de las tablas, se mostrará la tabla ordenada por el campo seleccionado.(Enlaces).

8- a partir de un txt de alumnos, que salga un desplegable con sus nombres y apellidos, y al seleccionar uno y darle a mostrar ficha sale un formulario rellenado con sus datos.

9- Continuación del 8. cuando salga la ficha rellenada del alumno, se podrán cambiar todos los datos menos el NIF y al darle a actualizar se actualizarán en el txt.

10- formulario con nombre,apellido1,apellido2,edad, y teléfono. Buscará en el txt de alumnos los que contengan el campo rellenado igual al introducido por el usuario.(si en el campo nombre poner lucia, aparecerán todas las lucias).Si se da a buscar sin rellenar ningún campo mostrará a todos los alumnos.
11- Continuación del 10. En la tabla de los alumnos se podrá seleccionar los alumnos que se quieren eliminar al darle al botón Eliminar. Como en 4-BorraMulti.php
12- Continuación del 10. Añadiendo un desplegable donde se elige el modulo entre los disponibles de módulos.txt el botón de matricular y otro desplegable donde se elige el curso (2020-2021,2021-2022....2025).*/

?>