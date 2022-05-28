<?php
    include("../database/conexion.php");
    $idInventario = $_POST["idInventario"];

    $result = pg_query($dbconn, "SELECT * FROM bdii.inventario WHERE bdii.inventario.id_inventario = $idInventario");
    $renglon = pg_fetch_row($result);

    echo '
    <table class="table table-hover">
        <tbody>
            <tr>
                <th scope="row">ID Almacen: </th>
                <td>'.$renglon[1].'</td>
            </tr>
            <tr>
                <th scope="row">ID Inmobiliario</th>
                <td>'.$renglon[2].'</td>
            </tr>
            <tr>
                <th scope="row">ID Producto</th>
                <td colspan="2">'.$renglon[3].'</td>
            </tr>
            <tr>
                <th scope="row">Cantidad Producto</th>
                <td colspan="2">'.$renglon[4].'</td>
            </tr>
        </tbody>
    </table>
    ';
?>