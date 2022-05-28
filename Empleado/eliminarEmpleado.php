<?php
    include("../database/conexion.php");
    $idEmpleado = $_POST["idEliminarEmpleado"];

    $query = "UPDATE bdii.empleado SET bdii.empleado.activo = false WHERE bdii.empleado.id_empleado = $idEmpleado";
	$result = pg_query($dbconn, $query);
?>