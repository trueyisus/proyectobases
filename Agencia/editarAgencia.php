<?php
    include("../database/conexion.php");
    $idAgencia = $_POST["idAgencia"];
    $almacen = $_POST["almacen"];
    $nombre = $_POST["nombre"];
    $direccion = $_POST["direccion"];

	$query = "UPDATE bdii.agencia SET nombre = '$nombre', direccion ='$direccion' WHERE idAgencia = $idAgencia";
	$result = pg_query($dbconn, $query);
?>