<?php
    include("../database/conexion.php");
    $idFactura = $_POST["idFactura"];

    $result = pg_query($dbconn, "SELECT * FROM bdii.contabilidad, bdii.factura, bdii.venta, bdii.cliente, bdii.producto WHERE bdii.factura.id_factura = bdii.contabilidad.id_factura AND bdii.factura.id_venta = bdii.venta.id_venta  AND bdii.venta.id_venta = bdii.cliente.id_cliente AND bdii.producto.id_producto = bdii.venta.id_producto AND bdii.factura.id_factura = $idFactura");
    $renglon = pg_fetch_row($result);

    echo '
    <table class="table table-hover">
        <tbody>
            <tr>
                <th scope="row">Tipo de gasto: </th>
                <td>'.$renglon[2].'</td>
            </tr>
            <tr>
                <th scope="row">Costos: </th>
                <td>'.$renglon[3].'</td>
            </tr>
            <tr>
                <th scope="row">Tipo de estado financiero: </th>
                <td colspan="2">'.$renglon[4].'</td>
            </tr>
            <tr>
                <th scope="row">Ingresos: </th>
                <td colspan="2">'.$renglon[5].'</td>
            </tr>
            <tr>
                <th scope="row">ID venta: </th>
                <td colspan="2">'.$renglon[7].'</td>
            </tr>                           
            <tr>
                <th scope="row">Forma de pago: </th>
                <td colspan="2">'.$renglon[8].'</td>
            </tr>
            <tr>
                <th scope="row">Plazo de pago: </th>
                <td colspan="2">'.$renglon[9].'</td>
            </tr>
            <tr>
                <th scope="row">Referencia: </th>
                <td colspan="2">'.$renglon[10].'</td>
            </tr>
            <tr>
                <th scope="row">ID venta: </th>
                <td colspan="2">'.$renglon[11].'</td>
            </tr>    
            <tr>
                <th scope="row">Fecha de venta: </th>
                <td colspan="2">'.$renglon[14].'</td>
            </tr>
            <tr>
                <th scope="row">Producto: </th>
                <td colspan="2">'.$renglon[29].'</td>
            </tr>
            <tr>
                <th scope="row">Tipo de producto: </th>
                <td colspan="2">'.$renglon[30].'</td>
            </tr>  
            <tr>
                <th scope="row">Cantidad: </th>
                <td colspan="2">'.$renglon[15].'</td>
            </tr>
            <tr>
                <th scope="row">Precio de venta: </th>
                <td colspan="2">'.$renglon[16].'</td>
            </tr>
            <tr>
                <th scope="row">Nombre del cliente: </th>
                <td colspan="2">'.$renglon[19]." ".$renglon[20]." ".$renglon[21].'</td>
            </tr>
            <tr>
                <th scope="row">Telefono: </th>
                <td colspan="2">'.$renglon[22].'</td>
            </tr>
            <tr>
                <th scope="row">Correo: </th>
                <td colspan="2">'.$renglon[23].'</td>
            </tr>
            <tr>
                <th scope="row">Direccion: </th>
                <td colspan="2">'.$renglon[24].'</td>
            </tr>
        </tbody>
    </table>
    ';
?>