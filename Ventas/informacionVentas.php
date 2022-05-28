<?php
    include("../database/conexion.php");
    $idVenta = $_POST["idVenta"];

    $result = pg_query($dbconn, "SELECT * FROM bdii.venta, bdii.producto, bdii.cliente WHERE bdii.venta.id_producto = bdii.producto.id_producto AND bdii.venta.id_cliente = bdii.cliente.id_cliente AND bdii.venta.id_venta ='$idVenta'");
    $renglon = pg_fetch_row($result);

    echo '
    <table class="table table-hover">
        <tbody>
            <tr>
                <th scope="row">Id venta: </th>
                <td>'.$renglon[0].'</td>
            </tr>
            <tr>
                <th scope="row">Id producto: </th>
                <td>'.$renglon[1].'</td>
            </tr>
            <tr>
                <th scope="row">Id cliente: </th>
                <td colspan="2">'.$renglon[2].'</td>
            </tr>
            <tr>
                <th scope="row">Fecha: </th>
                <td colspan="2">'.$renglon[3].'</td>
            </tr>
            <tr>
                <th scope="row">Cantidad: </th>
                <td colspan="2">'.$renglon[4].'</td>
            </tr>      
            <tr>
                <th scope="row">Precio Unitario: </th>
                <td colspan="2">'.$renglon[9].'</td>
            </tr>                     
            <tr>
                <th scope="row">Total venta: </th>
                <td colspan="2">'.$renglon[5].'</td>
            </tr>
            <tr>
                <th scope="row">Estado: </th>
                <td colspan="2">'.$renglon[6].'</td>
            </tr>
            <tr>
                <th scope="row">Tipo de entrega: </th>
                <td colspan="2">'.$renglon[7].'</td>
            </tr>
            <tr>
                <th scope="row">Descripcion: </th>
                <td colspan="2">'.$renglon[10].'</td>
            </tr>
            <tr>
                <th scope="row">Tipo: </th>
                <td colspan="2">'.$renglon[11].'</td>
            </tr>
            <tr>
                <th scope="row">Nombre cliente: </th>
                <td colspan="2">'.$renglon[12].'</td>
            </tr>
            <tr>
                <th scope="row">Apellido Paterno: </th>
                <td colspan="2">'.$renglon[13].'</td>
            </tr>
            <tr>
                <th scope="row">Apellido Materno: </th>
                <td colspan="2">'.$renglon[14].'</td>
            </tr>
            <tr>
                <th scope="row">Telefono: </th>
                <td colspan="2">'.$renglon[15].'</td>
            </tr>
            <tr>
                <th scope="row">Correo: </th>
                <td colspan="2">'.$renglon[16].'</td>
            </tr>
            <tr>
                <th scope="row">Direccion: </th>
                <td colspan="2">'.$renglon[17].'</td>
            </tr>
            <tr>
                <th scope="row">RFC: </th>
                <td colspan="2">'.$renglon[19].'</td>
            </tr>
        </tbody>
    </table>
    ';
?>