<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table style="width: 200px; height: 200px;" border="2">

    <?php
        for ($i=0; $i <8 ; $i++) { 
            echo "<tr>";
            for ($j=0; $j <8 ; $j++) { 

                if ($i%2==0) {
                    if ($j%2==0) {
                        echo " <td ></td>";
                    } else {
                        echo " <td bgcolor='black'></td>";
                    }
                } else {
                    if ($j%2!=0) {
                        echo " <td ></td>";
                    } else {
                        echo " <td bgcolor='black'></td>";
                    }
                }

            }
            echo "</tr>";
        }
    ?>
    </table>
       
</body>
</html>