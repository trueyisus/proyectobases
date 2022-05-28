<?php
    include("../database/conexion.php");
    $cliente = $_POST["cliente"];
    $cantidad = $_POST["cantidad"];
    $estado = $_POST["estado"];
    $tipo = $_POST["tipo"];

	$resultMaxId = pg_query($dbconn, "SELECT MAX(bdii.venta.id_venta) FROM bdii.venta");
    $renglonMaxId = pg_fetch_row($resultMaxId);

    $insertarPlanta = pg_query($dbconn, "INSERT INTO bdii.venta VALUES (".($renglonMaxId[0]+1).", ".($renglonMaxId[0]+1).", '$cliente', 'current_timestamp', '$cantidad', '$estado', '$tipo')");

?>