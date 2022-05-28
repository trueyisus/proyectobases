<?php
    include("../database/conexion.php");
    $idAutobus = $_POST["idAutobus"];
    $chofer = $_POST["chofer"];
    $placas = $_POST["placas"];
    $modelo = $_POST["modelo"];

	$query = "UPDATE bdii.autobus SET placas = '$placas', modelo = '$modelo' WHERE numero_serie = '$idAutobus'";
	$result = pg_query($dbconn, $query);
?>