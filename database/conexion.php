<?php

    $host = "192.168.56.102"; //cambiar por la ip de su maquina virtual o su caso usar la palabra "localhost"
    $port = "5432";
    $dbname = "proyecto"; //cambiar por el nombre de su base de datos
    $user = "postgres"; 
    $password = "manepardo19"; //cambiar por su contraseña

    $dbconn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

?>