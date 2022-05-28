<?php
    include("../database/conexion.php");
    $nombre = $_POST["nombre"];
    $direccion = $_POST["direccion"];

	$resultMaxId = pg_query($dbconn, "SELECT MAX(bdii.planta.id_planta) FROM bdii.planta");
    $renglonMaxId = pg_fetch_row($resultMaxId);

    $insertarPlanta = pg_query($dbconn, "INSERT INTO bdii.planta VALUES(".($renglonMaxId[0]+1).", '$nombre', '$direccion')");

?>