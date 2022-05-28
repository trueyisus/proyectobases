<?php
    include("../database/conexion.php");
    $venta = $_POST["venta"];
    $producto = intval($_POST["producto"]);
    $cliente = intval($_POST["cliente"]);
    $cantidad = $_POST["cantidad"];
    $total = $_POST["correo"];
    
	$resultMaxId = pg_query($dbconn, "SELECT MAX(bdii.venta.id_venta) FROM bdii.venta");
    $renglonMaxId = pg_fetch_row($resultMaxId);

    $insertarPlanta = pg_query($dbconn, "INSERT INTO bdii.empleado VALUES(".($renglonMaxId[0]+1).", '$producto, '$cliente', 'current_timestamp', '$cantidad', '$total')");

?>