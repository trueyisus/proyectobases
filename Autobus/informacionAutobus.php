<?php
    include("../database/conexion.php");
    $idAuto = $_POST["idAuto"];

    $result = pg_query($dbconn, "SELECT * FROM bdii.autobus, bdii.chofer WHERE bdii.chofer.id_chofer = bdii.autobus.id_chofer AND bdii.chofer.id_chofer = $idAutobusEditar");
    $renglon = pg_fetch_row($result);

    echo '
    <table class="table table-hover">
        <tbody>
            <tr>
                <th scope="row">Numero de serie: </th>
                <td>'.$renglon[2].'</td>
            </tr>
            <tr>
                <th scope="row">Id chofer: </th>
                <td>'.$renglon[3].'</td>
            </tr>
            <tr>
                <th scope="row">Placas: </th>
                <td colspan="2">'.$renglon[4].'</td>
            </tr>
            <tr>
                <th scope="row">Modelo: </th>
                <td colspan="2">'.$renglon[5].'</td>
            </tr>
            <tr>
                <th scope="row">ID empleado: </th>
                <td colspan="2">'.$renglon[7].'</td>
            </tr>                           
            <tr>
                <th scope="row">Numero de licencia: </th>
                <td colspan="2">'.$renglon[8].'</td>
            </tr>
            <tr>
                <th scope="row">Expiracion de licencia: </th>
                <td colspan="2">'.$renglon[9].'</td>
            </tr>
        </tbody>
    </table>
    ';
?>