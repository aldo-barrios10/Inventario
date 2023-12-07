<?php

    $host = "localhost:3308";
    $user = "ventas_ing_graph";
    $pass = "ventas123";
    $bd = "inggraph";

    $conexion = mysqli_connect($host,$user,$pass,$bd);
    if (mysqli_connect_errno()){
        echo "No se pudo conectar a la base de datos";
        exit();
    }

    mysqli_select_db($conexion,$bd) or die("No se encuentra la base de datos");

    mysqli_set_charset($conexion,"utf8");


?>
