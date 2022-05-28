<?php
    include("../database/conexion.php");
    $idPlanta = $_POST["idPlanta"];
    $nombre = $_POST["nombre"];
    $direccion = $_POST["direccion"];

	$query = "UPDATE bdii.planta SET nombre_planta = '$nombre', direccion = '$direccion' WHERE id_planta = $idPlanta";
	$result = pg_query($dbconn, $query);
?>