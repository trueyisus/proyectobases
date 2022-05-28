<?php
    include("../database/conexion.php");
    $nombre = $_POST["nombre"];
    $apellidoP = $_POST["apelldioPaterno"];
    $apellidoM = $_POST["apellidoMaterno"];
    $telefono = $_POST["telefono"];
    $correo = $_POST["correo"];
    $direccion = $_POST["direccion"];
    $idArea = intval($_POST["idArea"]);
    $idPlanta = intval($_POST["idPlanta"]);
    $curp = $_POST["curp"];
    $rfc = $_POST["rfc"];

    
	$resultMaxId = pg_query($dbconn, "SELECT MAX(bdii.empleado.id_empleado) FROM bdii.empleado");
    $renglonMaxId = pg_fetch_row($resultMaxId);

    $insertarPlanta = pg_query($dbconn, "INSERT INTO bdii.empleado VALUES('$nombre', '$apellidoP', '$apellidoM', $telefono, '$correo', '$direccion', ".($renglonMaxId[0]+1).", $idArea, $idPlanta, null, null, '$curp', '$rfc', true)");

?>