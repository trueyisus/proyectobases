<?php
    include("../database/conexion.php");
    $idEnvio = $_POST["idEnvio"];

    $result = pg_query($dbconn, "SELECT * FROM bdii.envio, bdii.venta WHERE bdii.envio.id_venta = bdii.venta.id_venta AND bdii.envio.codigo_seguimiento = $idEnvio");
    $renglon = pg_fetch_row($result);

    echo '
    <table class="table table-hover">
        <tbody>
            <tr>
                <th scope="row">Fecha de envio: </th>
                <td>'.$renglon[2].'</td>
            </tr>
            <tr>
                <th scope="row">Origen: </th>
                <td>'.$renglon[3].'</td>
            </tr>
            <tr>
                <th scope="row">Destino: </th>
                <td colspan="2">'.$renglon[4].'</td>
            </tr>
            <tr>
                <th scope="row">Costo Venta: </th>
                <td colspan="2">'.$renglon[5].'</td>
            </tr>
            <tr>
                <th scope="row">ID venta: </th>
                <td colspan="2">'.$renglon[7].'</td>
            </tr>      
            <tr>
                <th scope="row">Estado del envio: </th>
                <td colspan="2">'.$renglon[6].'</td>
            </tr>                         
            <tr>
                <th scope="row">ID cliente: </th>
                <td colspan="2">'.$renglon[9].'</td>
            </tr>
            <tr>
                <th scope="row">Cantidad de productos: </th>
                <td colspan="2">'.$renglon[11].'</td>
            </tr>    
            <tr>
                <th scope="row">Costo envio: </th>
                <td colspan="2">'.$renglon[12].'</td>
            </tr>
            <tr>
                <th scope="row">Tipo de envio: </th>
                <td colspan="2">'.$renglon[14].'</td>
            </tr>
        </tbody>
    </table>
    ';
?>