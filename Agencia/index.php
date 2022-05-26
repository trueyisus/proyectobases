<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Agencias</title>
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

        //FUNCION CREAR AGENCIA
        $("#create").on("click", function(){
            //LA LINEA DE ABAJO ES PARA MOSTRAR EL MODAL
            $('#crearAgenciaModal').modal('show'); 
            
            //ESTA PARTE ES PARA PODER OBTENER EL ID DE LA AGENCIA A EDITAR
            var idAgenciaCrear = $(this).data('id');
        });

        //FUNCION EDITAR AGENCIA
        $(".edit").on("click", function(){
            //LA LINEA DE ABAJO ES PARA MOSTRAR EL MODAL
            $('#editarAgenciaModal').modal('show'); 
            
            //ESTA PARTE ES PARA PODER OBTENER EL ID DE LA AGENCIA A EDITAR
            var idAgenciaEditar = $(this).data('id');
        });

        //FUNCION ELIMINAR AGENCIA
        $(".delete").on("click", function(){
            //ESTA PARTE ES PARA PODER OBTENER EL ID DEL EMPLEADO A ELIMINAR
            var idAgenciaEliminar = $(this).data('id');
            
            //LA SIGUIENTE LINEA ES PARA AGREGAR EL TEXTO DENTRO DEL MODAL ELIMINAR
            $('#contenidoModalEliminar').html("<p>¿Esta seguro que quiere Eliminar la agencia con id "+ idAgenciaEliminar +"?</p>");
            
            //LA LINEA DE ABAJO ES PARA MOSTRAR EL MODAL
            $('#eliminarAgenciaModal').modal('show'); 
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
                        <div class="col-sm-8"><h2><b>Agencias</b></h2></div>
                        <div class="col-sm-4">
                            <div class="search-box">
                                <i class="material-icons">&#xE8B6;</i>
                                <input type="text" class="form-control" placeholder="Buscar&hellip;">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- BOTON PARA LA CREACION DE REGISTROS -->
                <div>
                    <button type="button" id="create" class="btn btn-primary">Nueva Agencia</button>
                </div>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>ID_Agencia</th>
                            <th>ID_Inventario</th>
                            <th>ID_Importacion <i class="fa fa-sort"></i></th>
                            <th>ID_Almacen</th>
                            <th>Nombre Agencia</th>
                            <th>Direccion Agencia <i class="fa fa-sort"></i></th>
                            <th>Gestionar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>114</td>
                            <td>MEX-1</td>
                            <td>A4</td>
                            <td>Centro</td>
                            <td>89 Chiaroscuro Rd.</td>
                            <td>
                                <a href="#" class="view" title="Ver" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                                <a data-id="ID_Agencia" href="#" class="edit" title="Editar" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                <a data-id="ID_Agencai" href="#" class="delete" title="Eliminar" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>135</td>
                            <td>MEX-3</td>
                            <td>A8</td>
                            <td>Rodeo</td>
                            <td>C/ Araquil, 67</td>
                            <td>
                                <a href="#" class="view" title="Ver" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                                <a data-id="ID_Agencia" href="#" class="edit" title="Editar" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                <a data-id="ID_Agencia" href="#" class="delete" title="Eliminar" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
                <div class="clearfix">
                    <div class="hint-text">Mostrando <b>2</b> de <b>2</b> elementos</div>
                    <ul class="pagination">
                        <li class="page-item disabled"><a href="#"><i class="fa fa-angle-double-left"></i></a></li>
                        <li class="page-item active"><a href="#" class="page-link">1</a></li>
                        <li class="page-item"><a href="#" class="page-link">2</a></li>
                        <li class="page-item"><a href="#" class="page-link">3</a></li>
                        <li class="page-item"><a href="#" class="page-link">4</a></li>
                        <li class="page-item"><a href="#" class="page-link">5</a></li>
                        <li class="page-item"><a href="#" class="page-link"><i class="fa fa-angle-double-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>        
    </div>    
</div>     

<!-- MODAL PARA CREAR REGISTRO-->
<div class="modal fade" id="crearAgenciaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title" id="exampleModalLabel">Crear Agencia</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="IdAgencia">Id Agencia:</label>
                        <input type="text" class="form-control" id="IdAgencia">
                    </div>
                    <div class="form-group">
                        <label for="IdInventario">Id inventario:</label>
                        <input type="text" class="form-control" id="IdInventario" >
                    </div>
                    <div class="form-group">
                        <label for="IdImportacion">Id Importación:</label>
                        <input type="text" class="form-control" id="IdImportacion" >
                    </div>
                    <div class="form-group">
                        <label for="IdAlmacen">Id Almacen:</label>
                        <input type="text" class="form-control" id="IdAlmacen" >
                    </div>
                    <div class="form-group">
                        <label for="nombreAgencia">Nombre Agencia:</label>
                        <input type="text" class="form-control" id="nombreAgencia" >
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección Agencia:</label>
                        <input type="text" class="form-control" id="direccion" >
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
    <div class="modal fade" id="editarAgenciaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title" id="exampleModalLabel">Editar Agencia</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="IdAgencia">Id Agencia:</label>
                        <input type="text" class="form-control" id="IdAgencia">
                    </div>
                    <div class="form-group">
                        <label for="IdInventario">Id inventario:</label>
                        <input type="text" class="form-control" id="IdInventario" >
                    </div>
                    <div class="form-group">
                        <label for="IdImportacion">Id Importación:</label>
                        <input type="text" class="form-control" id="IdImportacion" >
                    </div>
                    <div class="form-group">
                        <label for="IdAlmacen">Id Almacen:</label>
                        <input type="text" class="form-control" id="IdAlmacen" >
                    </div>
                    <div class="form-group">
                        <label for="nombreAgencia">Nombre Agencia:</label>
                        <input type="text" class="form-control" id="nombreAgencia" >
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección Agencia:</label>
                        <input type="text" class="form-control" id="direccion" >
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
    <div class="modal fade" id="eliminarAgenciaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
