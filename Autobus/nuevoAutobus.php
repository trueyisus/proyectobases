<?php
    include("../database/conexion.php");
    $serie = $_POST["nombre"];
    $chofernew = $_POST["chofer"];
    $placasnew = $_POST["placas"];
    $modelonew = $_POST["modelo"];

	$resultMaxId = pg_query($dbconn, "SELECT MAX(bdii.chofer.id_chofer) FROM bdii.chofer");
    $renglonMaxId = pg_fetch_row($resultMaxId);

    $insertarPlanta = pg_query($dbconn, "INSERT INTO bdii.autobus VALUES( '$serie", .($renglonMaxId[0]+1).", '$placas', '$modelo')");

?>