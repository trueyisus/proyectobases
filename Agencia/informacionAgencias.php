<?php
    include("../database/conexion.php");
    $idAgencia = $_POST["idAgencia"];

    $result = pg_query($dbconn, "SELECT * FROM bdii.agencia, bdii.almacen WHERE bdii.agencia.id_almacen = bdii.almacen.id_almacen AND bdii.agencia.id_agencia = '$idAgencia'");
    $renglon = pg_fetch_row($result);

    echo '
    <table class="table table-hover">
        <tbody>
            <tr>
                <th scope="row">Id agencia: </th>
                <td>'.$renglon[0].'</td>
            </tr>
            <tr>
                <th scope="row">Id almacen: </th>
                <td>'.$renglon[1].'</td>
            </tr>
            <tr>
                <th scope="row">Nombre agencia: </th>
                <td colspan="2">'.$renglon[2].'</td>
            </tr>
            <tr>
                <th scope="row">Direccion: </th>
                <td colspan="2">'.$renglon[3].'</td>
            </tr>
        </tbody>
    </table>
    ';
?>