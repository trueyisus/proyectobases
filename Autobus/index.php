<?php
    include("../database/conexion.php");
    $limit = 100;
    $noPagina = isset($_GET["page"]) ? $_GET["page"] : 1;
    $inicioConsulta = ($noPagina - 1) * $limit;

    $resultCount = pg_query($dbconn, "SELECT COUNT(*) FROM bdii.autobus");
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
    <title>Autobus</title>
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

            //FUNCION CREAR AUTOBUS
            $("#create").on("click", function(){
            //LA LINEA DE ABAJO ES PARA MOSTRAR EL MODAL
            $('#crearAutobusModal').modal('show'); 
            
                //ESTA PARTE ES PARA PODER OBTENER EL ID DEL AUTOBUS A EDITAR
                var idAutobusCrear = $(this).data('id');
            });

            //FUNCION VER AUTOBUS
            $(".view").on("click", function () {
                //LA LINEA DE ABAJO ES PARA MOSTRAR EL MODAL
                $('#viewAutobusModal').modal('show');

                //ESTA PARTE ES PARA PODER OBTENER EL ID DEL EMPLEADO A EDITAR
                var idAuto = $(this).data('id');

                $.post("informacionAutobus.php", {idAuto: idAuto}, 
                    function(data){
                        $("#h3AutobusInformacion").html("Informacion de autobus: "+idAuto);
                        $("#divInformacionAutobus").html(data);
                    }
                );
            });

            //FUNCION EDITAR AUTOBUS
            $(".edit").on("click", function(){
                //LA LINEA DE ABAJO ES PARA MOSTRAR EL MODAL
                $('#editarAutobusModal').modal('show'); 
            
                //ESTA PARTE ES PARA PODER OBTENER EL ID DEL AUTOBUS A EDITAR
                var idAutobusEditar = $(this).data('id');
                var idChofer = $("#rowAutobus-"+idAutobusEditar+" #idChofer").text();
                var idplacas = $("#rowAutobus-"+idAutobusEditar+" #idplacas").text();
                var idmodelo = $("#rowAutobus-"+idAutobusEditar+" #idmodelo").text();

                $("#idAutobusEdit").val(idAutobusEditar);
                $("#idChoferEdit").val(idChofer);
                $("#placasEdit").val(idplacas);
                $("#modeloEdit").val(idmodelo);
            });

            $("#btnGuardarEditAutobus").on("click", function () {
                var idAutobus = $("#idAutobusEdit").val();;
                var chofer = $("#idChoferEdit").val();
                var placas = $("#placasEdit").val();
                var modelo = $("#modeloEdit").val();

                $.post("editarAutobus.php", {idAutobus:idAutobus, chofer:chofer, placas:placas, modelo:modelo},
                    function(data){
                        location.reload();
                    }
                );
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
                        <div class="col-sm-8"><h2>Autobus</h2></div>
                        <div class="col-sm-4">
                            <div class="search-box">
                                <i class="material-icons">&#xE8B6;</i>
                                <input type="text" class="form-control" placeholder="Search&hellip;">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- BOTON PARA LA CREACION DE REGISTROS -->
                <div>
                    <button type="button" id="create" class="btn btn-primary">Nuevo Autobus</button>
                </div>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Numero_serie <i class="fa fa-sort"></i></th>
                            <th>Id_chofer <i class="fa fa-sort"></i></th>
                            <th>Placas</th> 
                            <th>Modelo</th>
                            <th>Gestionar</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                            $resultEmpleados = pg_query($dbconn, "SELECT * FROM bdii.autobus ORDER BY numero_serie LIMIT $limit OFFSET $inicioConsulta");
                            while ($row = pg_fetch_assoc($resultEmpleados)){
                                echo '
                                    <tr id="rowAutobus-'.$row["numero_serie"].'">
                                        <td>'.$row["numero_serie"].'</td>
                                        <td ="idChofer">'.$row["id_chofer"].'</td>
                                        <td ="idplacas">'.$row["placas"].'</td>
                                        <td ="idmodelo">'.$row["modelo"].'</td>
                                        <td>
                                            <a href="#" data-id="'.$row["numero_serie"].'" class="view" title="View" data-toggle="tooltip"><i class="material-icons">&#xE417;</i></a>
                                            <a href="#" data-id="'.$row["numero_serie"].'" class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
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
    
    <!-- MODAL PARA CREAR REGISTRO-->
    <div class="modal fade" id="crearAutobusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title" id="exampleModalLabel">Crear Autobus</h3>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="numeroSerie">Número de serie:</label>
                        <input type="text" class="form-control" id="numeroSerie"></input>
                    </div>
                    <div class="form-group">
                        <label for="IdChofer">Id chofer:</label>
                        <input type="text" class="form-control" id="IdChofer" ></input>
                    </div>
                    <div class="form-group">
                        <label for="placas">Placas:</label>
                        <input type="text" class="form-control" id="placas" ></input>
                    </div>
                    <div class="form-group">
                        <label for="modelo">Modelo:</label>
                        <input type="text" class="form-control" id="modelo" ></input>
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
    <div class="modal fade" id="editarAutobusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title" id="exampleModalLabel">Editar Autobus</h3>
                </div>
                <div class="modal-body">
                    <table class="table table-hover">
                        <div class="form-group">
                            <label for="idAutobusEdit">Número de serie:</label>
                            <input type="text" class="form-control" id="idAutobusEdit" disabled></input>
                        </div>
                        <div class="form-group">
                            <label for="IdChoferEdit">Id chofer:</label>
                            <input type="text" class="form-control" id="idChoferEdit" disabled></input>
                        </div>
                        <div class="form-group">
                            <label for="placasEdit">Placas:</label>
                            <input type="text" class="form-control" id="placasEdit" ></input>
                        </div>
                        <div class="form-group">
                            <label for="modeloEdit">Modelo:</label>
                            <input type="text" class="form-control" id="modeloEdit" ></input>
                        </div>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ESTE ES EL MODAL PARA VER EL REGISTRO -->
    <div class="modal fade bd-example-modal-lg" id="viewAutobusModal" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title" id="h3AutobusInformacion"></h3>
                </div>
                <div class="modal-body" id="divInformacionAutobus">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
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