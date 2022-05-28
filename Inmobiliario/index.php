<?php
    include("../database/conexion.php");
    $limit = 100;
    $noPagina = isset($_GET["page"]) ? $_GET["page"] : 1;
    $inicioConsulta = ($noPagina - 1) * $limit;

    $resultCount = pg_query($dbconn, "SELECT COUNT(*) FROM bdii.inmobiliario");
    $renglonCount = pg_fetch_row($resultCount);
    $paginas = ceil($renglonCount[0] / $limit);

    if($noPagina > $paginas || $noPagina < 1){
        header("Location: index.php?page=1");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inmobiliario</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
        body {
            color: #566787;
            background: #f5f5f5;
            font-family: 'Roboto', sans-serif;
        }
        .table-responsive {
            margin: 30px 0;
        }
        .table-wrapper {
            min-width: 1000px;
            background: #fff;
            padding: 20px;        
            box-shadow: 0 1px 1px rgba(0,0,0,.05);
        }
        .table-title {
            padding-bottom: 10px;
            margin: 0 0 10px;
        }
        .table-title h2 {
            margin: 8px 0 0;
            font-size: 22px;
        }
        .search-box {
            position: relative;        
            float: right;
        }
        .search-box input {
            height: 34px;
            border-radius: 20px;
            padding-left: 35px;
            border-color: #ddd;
            box-shadow: none;
        }
        .search-box input:focus {
            border-color: #3FBAE4;
        }
        .search-box i {
            color: #a0a5b1;
            position: absolute;
            font-size: 19px;
            top: 8px;
            left: 10px;
        }
        table.table tr th, table.table tr td {
            border-color: #e9e9e9;
        }
        table.table-striped tbody tr:nth-of-type(odd) {
            background-color: #fcfcfc;
        }
        table.table-striped.table-hover tbody tr:hover {
            background: #f5f5f5;
        }
        table.table th i {
            font-size: 13px;
            margin: 0 5px;
            cursor: pointer;
        }
        table.table td:last-child {
            width: 130px;
        }
        table.table td a {
            color: #a0a5b1;
            display: inline-block;
            margin: 0 5px;
        }
        table.table td a.view {
            color: #03A9F4;
        }
        table.table td a.edit {
            color: #FFC107;
        }
        table.table td a.delete {
            color: #E34724;
        }
        table.table td i {
            font-size: 19px;
        }    
        .pagination {
            float: right;
            margin: 0 0 5px;
        }
        .pagination li a {
            border: none;
            font-size: 95%;
            width: 30px;
            height: 30px;
            color: #999;
            margin: 0 2px;
            line-height: 30px;
            border-radius: 30px !important;
            text-align: center;
            padding: 0;
        }
        .pagination li a:hover {
            color: #666;
        }	
        .pagination li.active a {
            background: #03A9F4;
        }
        .pagination li.active a:hover {        
            background: #0397d6;
        }
        .pagination li.disabled i {
            color: #ccc;
        }
        .pagination li i {
            font-size: 16px;
            padding-top: 6px
        }
        .hint-text {
            float: left;
            margin-top: 6px;
            font-size: 95%;
        }    
    </style>

    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();

            //FUNCION CREAR INMOBILIARIO
            $("#create").on("click", function(){
                //LA LINEA DE ABAJO ES PARA MOSTRAR EL MODAL
                $('#crearInmoviliarioModal').modal('show'); 
                
                //ESTA PARTE ES PARA PODER OBTENER EL ID DEL EMPLEADO A EDITAR
                var idInmoviliarioCrear = $(this).data('id');
            });

            //FUNCION EDITAR INMOBILIARIO
            $(".edit").on("click", function(){
                $tr=$(this).closest('tr');
                var datos=$tr.children("td").map(function () {
                    return $(this).text();
                });

                $('#panta_edit').val(datos[1]);
                $('#fechaAdquisicion_edit').val(datos[2]);
                $('#valor_edit').val(datos[3]);
                $('#cantidad_edit').val(datos[4]);
                $('#descripcion_edit').val(datos[5]);

                $('#editarInmoviliarioModal').modal('show'); 
            });

            //FUNCION ELIMINAR INMOBILIARIO
            $(".delete").on("click", function(){
                //ESTA PARTE ES PARA PODER OBTENER EL ID DEL EMPLEADO A ELIMINAR
                var idInmobiliarioEliminar = $(this).data('id');
                
                //LA SIGUIENTE LINEA ES PARA AGREGAR EL TEXTO DENTRO DEL MODAL ELIMINAR
                $('#contenidoModalEliminar').html("<p>¿Esta seguro que quiere Eliminar el inmobiliario con id "+ idInmobiliarioEliminar +"?</p>");
                
                //LA LINEA DE ABAJO ES PARA MOSTRAR EL MODAL
                $('#eliminarInmobiliarioModal').modal('show'); 
            });
        });
    </script>

<script>
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
});
</script>

</head>
<body>
    <div class="container">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-8"><h2>Detalles del <b>Inmobiliario</b></h2></div>
                        <div class="col-sm-4">
                            <div class="search-box">
                                <i class="material-icons">&#xE8B6;</i>
                                <input type="text" class="form-control" placeholder="Buscar&hellip;">
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Planta<i></i></th>
                            <th>Fecha de adquisición</th>
                            <th>Valor en el mercado<i></i></th>
                            <th>Cantidad</th>
                            <th>Descripción<i></i></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $resultEmpleados = pg_query($dbconn, "SELECT * FROM bdii.inmobiliario ORDER BY id_inmobiliario LIMIT $limit OFFSET $inicioConsulta");
                            while ($row = pg_fetch_assoc($resultEmpleados)){
                                echo '
                                    <tr>
                                        <td>'.$row["id_inmobiliario"].'</td>
                                        <td>'.$row["id_planta"].'</td>
                                        <td>'.$row["fecha_adquisicion"].'</td>
                                        <td>'.$row["valor_mercado"].'</td>
                                        <td>'.$row["cantidad_inmueble"].'</td>
                                        <td>'.$row["descripcion"].'</td>
                                        <td>
                                            <a href="'.$row["id_inmobiliario"].'" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                                            <a data-id="'.$row["id_inmobiliario"].'" href="#" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                            <a data-id="'.$row["id_inmobiliario"].'" href="#" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                                        </td>
                                    </tr>
                                ';
                            }
                        ?> 
                    </tbody>
                </table>
                <div class="clearfix">
                    <ul class="pagination">
                        <?php
                            echo '
                                <li class="page-item"><a href="index.php?page='.($noPagina - 1).'"><i class="fa fa-angle-double-left"></i></a></li>
                            ';

                            for($i = $noPagina ; $i <= ($noPagina + 4) ; $i++){
                                if($i <= $paginas){
                                    if($i == $noPagina){
                                        echo '
                                            <li class="page-item active"><a href="index.php?page='.$i.'" class="page-link">'.$i.'</a></li>
                                        ';
                                    }else{
                                        echo '
                                            <li class="page-item"><a href="index.php?page='.$i.'" class="page-link">'.$i.'</a></li>
                                        ';
                                    }
                                }
                            }

                            echo '
                                <li class="page-item"><a href="index.php?page='.($noPagina + 1).'"><i class="fa fa-angle-double-right"></i></a></li>
                            ';
                        ?>
                    </ul>
                </div>
            </div>
        </div>        

        <!-- BOTON PARA LA CREACION DE REGISTROS -->
        <div>
            <button type="button" id="create" class="btn btn-primary">Nuevo inmobilario</button>
        </div>
    </div>     

    <!-- MODAL PARA CREAR REGISTRO-->
    <div class="modal fade" id="crearInmoviliarioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title" id="exampleModalLabel">Crear Inmobiliario</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="empleado">Planta</label>
                        <input type="text" class="form-control" id="planta">
                    </div>
                    <div class="form-group">
                        <label for="fechaAdquisicion">Fecha de adquisición</label>
                        <input type="text" class="form-control" id="fechaAdquisicion" >
                    </div>
                    <div class="form-group">
                        <label for="direccion">Valor en el mercado</label>
                        <input type="text" class="form-control" id="valor">
                    </div>
                    <div class="form-group">
                        <label for="valorMercado">Cantidad</label>
                        <input type="text" class="form-control" id="cantidad">
                    </div>
                    <div class="form-group">
                        <label for="cantidad">Descripción</label>
                        <input type="email" class="form-control" id="descripcion">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ESTE ES EL MODAL PARA EDITAR EL REGISTRO -->
    <div class="modal fade" id="editarInmoviliarioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title" id="exampleModalLabel">Editar Inmobiliario</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="empleado">Planta</label>
                        <input type="text" class="form-control" id="panta_edit">
                    </div>
                    <div class="form-group">
                        <label for="fechaAdquisicion">Fecha de adquisición</label>
                        <input type="text" class="form-control" id="fechaAdquisicion_edit" >
                    </div>
                    <div class="form-group">
                        <label for="direccion">Valor en el mercado</label>
                        <input type="text" class="form-control" id="valor_edit">
                    </div>
                    <div class="form-group">
                        <label for="valorMercado">Cantidad</label>
                        <input type="text" class="form-control" id="cantidad_edit">
                    </div>
                    <div class="form-group">
                        <label for="cantidad">Descripción</label>
                        <input type="email" class="form-control" id="descripcion_edit">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>

    <!--ESTE MODAL ES PARA ELIMINAR UN INMOBILIARIO-->
    <div class="modal fade" id="eliminarInmobiliarioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title" id="exampleModalLabel">¡Alerta!</h3>
                </div>
                <div id="contenidoModalEliminar" class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
