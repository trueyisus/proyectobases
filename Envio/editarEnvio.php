<?php
    include("../database/conexion.php");
    $codigoSeguimientoEd = $_POST["codigoSeguimientoEd"];
    $idVentaEd = $_POST["idVentaEd"];
    $fechaEnvioEd = $_POST["fechaEnvioEd"];
    $origenEd = $_POST["origenEd"];
    $destinoEd = $_POST["destinoEd"];
    $costoEnvioEd = $_POST["costoEnvioEd"];
    $estadoEnvioEd = $_POST["estadoEnvioEd"];

	$query = "UPDATE bdii.envio SET id_venta = '$idVentaEd', fecha_envio = '$fechaEnvioEd', origen = '$origenEd', destino = '$destinoEd', costo_envio = '$costoEnvioEd', estado_envio = '$estadoEnvioEd' WHERE codigo_seguimiento = $codigoSeguimientoEd";
	$result = pg_query($dbconn, $query);
?>