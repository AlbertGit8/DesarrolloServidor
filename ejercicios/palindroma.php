<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $pal = "";
    if (isset($_GET['buscar'])) {
        $pal = $_GET['palindroma'];
    }

    function esPalindroma($pal)
    {

        $igual = false;
        $reves = "";

        for ($i = strlen($pal) - 1; $i >= 0; $i--) {
            $reves .= $pal[$i];
        }

        if ($pal == $reves) {
            $igual = true;
        }

        return $igual;
    }

    if (isset($_GET['buscar'])) {
        $pal = $_GET['palindroma'];

        if (esPalindroma($pal)) {
            echo "$pal es palindroma";
        } else {
            echo "$pal no es palindroma";
        }
    }

    ?>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>">
        palindroma <input type="text" name="palindroma" value="<?php echo $pal  ?>">

        <input type="submit" name="buscar" value="buscar">
    </form>
</body>

</html>