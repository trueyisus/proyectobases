<?php
$baseDir = basename(__DIR__);
?>
<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title>Rutas</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/datatables.css">
    <meta name="theme-color" content="#fafafa">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography,aspect-ratio,line-clamp"></script>
</head>

<body class="bg-gray-200">

<!-- Add your site or application content here -->
<div>

    <div class="p-8 bg-gray-800">
        <div class="max-w-7xl mx-auto">

            <div>
                <div class="mt-2 md:flex md:items-center md:justify-between">
                    <div class="flex-1 min-w-0">
                        <h2 class="text-2xl font-bold leading-7 text-white sm:text-3xl sm:truncate">
                            Rutas
                        </h2>
                    </div>
                    <div class="mt-4 flex-shrink-0 flex md:mt-0 md:ml-4">
                        <a href="create.php" type="button"
                           class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-500 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-indigo-500">
                            Agregar
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">

        <table id="myTable" class="display" style="width:100%">
            <thead>
            <tr>
                <th>Id Ruta</th>
                <th>Id Horario</th>
                <th>No Serie Autobus</th>
                <th>Estado</th>
                <th>Nombre de Ruta</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Id Ruta</th>
                <th>Id Horario</th>
                <th>Id Autobus</th>
                <th>Estado</th>
                <th>Nombre de Ruta</th>
                <th></th>
                <th></th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>


<script src="assets/js/jquery.js"></script>
<script src="assets/js/datatables.js"></script>
<script>
    $(function () {


        $('#myTable').DataTable({
            processing: true,
            ajax: {
                'url': 'http://localhost:10000/rutas',
                'dataSrc': '',
            },


            columns: [
                {data: 'id_ruta'},
                {data: 'id_horario'},
                {data: 'id_autobus'},
                {data: 'estado'},
                {data: 'nombre_ruta'},
                {
                    data: null,
                    render(data) {
                        return '<a href="update.php?id=' + data.id_ruta + '" class="edit_record" style="color:green">Editar</a>';
                    },
                    orderable: false
                },
                {
                    data: null,
                    className: "dt-center editor-delete",
                    defaultContent: '<i class="fa fa-trash"/>',
                    render(data, type, row) {
                        return '<a href="!#" class="delete_record" style="color:red" data-key="' + data.id_ruta + '">Eliminar</a>';
                    },
                    orderable: false
                }
            ],

        });
    });


    // $(document).on('click', '.edit_record', function (el) {
    //     el.preventDefault();
    //     alert('editar registro');
    // });

    $(document).on('click', '.delete_record', function (el) {
        el.preventDefault();
        let keyRoute = $(this).data('key');
        let confirmation = confirm('Seguro quieres eliminar este registro?');

        if (confirmation) {
            $.ajax({
                url: "http://localhost:10000/rutas/delete",
                context: document.body,
                data: {
                    'id': keyRoute
                },
                method: 'POST'
            }).done(function () {
                alert('Registro eliminado');
                window.location.reload();
            });
        }
    });
</script>
</body>

</html>
