<?php
$nombre = $_POST["nombres"];
setcookie("tew2", $nombre, time()+60);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EJEMPLO COOKIE</title>
</head>
<body>
        <h1>HOLA :) <?=$nombre;?></h1> 
        
        <?php 
      //  $dato = $_REQUEST['tew2'];
       //s echo $dato;
        ?>

</body>
</html>