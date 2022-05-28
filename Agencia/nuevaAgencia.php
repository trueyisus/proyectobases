<?php
    include("../database/conexion.php");
    $nombre = $_POST["nombre"];
    $direccion = $_POST["direccion"];

	$resultMaxId = pg_query($dbconn, "SELECT MAX(bdii.agencia.id_agencia) FROM bdii.agencia");
    $renglonMaxId = pg_fetch_row($resultMaxId);

    $insertarPlanta = pg_query($dbconn, "INSERT INTO bdii.agencia VALUES(".($renglonMaxId[0]+1).", ".($renglonMaxId[0]+1).", '$nombre', '$direccion')");

?>