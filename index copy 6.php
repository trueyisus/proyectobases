<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">

    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <div id="menu_opciones">
            <img src="Iconos/menu.png" id="icono_menu">
            <ul id="opciones">
                <li><a href="index.php">Importaciones</a></li>
                <li><a href="">Finanzas</a></li>
                <li><a href="">Ventas</a></li>
                <li><a href="">Marketing</a></li>
                <li><a href="">Manufactura</a></li>
                <li><a href="">Recursos Humanos</a></li>
                <li><a href="">Importaciones</a></li>
                <li><a href="">Control de Inventarios</a></li>
                <li><a href="">Transporte de Personal</a></li>
            </ul>
        </div>

        <p id="nom_sistema">Sistema ERP</p>
        <p id="nom_usuario">Usuario</p>
        <img src="Iconos/usuario.png" id="icono_usuario">
    </nav>

    <div class="menu">
        <div class="conjunto_botones">
            <button type="button" class="boton" id="boton_finanzas" class="btn btn-light">
                <img src="Iconos/finanzas.png" class="icono">
                <p>Finanzas</p>
            </button>

            <button type="button" class="boton" id="boton_ventas" class="btn btn-light">
                <img src="Iconos/ventas.png" class="icono">
                <p>Ventas</p>
            </button>

            <button type="button" class="boton" id="boton_marketing" class="btn btn-light">
                <img src="Iconos/marketing.png" class="icono">
                <p>Marketing</p>
            </button>

            <button type="button" class="boton" id="boton_manufactura" class="btn btn-light">
                <img src="Iconos/manufactura.png" class="icono">
                <p>Manufactura</p>
            </button>
        </div>

        <div class="conjunto_botones">
            <button type="button" class="boton" id="boton_rh" class="btn btn-light">
                <img src="Iconos/rh.png" class="icono">
                <p> Recursos Humanos</p>
            </button>

            <button type="button" class="boton" id="boton_importaciones" class="btn btn-light">
                <img src="Iconos/importar.png" class="icono">
                <p>Importaciones</p>
            </button>

            <button type="button" class="boton" id="boton_ci" class="btn btn-light">
                <img src="Iconos/ci.png" class="icono">
                <p>Control de Inventarios</p>
            </button>

            <button type="button" class="boton" id="boton_tp" class="btn btn-light">
                <img src="Iconos/tp.png" class="icono">
                <p>Transporte de personal</p>
            </button>
        </div>
    </div>
</body>

</html>