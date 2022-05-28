<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title>Horarios</title>
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
                        Crear Horario
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
        <form id="form_horarios" action="#" method="POST"
              class="grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8">

            <div>
                <label for="hora_salida_input" class="block text-sm font-medium text-gray-700">Hora de Salida</label>
                <div class="mt-1">
                    <input type="time" name="hora_salida_input" id="hora_salida_input"
                           class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                </div>
            </div>
            <div>
                <label for="hora_llegada_input" class="block text-sm font-medium text-gray-700">
                    Hora de LLegada
                </label>
                <div class="mt-1">
                    <input type="time" name="hora_llegada_input" id="hora_llegada_input"
                           class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                </div>
            </div>
            <div class="sm:col-span-2">
                <label for="lugar_inicio_input" class="block text-sm font-medium text-gray-700">
                    Lugar Inicio
                </label>
                <div class="mt-1">
                    <input type="text" name="lugar_inicio_input" id="lugar_inicio_input"
                           class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                </div>
            </div>
            <div class="sm:col-span-2">
                <label for="lugar_fin_input" class="block text-sm font-medium text-gray-700">
                    Lugar Fin
                </label>
                <div class="mt-1">
                    <input type="text" name="lugar_fin_input" id="lugar_fin_input"
                           class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">
                </div>
            </div>


            <div class="sm:col-span-2">
                <button type="submit" id="submit_form_cambio_empleado"
                        class="w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Crear
                </button>
            </div>
        </form>

        <div id="errors" class="mt-10 mb-24">
            <ul id="errors-list"></ul>
        </div>
    </div>
</div>

<script src="assets/js/jquery.js"></script>

<script>
    $(function () {

        $("#form_horarios").on('submit', function (event) {

            event.preventDefault();

            $("#errors-list").html('');

            let formData = {

                'hora_salida': $("#hora_salida_input").val(),
                'hora_llegada': $("#hora_llegada_input").val(),
                'lugar_inicio': $("#lugar_inicio_input").val(),
                'lugar_fin': $("#lugar_fin_input").val()
            };

            $.ajax({
                url: 'http://localhost:10000/horarios/store',
                method: 'POST',
                data: formData,
                dataType: "json",
                encode: true,
                success: function () {
                    alert('registro creado');
                    window.location = '/proyectobases/Horario';
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
