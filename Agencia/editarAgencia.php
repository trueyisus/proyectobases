<?php
    include("../database/conexion.php");
    $idAgencia = $_POST["idAgencia"];
    $nombre = $_POST["nombre"];
    $direccion = $_POST["direccion"];

	$query = "UPDATE bdii.agencia SET nombre_agencia = '$nombre', direccion = '$direccion' WHERE id_agencia = '$idAgencia'";
	$result = pg_query($dbconn, $query);
?>