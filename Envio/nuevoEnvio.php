<?php
    include("../database/conexion.php");
    $idventa = $_POST["idventa"];
    $fechaenvio = $_POST["fechaenvio"];
    $origen = $_POST["origen"];
    $destino = $_POST["destino"];
    $costoenvio = $_POST["costoenvio"];
    $estadoenvio = $_POST["estadoenvio"];

	$resultMaxId = pg_query($dbconn, "SELECT MAX(bdii.envio.codigo_seguimiento) FROM bdii.envio");
    $renglonMaxId = pg_fetch_row($resultMaxId);

    $insertarPlanta = pg_query($dbconn, "INSERT INTO bdii.envio VALUES(".($renglonMaxId[0]+1).", '$idventa', '$fechaenvio','$origen','$destino','$costoenvio','$estadoenvio')");

?>