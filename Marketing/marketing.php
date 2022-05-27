<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bootstrap Simple Data Table</title>
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!--Referencia a la hoja de estilos-->
<link rel="stylesheet" href="/Inmobiliario/inmobiliario.css">

<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();

        //FUNCION CREAR INMOBILIARIO
        $("#create").on("click", function(){
            //LA LINEA DE ABAJO ES PARA MOSTRAR EL MODAL
            $('#crearMarketingModal').modal('show'); 
            
            //ESTA PARTE ES PARA PODER OBTENER EL ID DEL EMPLEADO A EDITAR
            var idMarketingCrear = $(this).data('id');
        });

        //FUNCION EDITAR INMOBILIARIO
        $(".edit").on("click", function(){
            //LA LINEA DE ABAJO ES PARA MOSTRAR EL MODAL
            $('#editarMarketingModal').modal('show'); 
            
            //ESTA PARTE ES PARA PODER OBTENER EL ID DEL EMPLEADO A EDITAR
            var idInmoviliarioEditar = $(this).data('id');
        });

        //FUNCION ELIMINAR INMOBILIARIO
        $(".delete").on("click", function(){
            //ESTA PARTE ES PARA PODER OBTENER EL ID DEL EMPLEADO A ELIMINAR
            var idMarketingEliminar = $(this).data('id');
            
            //LA SIGUIENTE LINEA ES PARA AGREGAR EL TEXTO DENTRO DEL MODAL ELIMINAR
            $('#contenidoModalEliminar').html("<p>¿Esta seguro que quiere Eliminar la campaña de marketing con id "+ idMarketingEliminar +"?</p>");
            
            //LA LINEA DE ABAJO ES PARA MOSTRAR EL MODAL
            $('#eliminarMarketingModal').modal('show'); 
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
                        <div class="col-sm-8"><h2>Detalles de las campañas de <b>Marketing</b></h2></div>
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
                            <th>Producto</th>
                            <th>Plataforma</th>
                            <th>Presupuesto</th>
                            <th>Inicio de promoción</th>
                            <th>Fin de promoción</th>
                            <th>Descripción</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Thomas garcia</td>
                            <td>89 Chiaroscuro Rd.</td>
                            <td>Portland</td>
                            <td>97220</td>
                            <td>Mexico</td>
                            <td>Mexico</td>
                            <td>
                                <a href="#" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                                <a href="#" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                <a href="#" class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="clearfix">
                    <div class="hint-text">Mostrando <b>5</b> de <b>25</b> entradas</div>

                    <ul class="pagination">
                        <li class="page-item disabled"><a href="#"><i class="fa fa-angle-double-left"></i></a></li>
                        <li class="page-item"><a href="#" class="page-link">1</a></li>
                        <li class="page-item"><a href="#" class="page-link">2</a></li>
                        <li class="page-item active"><a href="#" class="page-link">3</a></li>
                        <li class="page-item"><a href="#" class="page-link">4</a></li>
                        <li class="page-item"><a href="#" class="page-link">5</a></li>
                        <li class="page-item"><a href="#" class="page-link"><i class="fa fa-angle-double-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>        

        <!-- BOTON PARA LA CREACION DE REGISTROS -->
        <div>
            <button type="button" id="create" class="btn btn-primary">Nueva campaña</button>
        </div>
    </div>     

    <!-- MODAL PARA CREAR REGISTRO-->
    <div class="modal fade" id="crearMarketingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title" id="exampleModalLabel">Crear campaña de marketing</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="producto">Producto</label>
                        <input type="text" class="form-control" id="producto">
                    </div>
                    <div class="form-group">
                        <label for="pataforma">Plataforma</label>
                        <input type="text" class="form-control" id="plataforma" >
                    </div>
                    <div class="form-group">
                        <label for="presupuesto">Presupuesto</label>
                        <input type="text" class="form-control" id="presupuesto">
                    </div>
                    <div class="form-group">
                        <label for="inicioPromocion">Inicio de promoción</label>
                        <input type="text" class="form-control" id="inicioPromocion">
                    </div>
                    <div class="form-group">
                        <label for="finPromocion">Fin de promoción</label>
                        <input type="email" class="form-control" id="finPromocion">
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
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
    <div class="modal fade" id="editarMarketingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title" id="exampleModalLabel">Editar campaña de marketing</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="producto">Producto</label>
                        <input type="text" class="form-control" id="producto">
                    </div>
                    <div class="form-group">
                        <label for="pataforma">Plataforma</label>
                        <input type="text" class="form-control" id="plataforma" >
                    </div>
                    <div class="form-group">
                        <label for="presupuesto">Presupuesto</label>
                        <input type="text" class="form-control" id="presupuesto">
                    </div>
                    <div class="form-group">
                        <label for="inicioPromocion">Inicio de promoción</label>
                        <input type="text" class="form-control" id="inicioPromocion">
                    </div>
                    <div class="form-group">
                        <label for="finPromocion">Fin de promoción</label>
                        <input type="email" class="form-control" id="finPromocion">
                    </div>
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
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

    <!--ESTE MODAL ES PARA ELIMINAR UN INMOBILIARIO-->
    <div class="modal fade" id="eliminarMarketingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
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
