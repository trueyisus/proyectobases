<?php
    include("../database/conexion.php");
    $idAlmacen = $_POST["idAlmacen"];
    $idInmobiliario = $_POST["idInmobiliario"];
    $id_producto = $_POST["id_producto"];
    $cantidadProducto = $_POST["cantidadProducto"];

	$resultMaxId = pg_query($dbconn, "SELECT MAX(bdii.inventario.id_inventario) FROM bdii.inventario");
    $renglonMaxId = pg_fetch_row($resultMaxId);

    $insertarPlanta = pg_query($dbconn, "INSERT INTO bdii.inventario VALUES(".($renglonMaxId[0]+1).", '$idAlmacen', '$idInmobiliario','$id_producto','$cantidadProducto')");

?>