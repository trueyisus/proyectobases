<?php
$employee = $_GET["id"];
echo "editing employe id: " . $employee;
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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
</head>

<body class="bg-gray-200">

<div class="p-8 bg-gray-800">
    <div class="max-w-7xl mx-auto">
        <div>
            <div class="mt-2 md:flex md:items-center md:justify-between">
                <div class="flex-1 min-w-0">
                    <h2 class="text-2xl font-bold leading-7 text-white sm:text-3xl sm:truncate">
                        Actualizar Cambio Datos Empleado
                    </h2>
                </div>
                <a href="index.php" type="button"
                   class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-indigo-500">
                    &#8592;
                    Regresar
                </a>
            </div>
        </div>

    </div>
</div>

<div class="relative max-w-xl mx-auto">

    <div class="mt-12">

        <div class="text-red-500 my-10">
            <p class="text-sm">Todos los campos son requeridos</p>
        </div>
    </div>

    <div class="mt-12">
        <form id="form_cambio_empleado" action="#" method="POST"
              class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8">
            <div class="sm:col-span-2">
                <label for="first-name" class="block text-sm font-medium text-gray-700">
                    Empleado a actualizar
                </label>
                <input type="hidden" name="id_empleado" id="id_empleado">
                <div class="mt-1">
                    <input type="text"
                           id="id_empleado_info"
                           value=""
                           class="js-example-basic-single py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md"
                           disabled>
                </div>
            </div>

            <div>
                <label for="first-name" class="block text-sm font-medium text-gray-700">Sueldo</label>
                <div class="mt-1">
                    <input type="text" name="sueldo_input" id="sueldo_input" autocomplete="given-name"
                           class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                </div>
            </div>
            <div>
                <label for="last-name" class="block text-sm font-medium text-gray-700">Teléfono</label>
                <div class="mt-1">
                    <input type="text" name="telefono_input" id="telefono_input"
                           class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                </div>
            </div>
            <div class="sm:col-span-2">
                <label for="company" class="block text-sm font-medium text-gray-700">Correo</label>
                <div class="mt-1">
                    <input type="email" name="correo_input" id="correo_input"
                           class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                </div>
            </div>
            <div class="sm:col-span-2">
                <label for="email" class="block text-sm font-medium text-gray-700">Dirección</label>
                <div class="mt-1">
                    <input type="text" name="direccion_input" id="direccion_input"
                           class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                </div>
            </div>

            <div>
                <label for="first-name" class="block text-sm font-medium text-gray-700">Curp</label>
                <div class="mt-1">
                    <input type="text" name="curp_input" id="curp_input"
                           class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                </div>
            </div>
            <div>
                <label for="last-name" class="block text-sm font-medium text-gray-700">Rfc</label>
                <div class="mt-1">
                    <input type="text" name="rfc_input" id="rfc_input"
                           class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                </div>
            </div>

            <div>
                <label for="last-name" class="block text-sm font-medium text-gray-700">Activo</label>
                <div class="mt-1">
                    <select name="activo_input" id="activo_input"
                            class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                        <option value="1">Sí</option>
                        <option value="0">No</option>
                    </select>
                </div>
            </div>

            <div class="sm:col-span-2">
                <button type="submit" id="submit_form_cambio_empleado"
                        class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Editar
                </button>
            </div>
        </form>

        <div id="errors" class="mt-10 mb-24">
            <ul id="errors-list"></ul>
        </div>
    </div>
</div>

<script src="assets/js/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(function () {

        const employeeId = "<?php echo $employee; ?>"
        $.ajax({
            url: 'http://localhost:10000/cambio_empleado/' + employeeId + '/show',
            success: function (data) {
                console.log(data);
                $("#id_empleado").val(data.id_empleado);
                $("#id_empleado_info").val(`${data.nombre} ${data.apellido_paterno} ${data.apellido_materno} - ${data.curp}`);
                $("#sueldo_input").val(data.cambio.sueldo);
                $("#telefono_input").val(data.cambio.telefono);
                $("#correo_input").val(data.cambio.correo);
                $("#direccion_input").val(data.cambio.direccion);
                $("#curp_input").val(data.cambio.curp);
                $("#rfc_input").val(data.cambio.rfc);
                $("#activo_input").val(data.cambio.activo ? '1' : '0').select();
            },
            error: function (errors) {
                alert(errors.responseText);
            }
        });

        $("#form_cambio_empleado").on('submit', function (event) {

            event.preventDefault();

            $("#errors-list").html('');

            let formData = {
                'id_empleado': $("#id_empleado").val(),
                'sueldo': $("#sueldo_input").val(),
                'telefono': $("#telefono_input").val(),
                'correo': $("#correo_input").val(),
                'direccion': $("#direccion_input").val(),
                'curp': $("#curp_input").val(),
                'rfc': $("#rfc_input").val(),
                'activo': $("#activo_input").val()
            };

            $.ajax({
                url: 'http://localhost:10000/cambio_empleado/store',
                method: 'POST',
                data: formData,
                dataType: "json",
                encode: true,
                success: function () {
                    alert('registro actualizado');
                    window.location = '/proyectobases/Cambio_Empleado';
                },
                error: function (errors) {
                    console.log(errors)

                    if (errors.status === 422) {

                        alert('Error: revisa la información proporcionada');

                        let errorsResponse = errors.responseJSON;

                        for (const key in errorsResponse) {
                            $("#errors-list").append(`<li class='text-red-500 text-sm'>${key}: ${errorsResponse[key]}</li>`);
                            console.log(`${key}: ${errorsResponse[key]}`);
                        }
                    } else {
                        alert(`Error: ${errors.responseText}`);
                    }
                }
            }).done(function (data) {
                console.log(data);
            });

        });
    });
</script>
</body>

</html>
