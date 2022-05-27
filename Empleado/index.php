<?php
    include("../database/conexion.php");
    $limit = 100;
    $noPagina = isset($_GET["page"]) ? $_GET["page"] : 1;
    $inicioConsulta = ($noPagina - 1) * $limit;

    $resultCount = pg_query($dbconn, "SELECT COUNT(*) FROM bdii.empleado");
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
    <title>Empleados</title>
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

            //FUNCION DE AGREGAR EMPLEADO NUEVO
            $("#btnAgregarEmpleado").on("click", function(){
                $('#agregarEmpleadoModal').modal('show'); 
            });

            //FUNCION EDITAR EMPLEADO
            $(".edit").on("click", function(){
                //LA LINEA DE ABAJO ES PARA MOSTRAR EL MODAL
                $('#editarEmpleadoModal').modal('show'); 
                
                //ESTA PARTE ES PARA PODER OBTENER EL ID DEL EMPLEADO A EDITAR
                var idEmpleadoEditar = $(this).data('id');
            });

            //FUNCION ELIMINAR EMPLEADO
            $(".delete").on("click", function(){
                //ESTA PARTE ES PARA PODER OBTENER EL ID DEL EMPLEADO A ELIMINAR
                var idEmpleadoEliminar = $(this).data('id');
                
                //LA SIGUIENTE LINEA ES PARA AGREGAR EL TEXTO DENTRO DEL MODAL ELIMINAR
                $('#contenidoModalEliminar').html("<p>¿Esta seguro que quiere Eliminar el usuario con id "+idEmpleadoEliminar+"?</p>");
                
                //LA LINEA DE ABAJO ES PARA MOSTRAR EL MODAL
                $('#eliminarEmpleadoModal').modal('show'); 
            });
        });
    </script>

</head>
<body>
    <div class="container">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-8"><h2>Empleados</h2></div>
                        <div class="col-sm-4">
                            <div class="search-box">
                                <i class="material-icons">&#xE8B6;</i>
                                <input type="text" class="form-control" placeholder="Search&hellip;">
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <button type="button" class="btn btn-primary" id="btnAgregarEmpleado">Agregar nuevo empleado</button>
                </div>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre <i class="fa fa-sort"></i></th>
                            <th>Apellido Paterno</th>
                            <th>Apellido Materno <i class="fa fa-sort"></i></th>
                            <th>Telefono</th>
                            <th>Correo <i class="fa fa-sort"></i></th>
                            <th>Direccion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $resultEmpleados = pg_query($dbconn, "SELECT * FROM bdii.empleado ORDER BY id_empleado LIMIT $limit OFFSET $inicioConsulta");
                            while ($row = pg_fetch_assoc($resultEmpleados)){
                                echo '
                                    <tr>
                                        <td>'.$row["id_empleado"].'</td>
                                        <td>'.$row["nombre"].'</td>
                                        <td>'.$row["apellido_paterno"].'</td>
                                        <td>'.$row["apellido_materno"].'</td>
                                        <td>'.$row["telefono"].'</td>
                                        <td>'.$row["correo"].'</td>
                                        <td>'.$row["direccion"].'</td>
                                        <td>
                                            <a href="'.$row["id_empleado"].'" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                                            <a data-id="'.$row["id_empleado"].'" href="#" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                            <a data-id="'.$row["id_empleado"].'" href="#" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
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
    </div>  
    
    <!-- ESTE ES EL MODAL PARA AGREGAR UN NUEVO REGISTRO -->
    <div class="modal fade" id="agregarEmpleadoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title" id="exampleModalLabel">Agregar Empleado</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombreEmpleadoNew">Nombre(s)</label>
                        <input type="text" class="form-control" id="nombreEmpleadoNew">
                    </div>
                    <div class="form-group">
                        <label for="apellidoPEmpleadoNew">Apellido Paterno:</label>
                        <input type="text" class="form-control" id="apellidoPEmpleadoNew" >
                    </div>
                    <div class="form-group">
                        <label for="apellidoMEmpleadoNew">Apellido Materno</label>
                        <input type="text" class="form-control" id="apellidoMEmpleadoNew">
                    </div>
                    <div class="form-group">
                        <label for="curpEmpleadoNew">CURP</label>
                        <input type="text" class="form-control" id="curpEmpleadoNew">
                    </div>
                    <div class="form-group">
                        <label for="telefonoEmpleadoNew">Telefono</label>
                        <input type="text" class="form-control" id="telefonoEmpleadoNew">
                    </div>
                    <div class="form-group">
                        <label for="correoEmpleadoNew">Correo Electronico</label>
                        <input type="email" class="form-control" id="correoEmpleadoNew">
                    </div>
                    <div class="form-group">
                        <label for="direccionEmpleadoNew">Direccion</label>
                        <input type="text" class="form-control" id="direccionEmpleadoNew">
                    </div>
                    <div class="form-group">
                        <label for="tipoEmpleadoNew">Tipo Empleado</label>
                        <input type="text" class="form-control" id="tipoEmpleadoNew">
                    </div>
                    <div class="form-group">
                        <label for="sueldoEmpleadoNew">Sueldo</label>
                        <input type="text" class="form-control" id="sueldoEmpleadoNew">
                    </div>
                    <div class="form-group">
                        <label for="cargoEmpleadoNew">Cargo</label>
                        <input type="text" class="form-control" id="cargoEmpleadoNew">
                    </div>
                    <div class="form-group">
                        <label for="prestacionesEmpleadoNew">Prestaciones</label>
                        <input type="text" class="form-control" id="prestacionesEmpleadoNew">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Guardar Nuevo</button>
                </div>
            </div>
        </div>
    </div>


    <!-- ESTE ES EL MODAL PARA EDITAR EL REGISTRO -->
    <div class="modal fade" id="editarEmpleadoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title" id="exampleModalLabel">Editar Empleado</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombreEmpleadoEdit">Nombre(s)</label>
                        <input type="text" class="form-control" id="nombreEmpleadoEdit">
                    </div>
                    <div class="form-group">
                        <label for="apellidoPEmpleadoEdit">Apellido Paterno:</label>
                        <input type="text" class="form-control" id="apellidoPEmpleadoEdit" >
                    </div>
                    <div class="form-group">
                        <label for="apellidoMEmpleadoEdit">Apellido Materno</label>
                        <input type="text" class="form-control" id="apellidoMEmpleadoEdit">
                    </div>
                    <div class="form-group">
                        <label for="curpEmpleadoEdit">CURP</label>
                        <input type="text" class="form-control" id="curpEmpleadoEdit">
                    </div>
                    <div class="form-group">
                        <label for="telefonoEmpleadoEdit">Telefono</label>
                        <input type="text" class="form-control" id="telefonoEmpleadoEdit">
                    </div>
                    <div class="form-group">
                        <label for="correoEmpleadoEdit">Correo Electronico</label>
                        <input type="email" class="form-control" id="correoEmpleadoEdit">
                    </div>
                    <div class="form-group">
                        <label for="direccionEmpleadoEdit">Direccion</label>
                        <input type="text" class="form-control" id="direccionEmpleadoEdit">
                    </div>
                    <div class="form-group">
                        <label for="tipoEmpleadoEdit">Tipo Empleado</label>
                        <input type="text" class="form-control" id="tipoEmpleadoEdit">
                    </div>
                    <div class="form-group">
                        <label for="sueldoEmpleadoEdit">Sueldo</label>
                        <input type="text" class="form-control" id="sueldoEmpleadoEdit">
                    </div>
                    <div class="form-group">
                        <label for="cargoEmpleadoEdit">Cargo</label>
                        <input type="text" class="form-control" id="cargoEmpleadoEdit">
                    </div>
                    <div class="form-group">
                        <label for="prestacionesEmpleadoEdit">Prestaciones</label>
                        <input type="text" class="form-control" id="prestacionesEmpleadoEdit">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>
    
    <!--ESTE MODAL ES PARA ELIMINAR UN USUARIO-->
    <div class="modal fade" id="eliminarEmpleadoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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

<?php
    /*
    ESTA PARTE ES PARA CERRAR LA CONEXION CON LA BASE DE DATOS
    ESTO CON EL FIN DE NO CONSUMIR MUCHOS RECURSOS DEL EQUIPO
    */
    pg_close($dbconn);
?>